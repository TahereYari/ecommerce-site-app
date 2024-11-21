<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Throwable;

class RoleController extends Controller
{

    public function roleCreate()
    {
        try {
            $permissions = Permission::all();

            return view('Admin.Role.roleCreate',[
                'permissions'=>$permissions
            ]);
        } catch (Throwable $th) {
            return abort(403, 'مشکلی پیش آمده لطفا   دوباره تلاش کنید.');
        }
      
    }
    
    function roleInsert(Request $request){
        try {
             // اعتبارسنجی داده‌های ورودی
        $request->validate([
            'name' => 'required|string|max:255|unique:roles',
            'permissions' => 'required|array',
            // 'permissions.*' => 'string|in:create,edit,delete,update',
        ]);

        // ایجاد نقش جدید

        $role = Role::create(['name' => $request->name]);
        $permission = $request->permissions;
     
      
        $role->givePermissionTo($permission);
        $title = __('messages.role_added_title');
        $message = __('messages.role_added_message');
        Alert::html($title, $message, 'success');
        return redirect(route('role_list'));
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


    function roleUpdate(Request $request,$id)  {

        try {
            $role = Role::findorfail($id);
           

        if ($request->rolename && $request->rolename != $role->name) {
            $request->validate([
               'name' => 'string|max:255|unique:roles',
               ]);
        }
       
        


        $validated = $request->validate([
            'permissions' => 'required|array',
            'permissions.*' => 'string|exists:permissions,name',
        ]);
      
        $role->name = $request->rolename;
        $permission = $request->permissions;
        
        $role->givePermissionTo($permission);
        $role->syncPermissions($validated['permissions']);
        $role->update();
        $title = __('messages.role_update_title');
        $message = __('messages.role_update_message');
        Alert::html($title, $message, 'success')->persistent(true);

        return redirect(route('role_list'));
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
    public  function roleDelete($id) {
        try {
            $role = Role::findorfail($id);
            $role->delete();
            // $role->syncPermissions($validated['permissions']);
            $title = __('messages.role_delete_title');
            $message = __('messages.role_delete_message');
  
            Alert::html($title, $message, 'success')->persistent(true);
            return redirect(route('role_list'));
        } catch (Throwable $th) {
            return abort(403, 'مشکلی پیش آمده لطفا   دوباره تلاش کنید.');
        }
    }

}
