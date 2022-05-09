<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'parent_id',
        'user_id',
        'sku',
        'type',
        'name',
        'slug',
        'price',
        'weight',
        'length',
        'width',
        'height',
        'short_description',
        'description',
        'status',
        'diskon',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function productInventory()
    {
        return $this->hasOne('App\Models\ProductInventory');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category', 'product_categories');
    }

    public function variants()
    {
        return $this->hasMany('App\Models\Product', 'parent_id')->orderBy('price', 'ASC');
    }

    public function variants2()
    {
        return $this->hasMany('App\Models\Product', 'id')->orderBy('price', 'ASC');
    }

    public function parent()
    {
        return $this->belongsTo('App\Models\Product', 'parent_id');
    }

    public function productAttributeValues()
    {
        return $this->hasMany('App\Models\ProductAttributeValue', 'parent_product_id');
    }

    public function productImages()
    {
        return $this->hasMany('App\Models\ProductImage')->orderBy('id', 'DESC');
    }

    public static function statuses()
    {
        return [
            0 => 'draft',
            1 => 'active',
            2 => 'inactive',
        ];
    }

    function status_label()
    {
        $statuses = $this->statuses();

        return isset($this->status) ? $statuses[$this->status] : null;
    }

    function diskon_label()
    {
        $diskon = $this->diskon();

        return isset($this->diskon) ? $diskon[$this->diskon] : null;
    }
    public static function diskon()
    {
        return [
            0 => 'diskon',
            1 => 'gak',
        ];
    }

    public static function types()
    {
        return [
            'simple' => 'Simple',
            'configurable' => 'Configurable',
        ];
    }

    public function scopeActive($query)
    {
        return $query->where('status',1)
                    ->where('parent_id',NULL);
    }
    public function scopeDiskon($query)
    {
        return $query->where('diskon', 1)->where('parent_id', null);
    }

	public function scopePopular($query, $limit = 10)
	{
		$month = now()->format('m');

		return $query->selectRaw('products.*, COUNT(order_items.id) as total_sold')
			->join('order_items', 'order_items.product_id', '=', 'products.id')
			->join('orders', 'order_items.order_id', '=', 'orders.id')
			->whereRaw(
				'orders.status = :order_satus AND MONTH(orders.order_date) = :month',
				[
					'order_status' => Order::COMPLETED,
					'month' => $month
				]
			)
			->groupBy('products.id')
			->orderByRaw('total_sold DESC')
			->limit($limit);
	}

    public function price_label()
    {
        return ($this->variants->count() > 0) ? $this->variants->first()->price : $this->price;
    }
    public function price_label2()
    {
        return ($this->variants2->count() > 0) ? $this->variants2->first()->price : $this->price;
    }

    public function configurable()
	{
		return $this->type == 'configurable';
	}

    public function simple()
	{
		return $this->type == 'simple' ;
	}
}
