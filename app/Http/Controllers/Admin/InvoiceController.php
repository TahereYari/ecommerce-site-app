<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Basket;
use App\Models\BasketProduct;
use App\Models\LicenseRecords;
use Illuminate\Http\Request;
use Throwable;

class InvoiceController extends Controller
{
    function invoiceList()
    {

        try {
            $baskets = Basket::where('is_pay', '1')
                                ->orderBy('created_at', 'desc')
                                ->get();
            return view('Admin.Invoice.invoice',[
                'baskets'=> $baskets
            ]);
        } catch (Throwable $th) {
            return abort(403, 'مشکلی پیش آمده لطفا   دوباره تلاش کنید.');
        }
    }

    public function getBasketProducts($basketId)
    {
        
        $basket = Basket::findorfail($basketId);
        $basketProducts = BasketProduct::where('basket_id', $basketId)->get();

        return view('Admin.Invoice.invoiceProduct',[
            'basketProducts' => $basketProducts,
            'basket' => $basket,
        ]);
    }


}
