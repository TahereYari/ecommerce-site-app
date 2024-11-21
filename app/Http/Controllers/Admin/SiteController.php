<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;
use Throwable;

class SiteController extends Controller
{
    public function siteCreate() {
        $siteCount =Site::count();
        if ($siteCount == 0) {
            return view('Admin.Rushsun.siteCreate');
        } else {
            $site = Site::orderByDESC('created_at')->first();
            
           return view('Admin.Rushsun.siteEdit',['site' =>$site]);
        }
        
        
    }

    public function siteInsert(Request $request) {
        try {
            $site =new Site();

            $request->validate([
                'name' => 'required|string|max:255',
                // 'tel' => 'numeric|digits:11',
                // 'experience' => 'numeric',
                // 'completed_projects' => 'numeric',
            ]);

            $site->name = $request->name;
            $site->tel = $request->tel;
            $site->experience = $request->experience;
            $site->completed_projects = $request->completed_projects;
            $site->email = $request->email;
            $site->instagram = $request->instagram;
            $site->tweeter = $request->tweeter;
            $site->facebook = $request->facebook;
            $site->telegram = $request->telegram;
            $site->address = $request->address;
            $site->descirbe = $request->description;
            $site->image = $request->image_name;

            $site->save();

            $title = __('messages.site_added_title');
            $message = __('messages.site_added_message');
            Alert::html($title, $message, 'success')->persistent(true);

            return redirect()->route('admin');
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




    public function siteUpdate(Request $request,$id) {
        
        try {
            $site = Site::findorfail($id);

            $site->name = $request->name;
            $site->tel = $request->tel;
            $site->experience = $request->experience;
            $site->completed_projects = $request->completed_projects;
            $site->email = $request->email;
            $site->instagram = $request->instagram;
            $site->tweeter = $request->tweeter;
            $site->facebook = $request->facebook;
            $site->telegram = $request->telegram;
            $site->address = $request->address;
            $site->descirbe = $request->description;
            $site->image = $request->image_name;

            $site->update();
            
            $title = __('messages.site_update_title');
            $message = __('messages.site_update_message');
            Alert::html($title, $message, 'success')->persistent(true);

            return redirect()->route('admin');
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

        $imageName = $this->uploadFiles($request->file('image'), 'Images/Site');
      

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
