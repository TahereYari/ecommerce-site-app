<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Basket;
use App\Models\BasketProduct;
use App\Models\CompetetionWiner;
use App\Models\LicenseRecords;
use App\Models\Product;
use App\Models\requestProduct;
use App\Models\Ticket;
use App\Models\TicketMessages;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;
use Throwable;

class UserFrontController extends Controller
{
    public function userDashboard() {
        $userId = auth()->user()->id;
        $requesrProducts = requestProduct::where('user_id', $userId)->get();
        $gifts = CompetetionWiner::where('user_id', $userId)->get();

        $purchasedProducts = LicenseRecords::where('user_id', $userId)
        ->orderBy('created_at','desc')
        ->with(['product', 'license'])
        ->get();

        $productCount = BasketProduct::whereHas('basket', function ($query) use ($userId) {
            $query->where('user_id', $userId)
                ->where('is_pay', 1);
        })->distinct('product_id')->count('product_id');

        
        $percentage = $this -> userFreeProducts();
        $sumOfPurchase = $this -> sumOfPurchase();

        $ticketCount = Ticket::where('user_id', $userId)
                             ->where('status', 1)
                                ->count();

        return view('Front.User.dashboardUser',[
            'requesrProducts' => $requesrProducts,
            'gifts' => $gifts,
            'purchasedProducts' => $purchasedProducts,
            'productCount' => $productCount,
            'percentage' => $percentage,
            'ticketCount' => $ticketCount,
            'sumOfPurchase' => $sumOfPurchase,
        ]);
    }

    
  

    public function profile() {
        $userId = auth()->user()->id;
      

        $uniqueProducts  = BasketProduct::whereHas('basket', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->distinct('product_id')->get(['product_id']);
        $productIds = $uniqueProducts->pluck('product_id');
        $products = Product::whereIn('id', $productIds)->get();




        return view('Front.User.profile',[
            'products' => $products
        ]);
    }

    public function ticketPage() {
        $tickettMessages =null;
        $tickets = Ticket::where('user_id',auth()->user()->id)
                            ->where('status','1')
                            ->orderByDesc('created_at')->get();
       
        $openTicket = Ticket::where('status','0')->where('user_id',auth()->user()->id)->first();
        if ($openTicket) {
            $tickettMessages = TicketMessages :: where('ticket_id',$openTicket->id)
                                                ->orderBy('created_at','desc')->get();
        } 

        return view('Front.User.ticket',[
            'tickettMessages' => $tickettMessages,
            'openTicket' => $openTicket,
            'tickets' => $tickets,
        ]);
        
       
    }


    public function uploadFiles(UploadedFile $file, string $directory)
    {
        $randomNumber = random_int(100, 9999);
        $filename = time() . '-' . $randomNumber.'.' . $file->getClientOriginalExtension();
        $file->move(public_path($directory), $filename);
       
        return $filename;
    }


    public function uploadFileName(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:rar,zip',
        ]);
      
        $fileName = $this->uploadFiles($request->file, 'Files/TicketFiles');
      
