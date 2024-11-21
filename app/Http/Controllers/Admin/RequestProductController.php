<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\requestProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RequestProductController extends Controller
{
    public function requestList() {
        
        $requestProducts = requestProduct::orderBy('created_at','desc')->get();

        return view('Admin.RequestProduct.requestProduct',[
            'requestProducts' =>$requestProducts,
        ]);
    }


    public function updateStatus($id,$atatus)
    {
        $requestProduct = RequestProduct::findorfail($id);

        Log::info($atatus);
        Log::info($id);
     

        if ($requestProduct) {
            $requestProduct->status = $atatus;
            $requestProduct->save();
        }

        return redirect()->back();
    }

}
