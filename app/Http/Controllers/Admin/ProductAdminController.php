<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\License;
use App\Models\Product;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\UploadedFile;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;
use Illuminate\Validation\ValidationException;
use Throwable;

class ProductAdminController extends Controller
{
 
    function productCreate(){
        try {
            $categories = Category::where('DeleteStatuse','0')->get();
          
            return view('Admin.Product.productCreate',[
              'categories'=>$categories
            ]);
        } catch (Throwable $th) {
            return abort(403, 'مشکلی پیش آمده لطفا   دوباره تلاش کنید.');
        }
      
    }


    function productinsert(Request $request){
    //   try {
            $request['price'] = str_replace(',', '', $request->price);
          
            $product = new Product();
            
            $request->validate([
                'name' =>['required','string','max:255',
                    Rule::unique('products')->where(function ($query) {
                        return $query->where('deleteStatuse', 0);
                    }),],
                'price' => 'nullable|numeric',
                'description' => 'nullable|string',
                // 'image' => 'required|mimes:jpeg,png,jpg',
                // 'file' => 'required|mimes:rar,zip|max:512000',
                // 'video' => 'required|mimes:mp4,avi,mov|max:512000',
                'image' => 'required',
                'file' => 'required',
                'video' => 'required',

                'type' => 'required_if:license,on|array',
                'cost' => 'required_if:license,on|array',
                'license' => ['required_if:license,on', function($attribute, $value, $fail) use ($request) {
                    if ($request->has('license')) {
                        $types = $request->input('type', []);
                        $costs = $request->input('cost', []);
                        $isValid = false;

                        foreach ($types as $index => $type) {
                            if (!empty($type) && !empty($costs[$index] ?? null)) {
                                $isValid = true;
                                break;
                            }
                        }

                        if (!$isValid) {
                            $fail(__('messages.rule_type_cost'));
                        }
                    }
                }],
            
            ]);

                 // بررسی تکراری نبودن type‌ها
                if ($request->has('license')) {
                    $types = $request->input('type', []);
                    if (count($types) !== count(array_unique($types))) {
                        // $errors = ['type' => __('messages.rule_type_duplicate')];
                        // throw ValidationException::withMessages($errors);
                        return redirect()->back()->withErrors(['type' => __('messages.rule_type_duplicate')]);
                    }
                }

            // بررسی اعتبار فیلدهای لایسنس
            if ($request->has('license')) {
                $hasValidLicense = false;

                // چک کردن مقادیر type و cost
                foreach ($request->type as $index => $type) {
                    if (!empty($type) && !empty($request->cost[$index])) {
                        $hasValidLicense = true;
                        break;
                    }
                }

                if (!$hasValidLicense) {
                    // $errors = ['license' => __('messages.rule_type_cost')];
                    // throw ValidationException::withMessages($errors);
                    return redirect()->back()->with('error', __('messages.rule_type_cost'));
                }
            }
            // $product->price = $request->price ? $request->price :0;
            $price = $request->has('license') ? 0 : ($request->price ?? 0);

           

            $product->name = $request->name;
            $product->price = $price;
            $product->description = $request->description;
            $product->image =  $request->image_name;
            $product->file = $request->file_name;
            $product->video = $request->video_name;
            $product->category_id = $request->categoryName;
            $product->free = $request->has('free') ? 1 : 0;
            $product->license = $request->has('license') ? 1 : 0;
            $product->save();
     
            // ذخیره‌سازی لایسنس‌ها
            if ($product->license && $request->has('type')) {
                foreach ($request->type as $index => $type) {
                    $cost = $request->cost[$index];
                    $cost = str_replace(',', '', $request->cost[$index]);
                    if (!empty($type) || !empty($cost)) {
                        $license = new License();
                        $license->product_id = $product->id;
                        $license->type = $type;
                        $license->cost = $cost;
                        $license->save();
                    }
                }
            }

            $title = __('messages.product_added_title');
            $message = __('messages.product_added_message');
            Alert::html($title, $message, 'success')->persistent(true);

                
            return redirect()->route('product_list');

     
        //   }
        //   catch (ValidationException $e) {
        //     $errors = $e->validator->errors()->all();
        //     $title = __('messages.validation_error_title');
        //     $message = '<ul>';
        //     foreach ($errors as $error) {
        //         $message .= "<li>$error</li>";
        //     }
        //     $message .= '</ul>';
        //     Alert::html($title, $message, 'error')->persistent(true);
    
        //     return back()->withErrors($e->validator)->withInput();
        // }
        //    catch (Throwable $th) {
        //     return abort(403, 'مشکلی پیش آمده لطفا   دوباره تلاش کنید.');
        //   }
        
      

    }



