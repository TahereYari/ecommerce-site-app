<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;
use Throwable;

class CategoryController extends Controller
{
    function categoryList() {
        try {
            $categorys = Category::where('DeleteStatuse','0')->orderBy('created_at', 'desc')->get();
           return view('Admin.Category.categoryList',[
              'categorys'=>$categorys
           ]);
        } catch (Throwable $th) {
            return abort(403, 'مشکلی پیش آمده لطفا   دوباره تلاش کنید.');
        }
    }


    function categoryCreate() {

        try {
            return view('Admin.Category.categoryCreate');
        } catch (Throwable $th) {
            return abort(403, 'مشکلی پیش آمده لطفا   دوباره تلاش کنید.');
        }
       
    }



    function categoryInsert(Request $request) {
        try {
            
            $category = new Category();

            $request->validate([
                'image' => 'required',
                'name' => [
                            'required',
                            'string',
                            Rule::unique('categories')->where(function ($query) {
                             return $query->where('DeleteStatuse', 0);
                        }),],
              
            ]);
             $category->name =$request->name;
             $category->description =$request->description;
             $category->image =$request->image_name;
            
             $category->save();

             $title = __('messages.category_added_title');
             $message = __('messages.category_added_message');
             Alert::html($title, $message, 'success')->persistent(true);

            
           return redirect()->route('category_list');
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


    function categoryUpdate(Request $request,$id)  {

        try {
            $category = Category::findorfail($id);

        if (($request->name && $request->name != $category->name) ) {
            $request->validate([
                'name' =>[ 'required','string',
                Rule::unique('categories')->ignore($category->id)->where(function ($query) {
                    return $query->where('DeleteStatuse', '0');
                    
                })],
               
               ]);
        }

    

        $category->name =$request->name;
        $category->description =$request->description;
        $category->image = $request->image_name;
        $category->update();


        $title = __('messages.category_update_title');
        $message = __('messages.category_update_message');
        Alert::html($title, $message, 'success')->persistent(true);

        return redirect()->route('category_list');
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



    public function categoryDelete($id) {
        try {
           $competiotion = Category::findorfail($id);
           $competiotion->DeleteStatuse = '1';
           $competiotion->save();

           $product = Product::where('category_id','=',$id)->first();
           if ($product) {
               $product->deleteStatuse = "1";
               $product->save();
           }
    
      
          $title = __('messages.category_delete_title');
          $message = __('messages.category_delete_message');

          Alert::html($title, $message, 'success')->persistent(true);
        
         return redirect()->route('category_list');

        } catch (\Throwable $th) {
           return abort(403, 'مشکلی پیش آمده لطفا   دوباره تلاش کنید.');
        }
       
    }



    public function uploadFiles(UploadedFile $file, string $directory)
    {
        $randomNumber = random_int(100, 9999);
        $filename = time() . '-' . $randomNumber .'.' . $file->getClientOriginalExtension();
        $file->move(public_path($directory), $filename);
        
        return $filename;
    }

    public function uploadImageName(Request $request)
    {
        $request->validate([
            'image' => 'required|file|mimes:jpeg,png,jpg',
        ]);

        $imageName = $this->uploadFiles($request->file('image'), 'Images/Category');

        return response()->json(['success' => true, 'imageName' => $imageName]);
    }


    public function deleteImage(Request $request)
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
    
}


