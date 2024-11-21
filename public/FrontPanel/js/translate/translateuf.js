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
        'f-m': 'Form Users',
        'f-l': 'FullName',
        'category': 'Category',
        'n-m': 'Email',
        'p-p': 'National Code',
        'ph': 'Phone Number',
        'pass': 'Password',
        'sub' : 'Submit',
        'mf': 'Management',
        'licenses': 'Licenses',
        'passc': 'Repeat password',
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
        'support':'پشتیبانی',
        'seti':'تنطیمات',
        'up':'بروزرسانی',
        'sc':'بروزرسانی امنیتی',
        'u-o':'بروزرسانی عمومی',
        'u-k':'بروزرسانی کنید',
        'f-m': 'فرم کاربران ',
        'f-l': 'نام و نام خانوادگی',
        'category': 'دسته بندی',
        'n-m': 'ایمیل',
        'p-p': ' کد ملی',
        'ph': 'شماره تماس',
        'pass': 'پسوورد',
        'sub' : 'ثبت',
        'mf': 'فرم مدیریت',
        'licenses': 'لایسنس',
        'passc': 'تکرار پسوورد',
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
    
    document.getElementById('up').textContent = translations[lang]['up'];
    document.getElementById('sc').textContent = translations[lang]['sc'];
    document.getElementById('u-o').textContent = translations[lang]['u-o'];
    document.getElementById('u-k').textContent = translations[lang]['u-k'];
    document.getElementById('f-m').textContent = translations[lang]['f-m']; 
    document.getElementById('category').textContent = translations[lang]['category'];   
    document.getElementById('f-l').placeholder = translations[lang]['f-l'];
    document.getElementById('p-p').placeholder = translations[lang]['p-p'];
    document.getElementById('n-m').placeholder = translations[lang]['n-m'];
    document.getElementById('ph').placeholder = translations[lang]['ph'];
    document.getElementById('pass').placeholder = translations[lang]['pass'];
    document.getElementById('passc').placeholder = translations[lang]['passc'];
    document.getElementById('mf').textContent = translations[lang]['mf'];
    document.getElementById('licenses').textContent = translations[lang]['licenses']; 
    document.getElementById('users_').textContent = translations[lang]['users_'];
    document.getElementById('sub').textContent = translations[lang]['sub']; 

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