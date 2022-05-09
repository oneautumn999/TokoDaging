<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Shipment;
use App\Models\ProductInventory;

class OrderController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::forUser(\Auth::user())
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
        $this->data['orders'] = $orders;
        return $this->load_theme('orders.index', $this->data);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id order ID
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::forUser(\Auth::user())->findOrFail($id);
        $this->data['order'] = $order;
        return $this->load_theme('orders.show', $this->data);
    }

    public function checkout()
    {
        if (\Cart::isEmpty()) {
            return redirect('carts');
        }
        \Cart::removeConditionsByType('shipping');
        $this->diskon();
        $items = \Cart::getContent();
        $this->data['items'] = $items;
        $this->data['totalWeight'] = $this->getTotalWeight() / 1000;
        $this->data['provinces'] = $this->getProvinces();
        $this->data['cities'] = isset(\Auth::user()->province_id) ? $this->getCities(\Auth::user()->province_id) : [];
        $this->data['user'] = \Auth::user();
        return $this->load_theme('orders.checkout', $this->data);
    }
    // function ketika mau checkout, menentukan data yang ada

    /**
     * Display a listing of the resource.
     *
     * @para int @request request
     * 
     * @return \Illuminate\Http\Response
     */
    public function cities(Request $request)
    {
            $cities = $this->getCities($request->query('province_id'));
            return response()->json(['cities' => $cities]);
    }
    //memanggil list kota

    private function getTotalWeight()
    {
        if (\Cart::isEmpty()) {
            return 0;
        }

        $totalWeight = 0;
        $items = \Cart::getContent();

        foreach ($items as $item) {
            $totalWeight += ($item->quantity * $item->associatedModel->weight);
        }
        return $totalWeight;
    }
    //menentukan berat barang


    private function diskon()
    {
        \Cart::removeConditionsByType('diskon');
        $condition = new \Darryldecode\Cart\CartCondition(array (
            'name' => 'DISKON',
            'type' => 'discount',
            'target' => 'total',
            'value' => '20%',
            )
        );
        \Cart::condition($condition);
    }
    //perhitungan ongkos kirim


    public function doCheckout(OrderRequest $request)
    {
        $params = $request->except('_token');
        $order = \DB::transaction( function () use ($params) {
             $order = $this->_saveOrder($params);
             $this->_saveOrderItems($order);
             $this->_generatePaymentToken($order);
             $this->_saveShipment($order, $params);
             return $order; 
            } 
        );
        if ($order) {
            \Cart::clear();
            \Session::flash('success', 'Thank you. Your order has been received!');
            return redirect('orders/received/'. $order->id);
        }
        return redirect('orders/checkout');
    }
    //yang dilakukan setelah mengisi data checkout

    private function _generatePaymentToken($order)
    {
        $this->initPaymentGateway();
        $customerDetails = [
        'first_name' => $order->customer_first_name,
        'last_name' => $order->customer_last_name,
        'email' => $order->customer_email,
        'phone' => $order->customer_phone,
        ];
        $params = [
        'enable_payments' => \App\Models\Payment::PAYMENT_CHANNELS,
        'transaction_details' => [
         'order_id' => $order->code,
         'gross_amount' => $order->grand_total,
         ],
        'customer_details' => $customerDetails,
        'expiry' => [
         'start_time' => date('Y-m-d H:i:s T'),
         'unit' => \App\Models\Payment::EXPIRY_UNIT,
         'duration' => \App\Models\Payment::EXPIRY_DURATION,
         ],
        ];
        $snap = \Midtrans\Snap::createTransaction($params);
        if ($snap->token) {
            $order->payment_token = $snap->token;
            $order->payment_url = $snap->redirect_url;
            $order->save();
        }
    }
    //kode unik dari midtrans untuk pembayaran

    private function _saveOrder($params)
    {
        $baseTotalPrice = \Cart::getSubTotal();
        $taxAmount = 0;
        $taxPercent = 0;
        $discountAmount = \Cart::getCondition('DISKON')->getCalculatedValue(\Cart::getSubTotal());;
        $discountPercent = (float)\Cart::getCondition('DISKON')->getValue();;
        $grandTotal = ($baseTotalPrice) + $discountAmount;
        $orderDate = date('Y-m-d H:i:s');
        $paymentDue = (new \DateTime($orderDate))->modify('+7 day')->format('Y-m-d H:i:s');
        $orderParams = [
            'user_id' => \Auth::user()->id,
            'code' => Order::generateCode(),
            'status' => Order::CREATED,
            'order_date' => $orderDate,
            'payment_due' => $paymentDue,
            'payment_status' => Order::UNPAID,
            'base_total_price' => $baseTotalPrice,
            'tax_amount' => $taxAmount,
            'tax_percent' => $taxPercent,
            'discount_amount' => $discountAmount,
            'discount_percent' => $discountPercent,
            'grand_total' => $grandTotal,
            'note' => $params['note'],
            'customer_first_name' => $params['first_name'],
            'customer_last_name' => $params['last_name'],
            'customer_company' => $params['company'],
            'customer_address1' => $params['address1'],
            'customer_address2' => $params['address2'],
            'customer_phone' => $params['phone'],
            'customer_email' => $params['email'],
            'customer_city_id' => $params['city_id'],
            'customer_province_id' => $params['province_id'],
            'customer_postcode' => $params['postcode'],
        ];
        return Order::create($orderParams);
    }
    //menyimpan data order

    private function _saveOrderItems($order)
    {
        $cartItems = \Cart::getContent();
        if ($order && $cartItems) {
            foreach ($cartItems as $item) {
                $itemTaxAmount = 0;
                $itemTaxPercent = 0;
                $itemDiscountAmount = 0;
                $itemDiscountPercent = 0;
                $itemBaseTotal = $item->quantity * $item->price;
                $itemSubTotal = $itemBaseTotal + $itemTaxAmount + $itemDiscountAmount;
                $product = isset($item->associatedModel->parent) ? $item->associatedModel->parent : $item->associatedModel;
                $orderItemParams = [
                        'order_id' => $order->id,
                        'product_id' => $item->associatedModel->id,
                        'qty' => $item->quantity,
                        'base_price' => $item->price,
                        'base_total' => $itemBaseTotal,
                        'tax_amount' => $itemTaxAmount,
                        'tax_percent' => $itemTaxPercent,
                        'discount_amount' => $itemDiscountAmount,
                        'discount_percent' => $itemDiscountPercent,
                        'sub_total' => $itemSubTotal,
                        'sku' => $item->associatedModel->sku,
                        'type' => $product->type,
                        'name' => $item->name,
                        'weight' => $item->associatedModel->weight,
                        'attributes' => json_encode($item->attributes),
                ];
                $orderItem = OrderItem::create($orderItemParams);
                if ($orderItem) {
                    ProductInventory::reduceStock($orderItem->product_id, $orderItem->qty);
                }
            }
        }
    }
    //menyimpan data barang yang di order

    private function _saveShipment($order, $params)
    {
        $shippingFirstName = isset($params['ship_to']) ? $params['shipping_first_name'] : $params['first_name'];
        $shippingLastName = isset($params['ship_to']) ? $params['shipping_last_name'] : $params['last_name'];
        $shippingAddress1 = isset($params['ship_to']) ? $params['shipping_address1'] : $params['address1'];
        $shippingAddress2 = isset($params['ship_to']) ? $params['shipping_address2'] : $params['address2'];
        $shippingPhone = isset($params['ship_to']) ? $params['shipping_phone'] : $params['phone'];
        $shippingEmail = isset($params['ship_to']) ? $params['shipping_email'] : $params['email'];
        $shippingCityId = isset($params['ship_to']) ? $params['shipping_city_id'] : $params['city_id'];
        $shippingProvinceId = isset($params['ship_to']) ? $params['shipping_province_id'] : $params['province_id'];
        $shippingPostcode = isset($params['ship_to']) ? $params['shipping_postcode'] : $params['postcode'];
        $shipmentParams = [
        'user_id' => \Auth::user()->id,
        'order_id' => $order->id,
        'status' => Shipment::PENDING,
        'total_qty' => \Cart::getTotalQuantity(),
        'total_weight' => $this->getTotalWeight(),
        'first_name' => $shippingFirstName,
        'last_name' => $shippingLastName,
        'address1' => $shippingAddress1,
        'address2' => $shippingAddress2,
        'phone' => $shippingPhone,
        'email' => $shippingEmail,
        'city_id' => $shippingCityId,
        'province_id' => $shippingProvinceId,
        'postcode' => $shippingPostcode,
        ];
        Shipment::create($shipmentParams);
    }
    //menyimpan data untuk pengiriman barang

    // private function _sendEmailOrderReceived($order)
    // {
    //     $message = new \App\Mail\OrderReceived($order);
    //     \Mail::to(\Auth::user()->email)->send($message);
    // } 
    //mengirim email secara otomatis ke user

    public function received($orderId)
    {
        $this->data['order'] = Order::where('id', $orderId)->where('user_id', \Auth::user()->id)->firstOrFail();
        // $this->_sendEmailOrderReceived($this->data['order']);
        return $this->load_theme('orders/received', $this->data); 
    }
    //nota pembelian barang
}