        return response()->json(['success' => true, 'fileName' => $fileName]);
    }

    public function deletefilePond(Request $request)
    {
        $fileName = $request->file_name;
        $directory = $request->directory;
      
        if ($fileName && $directory) {
            $filePath = public_path($directory . $fileName);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
    
        return response()->json(['success' => true]);
    }


    public function requestProduct(Request $request){
        try {
            $requesrProduct = new requestProduct();

            $request->validate([
                  'file'=>'required'
            ]);
            $requesrProduct->name = $request->name;
            $requesrProduct->email = $request->email;
            $requesrProduct->tel = $request->tel;
            $requesrProduct->file = $request->file_name;
            $requesrProduct->user_id = auth()->user()->id;
            $requesrProduct->save();

            
            $title = __('messages.request_added_title');
            $message = __('messages.request_added_message');
            Alert::html($title, $message, 'success')->persistent(true);
            return redirect()->back();
  
       } 
       catch (ValidationException $e) {
           $errors = $e->validator->errors()->all();
           $title = __('messages.validation_error_title');
           $message = '<ul>';
           foreach ($errors as $error) {
               $message .= "<li>$error</li>";
           }
           $message .= '</ul>';
           Alert::html($title, $message, 'error')->persistent(true);
   
           return back()->withErrors($e->validator)->withInput();
       }
       catch (Throwable $th) {
           return abort(403, 'مشکلی پیش آمده لطفا   دوباره تلاش کنید.');
       }  

    }

    function profileUpdate(Request $request)
    {
        try {

            $user = User::findorfail(Auth::user()->id);


            if ($request->email && $request->email != $user->email) {
                $request->validate([
                    'email' => [
                        'required',
                        'string',
                        'email',
                        'max:255',
                        Rule::unique('users')->ignore($user->id)->where(function ($query) {
                            return $query->where('deleteStatuse', '0');
                        }),

                    ],

                ]);
            }


            if ($request->tel && $request->tel != $user->tel) {
                $request->validate([
                    'tel' => [
                        'numeric',
                        'digits:11',
                        Rule::unique('users')->ignore($user->id)->where(function ($query) {
                            return $query->where('deleteStatuse', 0);
                        }),
                    ],
                ]);
            }


            if ($request->national_code && $request->national_code != $user->national_code) {
                $request->validate([
                    'national_code' => [
                        'numeric',
                        'digits:11',
                        Rule::unique('users')->ignore($user->id)->where(function ($query) {
                            return $query->where('deleteStatuse', 0);
                        }),
                    ],
                ]);
            }




            $user->name = $request->name;
            $user->email = $request->email;
            $user->tel = $request->tel;
            $user->image = $request->image_name;
            $user->national_code = $request->national_code;

            $user->update();



            $title = __('messages.user_update_title');
            $message = __('messages.user_update_message');
            Alert::html($title, $message, 'success')->persistent(true);

            return redirect()->back();
        } catch (ValidationException $e) {
            $errors = $e->validator->errors()->all();
            $title = __('messages.validation_error_title');
            $message = '<ul>';
            foreach ($errors as $error) {
                $message .= "<li>$error</li>";
            }
            $message .= '</ul>';
            Alert::html($title, $message, 'error')->persistent(true);

            return back()->withErrors($e->validator)->withInput();
        } catch (Throwable $th) {
            return abort(403, 'مشکلی پیش آمده لطفا   دوباره تلاش کنید.');
        }
    }


    public function profileUpdatePass(Request $request)
    {
        try {
            $user = User::findOrFail(auth()->user()->id);

            $request->validate([
                'current_password' => 'required',
                'password' => 'required|min:6|confirmed',
            ]);

            if (!Hash::check($request->current_password, $user->password)) {
                $title = __('messages.password_change_title');
                $message = __('messages.password_fail_message');
                Alert::html($title, $message, 'error')->persistent(true);
                // return redirect()->back();
                return back()->withErrors(['current_password' => $message]);
            }
            // else {
            $user->password = Hash::make($request->password);
            $user->save();

            $title = __('messages.password_change_title');
            $message = __('messages.password_change_message');
            Alert::html($title, $message, 'success')->persistent(true);
            return redirect()->back();
            // return redirect()->back()->with("success", "رمز عبور با موفقیت تغییر کرد.");
            // }
        } catch (ValidationException $e) {
            $errors = $e->validator->errors()->all();
            $title = __('messages.validation_error_title');
            $message = '<ul>';
            foreach ($errors as $error) {
                $message .= "<li>$error</li>";
            }
            $message .= '</ul>';
            Alert::html($title, $message, 'error')->persistent(true);

            return back()->withErrors($e->validator)->withInput();
        } catch (Throwable $th) {
            return abort(403, 'مشکلی پیش آمده لطفا دوباره تلاش کنید.');
        }
    }

    public function sumOfPurchase() {
        $userId = auth()->user()->id;
        $sum = 0;
        $purchases  = Basket::where('user_id', $userId)
                        ->where('is_pay',1)
                        ->get();
        foreach ($purchases as $purchase) {
            $sum =  $sum + $purchase->price;
            
        }    
        return    $sum;          

    }
//***************************Percent User Free Products************** */
    public function userFreeProducts()  {
        $userId = auth()->user()->id;

        // Get the total number of free products available
        $totalFreeProducts = Product::where('free', 1)
            ->where('deleteStatuse', 0)->count();

        // Get the user's baskets
        $userBaskets = Basket::where('user_id', $userId)->pluck('id');

        // Get the unique product IDs from the user's baskets where the product is free
        $userFreeProducts = BasketProduct::whereIn('basket_id', $userBaskets)
            ->whereHas('product', function ($query) {
                $query->where('free', 1);
            })
            ->distinct('product_id')
            ->count('product_id');

        // Calculate the percentage
        $percentage = ($totalFreeProducts > 0) ? ($userFreeProducts / $totalFreeProducts) * 100 : 0;
        return $percentage;
    }


    public function showPurchases()
    {
        $user = auth()->user();
        $baskets = Basket:: where('user_id', $user->id)
                            ->where('is_pay','1')
                            ->orderBy('created_at', 'desc')
                             ->get();

        return view('Front.User.myPurchase', compact('baskets'));
    }
}
