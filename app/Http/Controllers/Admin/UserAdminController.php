<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Messages;
use App\Models\User;
use App\Notifications\DeleteUserNotification;
use App\Notifications\NewUserNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Role;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Throwable;

class UserAdminController extends Controller
{
    function userList(){
        try {
            $users = User::where('deleteStatuse','0')->orderBy('created_at', 'desc')->get();
            $roles = Role::all();
    
            return view('Admin.User.userList',[
                'users' =>$users,
                'roles' =>$roles,
            ]);
        } catch (Throwable $th) {
            return abort(403, 'مشکلی پیش آمده لطفا   دوباره تلاش کنید.');
        }
     
    }
    function userCreate(){
        try {
            $roles = Role::all();
            return view('Admin.User.createUser',[
                'roles' =>$roles
            ]);
        } catch (Throwable $th) {
            return abort(403, 'مشکلی پیش آمده لطفا   دوباره تلاش کنید.');
        }
      
    }


    function userinsert(Request $request){
      try {
       
        $user = new User();
        
        $request->validate([
         'name' => 'required|string|max:255',

         'email' => [
            'required',
            'string',
            'email',
            'max:255',
            Rule::unique('users')->where(function ($query) {
             
                return $query->where('deleteStatuse', 0);
            }),
        ],
         'password' => 'required|min:6|confirmed',

         'tel' =>  ['numeric','digits:11',
         Rule::unique('users')->where(function ($query) {
             return $query->where('deleteStatuse', 0);
         }),
        ],
         
         'national_code' =>  ['numeric','digits:11',
         Rule::unique('users')->where(function ($query) {
             return $query->where('deleteStatuse', 0);
         }),
        ],

        //  'image'=>'mimes:png,jpg,jpeg|max:500',
         
         'rolename' => 'required|string|exists:roles,name'
        ]);
        
      

        $user->name =$request->name;
        $user->email =$request->email;
        $user->role =$request->rolename;
        $user->image= $request->image_name;
        $user->password =Hash::make($request->password);
        $user->tel =$request->tel;
        $user->national_code =$request->national_code;

        $user->save();
        
         // اختصاص نقش به کاربر
     

        $user->assignRole($request->rolename);

        $title = __('messages.user_added_title');
        $message = __('messages.user_added_message');
        Alert::html($title, $message, 'success')->persistent(true);

        $user->notify(new NewUserNotification( $user));
        
        return redirect()->route('user_list');
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

    



    function userUpdate(Request $request , $id) {
        try {

            $user = User::findorfail($id);

            if ($request->name || $request->rolename) {
                $request->validate([
                    'name' => 'required|string|max:255',
                    'rolename' => 'required|string|exists:roles,name'
                   ]);
            }

            
            if (($request->rolename && $request->rolename != $user->name)||
             ($request->rolename && $request->rolename != $user->label)) {
                $request->validate([
                    'name' => 'required|string|max:255',
                    'rolename' => 'required|string|exists:roles,name'
                   ]);

                  DB::table('model_has_roles')->where('model_id',$id)->delete();
                   
            }
   
            
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
                    'tel' => ['numeric','digits:11',
                    Rule::unique('users')->ignore($user->id)->where(function ($query) {
                        return $query->where('deleteStatuse', 0);
                    }),
                ],
                   ]);
            }

           
            if ($request->national_code && $request->national_code != $user->national_code) {
                $request->validate([
                    'national_code' => ['numeric','digits:11',
                    Rule::unique('users')->ignore($user->id)->where(function ($query) {
                        return $query->where('deleteStatuse', 0);
                    }),
                ],
                   ]);
            }

     


         if ($request->password) {
            $request->validate([
                'password' => 'required|min:6|confirmed',
            ]);
            $user->password = Hash::make($request->password);
        }
        
       
        

        $user->name =$request->name;
        $user->email =$request->email;
        $user->role =$request->rolename;
        $user->image =  $request->image_name;
        $user->tel =$request->tel;
        $user->national_code =$request->national_code;

        $user->save();

         // اختصاص نقش به کاربر
     

        $user->assignRole($request->rolename);

        $title = __('messages.user_update_title');
        $message = __('messages.user_update_message');
        Alert::html($title, $message, 'success');

        return redirect()->route('user_list');

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


    public function userDelete($id) {
        try {
          $user = User::findorfail($id);
          $user->deleteStatuse = '1';
          $user->save();
          DB::table('model_has_roles')->where('model_id',$id)->delete();
      
          $title = __('messages.user_delete_title');
          $message = __('messages.user_delete_message');

          Alert::html($title, $message, 'success')->persistent(true);
          $user->notify(new DeleteUserNotification( $user));
         return redirect()->route('user_list');

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

        $imageName = $this->uploadFiles($request->file('image'), 'Images/User');
      

        return response()->json(['success' => true, 'imageName' => $imageName]);
    }

    function user_profile() {
        try {
           return view('Admin.User.profile');
        } catch (Throwable $th) {
            //throw $th;
        }
    }


    function profileUpdate(Request $request) {
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
                    'tel' => ['numeric','digits:11',
                    Rule::unique('users')->ignore($user->id)->where(function ($query) {
                        return $query->where('deleteStatuse', 0);
                    }),
                ],
                   ]);
            }

           
            if ($request->national_code && $request->national_code != $user->national_code) {
                $request->validate([
                    'national_code' => ['numeric','digits:11',
                    Rule::unique('users')->ignore($user->id)->where(function ($query) {
                        return $query->where('deleteStatuse', 0);
                    }),
                ],
                   ]);
            }

         


        $user->name =$request->name;
        $user->email =$request->email;
        $user->tel =$request->tel;
        $user->image = $request->image_name;
        $user->national_code =$request->national_code;

         $user->update();
        


        $title = __('messages.user_update_title');
        $message = __('messages.user_update_message');
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

    function changePassword()  {
        try {
            return view('Admin.User.changePassword');
         }  catch (Throwable $th) {
            return abort(403, 'مشکلی پیش آمده لطفا   دوباره تلاش کنید.');
         }
    }

    public function profileUpdatePass(Request $request) {
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
            return abort(403, 'مشکلی پیش آمده لطفا دوباره تلاش کنید.');
        }
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
