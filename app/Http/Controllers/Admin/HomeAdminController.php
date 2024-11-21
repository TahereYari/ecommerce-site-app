<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Basket;
use App\Models\Category;
use App\Models\CompetiotionsAnswer;
use App\Models\LicenseRecords;
use App\Models\Messages;
use App\Models\Product;
use App\Models\Ticket;
use App\Models\User;
use Carbon\Carbon;
use Hekmatinasser\Verta\Facades\Verta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Throwable;

class HomeAdminController extends Controller
{

    public function admin()
    {
        // try {
            $todayUserCount = User::whereDate('created_at', now()->toDateString())->count();

            $totalProducts = Product::where('deleteStatuse','0')->count();
            $lastNewUserNotification =DB::table('notifications')
            ->orderBy('created_at', 'desc')
            ->where('type', 'App\\Notifications\\NewUserNotification')
           ->first();

           $lastDeleteUserNotification  =DB::table('notifications')
           ->where('type', 'App\\Notifications\\DeleteUserNotification')
           ->orderBy('created_at', 'desc')
          ->first();

          $openTickets = Ticket::where('status',0)->get();
          $openTicketsCount = Ticket::where('status',0)->count();
          
           //  $notifications = auth()->user()->notifications;
          
          $competionAnswers = CompetiotionsAnswer::whereDate('created_at', now()->toDateString())->get();

          $data =$this->getUserStatistics();
          $totalUsers = $data['total_users'];
          
          $deleted_users = $data['deleted_users'];
          $registered_users = $data['registered_users'];
          $deleted_users_percentage = $data['deleted_users_percentage'];
          
          $registered_users_percentage = $data['registered_users_percentage'];


          $unreadMessageCount = Messages::where('read', false)->count();
         
       
          $messages = Messages::where('read','false')->get();

         $total_revenue = Basket:: selectRaw('SUM(price) as total_sales')
                                    ->pluck('total_sales')->first();

        $lastMonth = Carbon::now()->subMonth()->month;

        $total_revenue_last_month = Basket::whereMonth('created_at', $lastMonth)
        ->selectRaw('SUM(price) as total_sales')
        ->pluck('total_sales')
        ->first();
       
        
           return view('Admin.dashboard',[
               'todayUserCount' => $todayUserCount ,
               'lastNewUserNotification'=> $lastNewUserNotification,
               'lastDeleteUserNotification'=> $lastDeleteUserNotification,
               'registered_users_percentage'=> $registered_users_percentage,
               'deleted_users_percentage'=> $deleted_users_percentage,
               'totalUsers'=> $totalUsers,
               'totalProducts'=> $totalProducts,
               'competionAnswers'=> $competionAnswers,
               'unreadMessageCount'=> $unreadMessageCount,
               'messages'=> $messages,
               'openTickets'=> $openTickets,
               'openTicketsCount'=>  $openTicketsCount,
               'total_revenue'=>  $total_revenue,
                'total_revenue_last_month'=>  $total_revenue_last_month,
                
               
           ]);
        // } catch (Throwable $th) {
        //     return abort(403, 'مشکلی پیش آمده لطفا   دوباره تلاش کنید.');
        // }
     
    }


    
    public function products()
    {
        try {

            $products = Product::where('deleteStatuse','0')->orderBy('created_at', 'desc')->get();
            $categories = Category::where('DeleteStatuse','0')->get();
            return view('Admin.Product.products',[
                'products' =>$products,
                'categories' =>$categories,
            ]);
        } catch (Throwable $th) {
            return abort(403, 'مشکلی پیش آمده لطفا   دوباره تلاش کنید.');
        }
       
    }

    public function roleList()
    {
        try {
            $roles = Role::orderBy('created_at', 'desc')->get();
            $permissions = Permission::all();
    
            return view('Admin.Role.roleList',[
                'roles'=>$roles,
                'permissions'=>$permissions,
            ]);
        } catch (Throwable $th) {
            return abort(403, 'مشکلی پیش آمده لطفا   دوباره تلاش کنید.');
        }
      
    }

    

