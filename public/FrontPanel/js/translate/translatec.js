const translations = {
    'en': {
        'p-t': 'zahra azizi',
        'po-t': 'profile',
        'p-s':'Settings',
        'dash':'Dashboard',
        'pro':'Products',
        'f-p':'Products form',
        'f-u':'Users form',
        'm':'Competitions',
        'msg':'Messages',
        'mf': 'Management',
        'support':'Support',
        'seti':'Setings',
        'up':'Update',
        'sc':'Security Update',
        'u-o':'Public Update',
        'u-k':' Update',
        'new': 'New',
        'name': 'product name',
        'category':'category',
        'esh':'subscriptions',
        'buy': 'Buy',
        'product': 'Products',
        'license': 'Licenses name',
        'category-license': 'Category',
        'buy-license': 'Buy',
        'q-c': 'Quiz question',
        'des': 'Descriptive question text...',
        'p-p': 'Quiz question:',
        'submit' : 'Submit',
        'licenses': 'Licenses',
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
        'mf': 'فرم مدیریت',
        'msg':'پیام ها',
        'support':'پشتیبانی',
        'seti':'تنطیمات',
        'up':'بروزرسانی',
        'sc':'بروزرسانی امنیتی',
        'u-o':'بروزرسانی عمومی',
        'u-k':'بروزرسانی کنید',
        'q-c': 'سوال مسابقه',
        'des': 'متن سوال تشریحی...',   
        'p-p': 'سوال مسابقه:',
        'submit' : 'ثبت',
        'licenses': 'لایسنس',
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
    document.getElementById('q-c').textContent = translations[lang]['q-c'];
    document.getElementById('des').placeholder = translations[lang]['des'];  
    document.getElementById('p-p').placeholder = translations[lang]['p-p'];
    document.getElementById('mf').textContent = translations[lang]['mf'];
    document.getElementById('licenses').textContent = translations[lang]['licenses']; 
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