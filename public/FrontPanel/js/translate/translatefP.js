const translations = {
    'en': {
        'p-t': 'zahra azizi',
        'po-t': 'profile',
        'p-s':'settings',
        'dash':'Dashboard',
        'pro':'Products',
        'f-p':'Products form',
        'f-u':'Users form',
        'm':'Competitions',
        'msg':'Messages',
        'msg':'Messages',
        'mf': 'Management',
        'support':'Support',
        'seti':'Setings',
        'up':'Update',
        'sc':'Security Update',
        'u-o':'Public Update',
        'u-k':' update',
        'new': 'New',
        'name': 'product name',
        'category':'category',
        'esh':'subscriptions',
        'buy': 'Buy',
        'product': 'Products',
        'license': 'Licenses name',
        'category-license': 'Category',
        'buy-license': 'Buy',
        'f-m': 'Forms Products',
        'des': 'Description',
        'category': 'Category',
        'n-m': 'Name products',
        'p-p': 'Price products',
        'free': 'Free',
        'license': 'license',
        'subscription-type': 'Type of Subscription',
        'cost': 'cost',
        'add-moree': 'Add',
        'license-duration': 'License Duration',
        'license-type': 'License Type ',
        'licenses': 'Licenses',
        'submit' : 'Submit',
        'upload-file': 'upload file',
        'upload-image': 'upload image',
        'upload-video': 'upload video',
        'fileDescription': 'No file selected',
        'Start-uploading': 'Start uploading',
        'users_': 'Users'
    },
    'fa': { 
        'p-t': 'زهرا عزیزی ',
        'po-t': 'پروفایل',
        'p-s':'تنطیمات',
        'dash':'داشبورد',
        'pro':'محصولات',
        'f-p':'فرم محصولات',
        'f-u':'فرم کاربران',
        'm':'مسابقات',
        'msg':'پیام ها',
        'mf': 'فرم مدیریت',
        'support':'پشتیبانی',
        'seti':'تنطیمات',
        'up':'بروزرسانی',
        'sc':'بروزرسانی امنیتی',
        'u-o':'بروزرسانی عمومی',
        'u-k':'بروزرسانی کنید',
        'f-m': 'فرم محصولات ',
        'des': 'توضیحات',
        'category': 'دسته بندی',
        'n-m': 'نام محصولات',
        'p-p': 'قیمت محصولات',
        'free': 'رایگان',
        'license': 'لایسنس',
        'subscription-type': 'نوع اشتراک',
        'cost': 'قیمت',
        'add-moree': 'اضافه کردن',
        'license-duration': 'مدت لایسنس',
        'license-type': 'نوع لایسنس',
        'licenses': 'لایسنس',
        'submit' : 'ثبت',
        'upload-file': 'بارگذاری فایل',
        'upload-image': 'بارگذاری عکس',
        'upload-video': 'بارگذاری ویدیو ',
        'fileDescription': 'هیچ فایلی انتخاب نشده است',
        'Start-uploading': 'شروع بارگذاری',
        'users_': 'کاربران'
    }
};

function switchLanguage(lang) {
    
    document.getElementById('p-t').textContent = translations[lang]['p-t'];
    document.getElementById('po-t').textContent = translations[lang]['po-t'];
    document.getElementById('p-s').textContent = translations[lang]['p-s'];
    document.getElementById('dash').textContent = translations[lang]['dash'];
    document.getElementById('pro').textContent = translations[lang]['pro'];
    document.getElementById('f-p').textContent = translations[lang]['f-p'];
    document.getElementById('f-u').textContent = translations[lang]['f-u'];
    document.getElementById('m').textContent = translations[lang]['m'];
    document.getElementById('msg').textContent = translations[lang]['msg'];
    document.getElementById('mf').textContent = translations[lang]['mf'];
    
    document.getElementById('up').textContent = translations[lang]['up'];
    document.getElementById('sc').textContent = translations[lang]['sc'];
    document.getElementById('u-o').textContent = translations[lang]['u-o'];
    document.getElementById('u-k').textContent = translations[lang]['u-k'];
    document.getElementById('f-m').textContent = translations[lang]['f-m'];
    document.getElementById('des').textContent = translations[lang]['des'];  
    document.getElementById('category').textContent = translations[lang]['category'];   
    document.getElementById('n-m').placeholder = translations[lang]['n-m'];
    document.getElementById('p-p').placeholder = translations[lang]['p-p'];
    document.getElementById('subscription-type').placeholder = translations[lang]['subscription-type'];   
    document.getElementById('cost').placeholder = translations[lang]['cost'];  
    document.getElementById('license-duration').placeholder = translations[lang]['license-duration']; 
    document.getElementById('license-type').placeholder = translations[lang]['license-type']; 
    document.getElementById('free').textContent = translations[lang]['free']; 
    document.getElementById('license').textContent = translations[lang]['license']; 
    document.getElementById('licenses').textContent = translations[lang]['licenses']; 
    document.getElementById('add-moree').textContent = translations[lang]['add-moree']; 
    document.getElementById('upload-file').textContent = translations[lang]['upload-file']; 
    document.getElementById('upload-image').textContent = translations[lang]['upload-image']; 
    document.getElementById('upload-video').textContent = translations[lang]['upload-video'];
    document.getElementById('fileDescription').textContent = translations[lang]['fileDescription'];
    document.getElementById('Start-uploading').textContent = translations[lang]['Start-uploading'];
    document.getElementById('users_').textContent = translations[lang]['users_'];
    document.getElementById('submit').textContent = translations[lang]['submit']; 

    document.documentElement.lang = lang;
    document.body.setAttribute('dir', lang === 'fa' ? 'rtl' : 'ltr');
    localStorage.setItem('lang', lang);
}
// On page load, check if a language is stored in local storage
const storedLang = localStorage.getItem('lang');
if (storedLang) {
    switchLanguage(storedLang);
} else {
    // Default language (e.g., English)
    switchLanguage('en');
}

// Add an event listener to the window object to detect page navigations
window.addEventListener('popstate', function() {
    const storedLang = localStorage.getItem('lang');
    if (storedLang) {
        switchLanguage(storedLang);
    }
});



