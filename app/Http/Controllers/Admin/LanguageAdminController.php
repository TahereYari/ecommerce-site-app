<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class LanguageAdminController extends Controller
{
    public function switchLanguage($lang)
    {
       
        // بررسی اینکه زبان معتبر است یا خیر
        $supportedLocales = ['en', 'fa'];
        if (!in_array($lang, $supportedLocales)) {
            $lang = 'en';
        }

        // ذخیره زبان در کوکی با مدت زمان اعتبار تعیین شده (مثلاً یک سال)
        Cookie::queue('AdminLanguage', $lang, 60 * 24 * 365); // کوکی با مدت زمان یک سال
        session(['AdminLanguage' =>$lang]);
        // تنظیم زبان اپلیکیشن
        App::setLocale($lang);
       

        return response()->json(['status' => 'success']);
    }


    public function getLanguage(Request $request)
    {
        $language = $request->cookie('AdminLanguage', 'en'); // 'en' به عنوان زبان پیش‌فرض در صورت نبود کوکی
        
        return response()->json(['language' => $language]);
    }
}
