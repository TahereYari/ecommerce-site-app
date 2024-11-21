<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

use App\Models\Basket;
use App\Models\BasketProduct;
use App\Models\License;
use App\Models\LicenseRecords;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class BasketController extends Controller
{
    public function cartInsert($user_id,$product_id, $license_id=null)
    {

        $basket = Basket::where('user_id', '=', $user_id)->orderByDesc('created_at')->first();
        $product = Product::where('id', '=', $product_id)->first();

        $invoice_number = random_int(100, 9999);
        if (!$basket || $basket->is_pay == 1) {
            $newBasket = new Basket();
            $newBasket->user_id = $user_id;

            $newBasket->invoiceNumber = $invoice_number;
            $newBasket->save();
            $basket_id =  $newBasket->id;

            $basketProduct = new BasketProduct();
            $basketProduct->basket_id = $basket_id;
            $basketProduct->product_id = $product_id;
            
            if ($product->free == 1) {
                $newBasket->price = $newBasket->price +0;
                $newBasket->update();
                $basketProduct->price = 0;
            } else {
                if ($license_id) {
                    $license = $product->license()->where('id', $license_id)->first();
                    $basketProduct->license_id = $license_id;
                    if ($license) {
                        $basketProduct->price = $license->cost;
                        $newBasket->price = $newBasket->price + $license->cost;
                        $newBasket->update();
                        
                    } else {
                      
                        $basketProduct->price = $product->price;
                        $newBasket->price = $newBasket->price + $product->price;
                        $newBasket->update();
                    }
                } else {
                  
                    $basketProduct->price = $product->price;
                    $newBasket->price = $newBasket->price + $product->price;
                    $newBasket->update();
                } 
            }

            $title = __('messages.cart_added_title');
            $message = __('messages.cart_added_message');
            Alert::html($title, $message, 'success')->persistent(true);
            $basketProduct->save();
        } elseif ($basket && $basket->is_pay == 0) {
            $basketProduct2 = BasketProduct::where('basket_id', '=', $basket->id)
                ->where('product_id', '=', $product->id)->first();

            if (!$basketProduct2) {
                $basketProduct = new BasketProduct();
                $basketProduct->basket_id = $basket->id;
                $basketProduct->product_id = $product_id;
                $basketProduct->price = $product->price;
                if ($product->free == 1) {
                    $basketProduct->price = 0;
                } else {
                    if ($license_id) {
                        $license = $product->license()->where('id', $license_id)->first();
                     
                        if ($license) {
                            $basketProduct->price = $license->cost;
                            $basketProduct->license_id = $license_id;
                        } else {

                            $basketProduct->price = $product->price;
                        }
                    } else {

                        $basketProduct->price = $product->price;
                    }
                }


                $title = __('messages.cart_added_title');
                $message = __('messages.cart_added_message');
                // Alert::html($title, $message, 'success')->persistent(true);
                Alert::html($title, $message, 'success')->persistent(true);
                $basketProduct->save();
            }
            else{
                $title = __('messages.cart_added_title');
                $message = __('messages.cart_duplicte_message');
                Alert::html($title,  $message)->persistent(true);
            }
        }


        if ($basket) {
            $basketProducts = BasketProduct::where('basket_id', '=', $basket->id)->get();
            $sumPrice = 0;
            foreach ($basketProducts as $basketProduct) {
                $sumPrice = $sumPrice + $basketProduct->price;
            }

            $basket->price = $sumPrice;
            $basket->update();
        }

        return redirect()->back();
    }

    public function cartPage()
    {

        $basket = Basket::where('user_id', '=', Auth::user()->id)
        ->where('is_pay', '=', 0)
        ->orderByDesc('created_at')->first();
      
        if ($basket) {
            $basketProducts = BasketProduct::where('basket_id', '=',  $basket->id)->get();
           
            return view('Front.User.cart', [
                'basketProducts' => $basketProducts,
                'basket' => $basket,
               
            ]);
        } else {
            return view('Front.User.cart', [
                'basket' => $basket,
               

            ]);
        }
    }


    public function Checkout($basket_id)
    {
        $basket = basket::where('user_id', '=', Auth::user()->id)
        ->where('is_pay', '=', 0)
        ->where('id', '=', $basket_id)
        ->orderByDesc('created_at')->first();


        $basketProducts = BasketProduct::where('basket_id', $basket_id)->get();


        if ($basket) {
            $basket->is_pay = 1;
            $basket->update();
        }

       
        
        foreach ($basketProducts as $basketProduct) {

            $licenseKey = Str::uuid()->toString();
           
            if ($basketProduct->license_id != null) {
                $cost1 = License::where('id', $basketProduct->license_id)->first();
                $cost = $cost1->cost;
                
                $licenseRecords = new LicenseRecords();
                $licenseRecords->product_id = $basketProduct->product_id;
                $licenseRecords->user_id = auth()->user()->id;
                $licenseRecords->license_id = $basketProduct->license_id;
                $licenseRecords->license_key = $licenseKey;
                $licenseRecords->basket_id = $basket_id;
                $licenseRecords->price = $cost;
                $licenseRecords->save();
              
            }
        }

        $title = __('messages.cart_pay_title');
        $message = __('messages.cart_pay_message');
        Alert::html($title, $message, 'success')->persistent(true);
        return redirect()->back();
    }


    public function cartDelete($basket_id, $basketproduct_id)
    {
        $basketproduct = BasketProduct::findorfail($basketproduct_id);
        $basketproduct->delete();

        $basket = Basket::where('id', '=', $basket_id)->first();
        $basket->price =  $basket->price - $basketproduct->price;
        if ($basket->price < 0) {
            $basket->price = 0;
        }
        $basket->update();
        return redirect()->back();
    }

}
