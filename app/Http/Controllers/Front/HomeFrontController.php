<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Competiotion;
use App\Models\CompetiotionsAnswer;
use App\Models\Messages;
use App\Models\Product;
use App\Models\Site;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;
use Throwable;

class HomeFrontController extends Controller
{
    public function home() {
        return view('layout.home');
    }

    public function index() {

        $newProducts = Product::orderByDesc('created_at')->limit(3)->where('deleteStatuse','=',0)->get();
        $lastProducts = Product::orderByDesc('created_at')->where('deleteStatuse','=',0)->first();
        
        $twoLastProducts = Product::orderBy('created_at', 'desc')
        ->skip(1)   // پرش از محصول آخر
        ->take(1)   // گرفتن محصول بعد از محصول آخر
        ->first();
        $allproducts = Product::orderByDesc('created_at')->limit(10)->where('deleteStatuse', '=', 0)->get();
        $freeproducts = Product::orderByDesc('created_at')->limit(10)
                                ->where('deleteStatuse', '=', 0)
                                ->where('free', '=', 1)
                                ->get();
        $competiotion = Competiotion::orderByDesc('created_at')->where('deleteStatuse', '=', 0)->first();
        $categories = Category::where('deleteStatuse','=',0)->get();
        $site =Site::orderByDesc('created_at')->first();

        $totalProducts = Product::where('deleteStatuse','0')->count();
        $totalUsers = User::where('deleteStatuse','0')->count();
    
        return view('Front.index',[
            'newProducts' =>$newProducts,
            'categories' =>$categories,
            'allproducts' =>$allproducts,
            'competiotion' =>$competiotion,
            'site' =>$site,
            'lastProducts' =>$lastProducts,
            'totalProducts' =>$totalProducts,
            'totalUsers' =>$totalUsers,
            'twoLastProducts' =>$twoLastProducts,
            'freeproducts' =>$freeproducts,
        ]);
    }



    public function switchLanguage($lang)
    {
       
        // بررسی اینکه زبان معتبر است یا خیر
        $supportedLocales = ['en', 'fa'];
        if (!in_array($lang, $supportedLocales)) {
            $lang = 'en';
        }

        // ذخیره زبان در کوکی با مدت زمان اعتبار تعیین شده (مثلاً یک سال)
        Cookie::queue('HomeLanguage', $lang, 60 * 24 * 365); // کوکی با مدت زمان یک سال

        // تنظیم زبان اپلیکیشن
        App::setLocale($lang);

        return response()->json(['status' => 'success']);
    }


    public function getLanguage(Request $request)
    {
        $language = $request->cookie('HomeLanguage', 'en'); // 'en' به عنوان زبان پیش‌فرض در صورت نبود کوکی
        return response()->json(['HomeLanguage' => $language]);
    }


    public function allProducts() {
        $allProducts = Product::orderByDesc('created_at')->where('deleteStatuse','=',0)->get();
        return view('Front.allProducts',[
            'allProducts' =>$allProducts,
        ]);
    }
    public function allFreeProducts() {
        $allProducts = Product::orderByDesc('created_at')
                            ->where('deleteStatuse','=',0)
                            ->where('free','=',1)
                            ->get();
        return view('Front.allProducts',[
            'allProducts' =>$allProducts,
        ]);
    }

    public function showByCategory($id)
    {
        $category = Category::findOrFail($id);
        $products = Product::where('category_id', $id)->where('deleteStatuse', '=', 0)->get();

        return view('Front.productByCategory', compact('category', 'products'));
    }


    public function contactUs(Request $request) {
        try {

            $newMmessage = new Messages();

            $newMmessage->name = $request->name;
            $newMmessage->email = $request->email;
            $newMmessage->comment = $request->comment;

            $newMmessage->save();

            $title = __('messages.comment_added_title');
            $message = __('messages.comment_added_message');
            Alert::html($title, $message, 'success')->persistent(true);

            return redirect()->route('index');
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


    public function competetionAnswer(Request $request,$id){
        $answer = new CompetiotionsAnswer();
        $randomNumber = random_int(100, 9999);

        if ($request->file) {
           $answer->file = $request->file_name;
            
        }


        $answer->answer = $request->answer;
      
        $answer->user_id = auth()->user()->id;
        $answer->competiotion_id = $id;

        $answer->save();

        $title = __('messages.answer_added_title');
        $message = __('messages.answer_added_message');
        Alert::html($title, $message, 'success')->persistent(true);

        return redirect()->route('index');
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


    public function uploadFiles(UploadedFile $file, string $directory)
    {
        $randomNumber = random_int(100, 9999);
        $filename = time() . '-' . $randomNumber . '.' . $file->getClientOriginalExtension();
        $file->move(public_path($directory), $filename);

        return $filename;
    }


    public function uploadFileName(Request $request)
    {
        $request->validate([
            'file' => 'required',
        ]);

        $fileName = $this->uploadFiles($request->file, 'Files/CompetetionAnswers');

        return response()->json(['success' => true, 'fileName' => $fileName]);
    }


    public function viewProduct($id) {

        $product = Product::where('id',$id)->first();
        $licenses = $product->license();

        return view('Front.viewProduct',[
            'product' =>$product,
            'licenses' =>$licenses,
        ]);
    }


  
    
}