    public function getUserStatistics()
    {
        // try {
            $totalUsers = User::where('deleteStatuse','0')->count();
           
            $deletedUsers = User::where('deleteStatuse', 1)->count();
            $registeredUsers = $totalUsers - $deletedUsers;
        
            if ($totalUsers == 0) {
                return [
                    'message' => 'No users found',
                    'total_users' => 0,
                    'deleted_users' => 0,
                    'registered_users' => 0,
                    'deleted_users_percentage' => 0,
                    'registered_users_percentage' => 0,
                ];
            }
        
            $deletedUsersPercentage = ($deletedUsers / $totalUsers) * 100;
            $registeredUsersPercentage = ($registeredUsers / $totalUsers) * 100;
        
            return [
                'total_users' => $totalUsers,
                'deleted_users' => $deletedUsers,
                'registered_users' => $registeredUsers,
                'deleted_users_percentage' => $deletedUsersPercentage,
                'registered_users_percentage' => $registeredUsersPercentage,
            ];
        // } catch (Throwable $th) {
        //     return abort(403, 'مشکلی پیش آمده لطفا   دوباره تلاش کنید.');
        // }
      
    }




    public function getMonthlySales(Request $request)
    {
        $lang = $request->query('lang'); // دریافت زبان از پارامترهای درخواست
        $currentYear = now()->year; 
      
        // محاسبه کل فروش بر اساس سال جاری
        $salesData = Basket::where('is_pay', 1)
            ->whereYear('created_at', $currentYear)
            ->selectRaw('MONTH(created_at) as month, SUM(price) as total_sales')
            ->groupByRaw('MONTH(created_at)')
            ->orderByRaw('MONTH(created_at)')
            ->pluck('total_sales', 'month');

        // محاسبه فروش محصولات دارای لایسنس بر اساس سال جاری
        $licensedSalesData = LicenseRecords::whereYear('created_at', $currentYear)
            ->selectRaw('MONTH(created_at) as month, SUM(price) as total_licensed_sales')
           
            ->groupByRaw('MONTH(license_records.created_at)')
            ->orderByRaw('MONTH(license_records.created_at)')
            ->pluck('total_licensed_sales', 'month');

        // مقداردهی اولیه به آرایه‌ای با ۱۲ ماه
        $sales = array_fill(1, 12, 0);
        $licensedSales = array_fill(1, 12, 0);

        // پر کردن داده‌های فروش برای هر ماه
        foreach ($salesData as $month => $totalSales) {
            $sales[$month] = $totalSales;
     

        }
        // پر کردن داده‌های فروش محصولات دارای لایسنس برای هر ماه
        foreach ($licensedSalesData as $month => $totalLicensedSales) {
            $licensedSales[$month] = $totalLicensedSales;
        }

        // اگر زبان فارسی بود، ماه‌ها به شمسی تبدیل شوند
        if ($lang === 'fa') {
            $salesShamsi = [];
            $licensedSalesShamsi = [];
            foreach ($sales as $month => $totalSales) {
                // تبدیل ماه میلادی به ماه شمسی
                $shamsiMonth = verta($currentYear.'-'.$month.'-01')->format('n'); // شماره ماه شمسی
                $salesShamsi[$shamsiMonth] = $totalSales;
           
            }
          
            foreach ($licensedSales as $month => $totalLicensedSales) {
                // تبدیل ماه میلادی به ماه شمسی

                $shamsiMonth = verta($currentYear . '-' . $month . '-01')->format('n'); // شماره ماه شمسی
                $licensedSalesShamsi[$shamsiMonth] = $totalLicensedSales;
            }
           
            return response()->json([
                'sales' => $salesShamsi,
                'licensedSales' => $licensedSalesShamsi
            ]);
        }

        // بازگشت داده‌ها به صورت JSON برای تقویم میلادی
        return response()->json([
            'sales' => $sales,
            'licensedSales' => $licensedSales
        ]);
    }


    
}