    function productUpdate(Request $request , $id) {
        // try {
                $request['price'] = str_replace(',', '', $request->price);
                
                $product = Product::findorfail($id);

                if (($request->name && $request->name != $product->name)) {
                    $request->validate([
                        'name' => ['required','string','max:255',
                                Rule::unique('products')->ignore($product->id)->where(function ($query) {
                                    return $query->where('deleteStatuse', '0');
                        }),]
                    ]);   
                }

                $request->validate([
                    'image' => 'required',
                    'file' => 'required',
                    'video' => 'required',
                ]);
                $price = $request->has('license') ? 0 : ($request->price ?? 0);

                $product->name = $request->name;
                $product->price = $price;
                $product->description = $request->description;
                $product->image =  $request->image_name;
                $product->file = $request->file_name;
                $product->video = $request->video_name;
                $product->free = $request->has('free') ? 1 : 0;
                $product->license = $request->has('license') ? 1 : 0;
                $product->save();

    
                    // بررسی تکراری نبودن type‌ها
                if ($request->has('license')) {
                    $types = $request->input('type', []);
                    if (count($types) !== count(array_unique($types))) {
                        
                      
                         return redirect()->back()->withErrors(['type' => __('messages.rule_type_duplicate')]);
                    }
                }
    
                // بررسی اعتبار فیلدهای لایسنس
                if ($request->has('license')) {
                    $hasValidLicense = false;
    
                    // چک کردن مقادیر type و cost
                    foreach ($request->type as $index => $type) {
                        if (!empty($type) && !empty($request->cost[$index])) {
                            $hasValidLicense = true;
                            break;
                        }
                    }
    
                    if (!$hasValidLicense) {
                              
                        $title = __('messages.validation_error_title');
                       
                        Alert::html($title, __('messages.rule_type_cost'), 'error')->persistent(true);
    
                        return redirect()->back()->with('error', __('messages.rule_type_cost'));
                    }
                }

                   foreach ($product->license() as $license) {
                        $license->delete();
                    }

            // ذخیره‌سازی لایسنس‌ها
                // if ($request->has('type') && $request->has('cost')){
                    if ($product->license && $request->has('type') && $request->has('type')) {
                        foreach ($request->type as $index => $type) {
                            $cost = $request->cost[$index];
                             $cost = str_replace(',', '', $request->cost[$index]);
                            if (!empty($type) || !empty($cost)) {
                                $license = new License();
                                $license->product_id = $product->id;
                                $license->type = $type;
                                $license->cost = $cost;
                                $license->save();
                            }
                        }
                    }
                // }
                 
        

            $title = __('messages.product_update_title');
            $message = __('messages.product_update_message');
            Alert::html($title, $message, 'success')->persistent(true);;

                
            return redirect()->route('product_list');


        // } 
        
        // catch (ValidationException $e) {
        //     $errors = $e->validator->errors()->all();
        //     $title = __('messages.validation_error_title');
        //     $message = '<ul>';
        //     foreach ($errors as $error) {
        //         $message .= "<li>$error</li>";
        //     }
        //     $message .= '</ul>';
        //     Alert::html($title, $message, 'error')->persistent(true);
    
        //     return back()->withErrors($e->validator)->withInput();
        // }
        // catch (Throwable $th) {
        //     return abort(403, 'مشکلی پیش آمده لطفا   دوباره تلاش کنید.');
        // }
    }


    public function productDelete($id) {
        try {
            $product = Product::findorfail($id);
            $product->deleteStatuse = '1';
            $product->save();
         
      
            $title = __('messages.product_delete_title');
            $message = __('messages.product_delete_message');
  
            Alert::html($title, $message, 'success')->persistent(true);
         
           return redirect()->back();
  
          } catch (Throwable $th) {
             return abort(403, 'مشکلی پیش آمده لطفا   دوباره تلاش کنید.');
          }
       
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
      
        $fileName = $this->uploadFiles($request->file, 'Images/Product/Files');
      
        return response()->json(['success' => true, 'fileName' => $fileName]);
    }

    public function uploadImageName(Request $request)
    {
        $request->validate([
            'image' => 'required|file|mimes:jpeg,png,jpg',
        ]);

        $imageName = $this->uploadFiles($request->file('image'), 'Images/Product/Images');
        
        return response()->json(['success' => true, 'imageName' => $imageName]);
    }


    public function uploadVideo(Request $request)
    {
        $request->validate([
            'video' => 'required|file|mimes:mp4,avi,mov',
        ]);

        $videoFileName = $this->uploadFiles($request->file('video'), 'Images/Product/Videos');

        return response()->json(['success' => true, 'videoFileName' => $videoFileName]);
    }


    public function getLicenseDetails(Request $request)
    {
        $productId = $request->input('productId');

        // دریافت محصول بر اساس شناسه
        $product = Product::findOrFail($productId);

        // در اینجا فرض می‌کنیم که اطلاعات لایسنس‌ها در فیلدی به نام 'licenses' ذخیره شده است.
        $licenses = $product->license(); // اینجا باید بسته به طراحی مدل‌ها و روابط شما با محصولات پیاده‌سازی شود.
      
        return response()->json(['licenses' => $licenses]);
    }


    function showLicenses($id) {
        try {
            $licenses = License::where('product_id',$id)->get();
            return view('Admin.Product.viewLicense',[
                'licenses'=>$licenses
            ]);
        } catch (Throwable $th) {
            return abort(403, 'مشکلی پیش آمده لطفا   دوباره تلاش کنید.');
        }
    }


    public function licenseDelete($id) {
        try {
            $license = License::findorfail($id);
            
            $license->delete();
         
      
            $title = __('messages.license_delete_title');
            $message = __('messages.license_delete_message');
  
            Alert::html($title, $message, 'success')->persistent(true);
         
           return redirect()->route('show_licenses');
  
          } catch (Throwable $th) {
             return abort(403, 'مشکلی پیش آمده لطفا   دوباره تلاش کنید.');
          }
       
    }




    public function deleteimagePond(Request $request)
    {
        $imageName = $request->image_name;
        $directory = $request->directory;
      
        if ($imageName && $directory) {
            $imagePath = public_path($directory . $imageName);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
    
        return response()->json(['success' => true]);
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


    public function deletevideoPond(Request $request)
    {
        $videoName = $request->video_name;
        $directory = $request->directory;
       
        if ($videoName && $directory) {
            $videoPath = public_path($directory . $videoName);
            if (file_exists($videoPath)) {
                unlink($videoPath);
            }
        }
    
        return response()->json(['success' => true]);
    }


}
