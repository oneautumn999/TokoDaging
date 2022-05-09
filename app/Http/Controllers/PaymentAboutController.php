<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentAboutController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {        
        return $this->load_theme('paymentabout.index');
    } 
}
