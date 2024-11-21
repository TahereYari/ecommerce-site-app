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
        'des': 'Description',
        'category': 'Category',
        'n-m': 'Name products',
        'p-p': 'Price products',
        'free': 'Free',
        'subscription-type': 'Type of Subscription',
        'cost': 'cost',
        'add-moree': 'Add',
        'license-duration': 'License Duration',
        'license-type': 'License Type ',
        'licensess': 'Licenses',
        'submit' : 'Submit',
        'name':'Name',
        'price':'Price',
        'description':'Description',
        'category':'Category',
        'subscription': 'Subscription',
        'coast':'Coast',
        'duration':'Duration',
        'type':'Type',
        'lic': 'license',
        'ml': '6 months license',
        'categorys': 'category',
        'subs': 'Game license',
        'month': '6 months',
        'typee': 'license',
        'add-new': 'Add New Item',
        'lice': 'license',
        'addNewItemModalLabel':'Add New Item',
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
        'des': 'توضیحات',
        'daste-bandi': 'دسته بندی',
        'n-m': 'نام محصولات',
        'p-p': 'قیمت محصولات',
        'free': 'رایگان',
        'subscription-type': 'نوع اشتراک',
        'cost': 'قیمت',
        'add-moree': 'اضافه کردن',
        'license-duration': 'مدت لایسنس',
        'license-type': 'نوع لایسنس',
        'licensess': 'لایسنس',
        'submit' : 'ثبت',
        'name':'نام',
        'price':'قیمت',
        'description':'توضیحات',
        'category':'دسته بندی',
        'subscription': 'اشتراک',
        'coast':'قیمت ',
        'duration':'مدت',
        'type':'نوع',
        'lic': 'لایسنس',
        'ml': 'اشتراک 6ماهه',
        'categorys': 'ها دسته بندی',
        'subs': 'لایسنس بازی',
        'month': '6ماهه',
        'typee': 'لایسنس',
        'add-new': 'اضافه کردن',
        'lice': 'لایسنس',
        'addNewItemModalLabel':'اضافه کردن',
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
    document.getElementById('des').textContent = translations[lang]['des'];  
    document.getElementById('daste-bandi').textContent = translations[lang]['category'];   
    document.getElementById('n-m').placeholder = translations[lang]['n-m'];
    document.getElementById('p-p').placeholder = translations[lang]['p-p'];
    document.getElementById('subscription-type').placeholder = translations[lang]['subscription-type'];   
    document.getElementById('cost').placeholder = translations[lang]['cost'];  
    document.getElementById('license-duration').placeholder = translations[lang]['license-duration']; 
    document.getElementById('license-type').placeholder = translations[lang]['license-type']; 
    document.getElementById('free').textContent = translations[lang]['free']; 
    document.getElementById('licensess').textContent = translations[lang]['licensess']; 
    document.getElementById('submit').textContent = translations[lang]['submit']; 
    document.getElementById('add-moree').textContent = translations[lang]['add-moree']; 
    document.getElementById('name').textContent = translations[lang]['name']; 
    document.getElementById('price').textContent = translations[lang]['price']; 
    document.getElementById('description').textContent = translations[lang]['description']; 
    document.getElementById('category').textContent = translations[lang]['category']; 
    document.getElementById('subscription').textContent = translations[lang]['subscription']; 
    document.getElementById('coast').textContent = translations[lang]['coast']; 
    document.getElementById('duration').textContent = translations[lang]['duration']; 
    document.getElementById('type').textContent = translations[lang]['type']; 
    document.getElementById('lic').textContent = translations[lang]['lic']; 
    document.getElementById('ml').textContent = translations[lang]['ml']; 
    document.getElementById('categorys').textContent = translations[lang]['categorys']; 
    document.getElementById('subs').textContent = translations[lang]['subs']; 
    document.getElementById('month').textContent = translations[lang]['month']; 
    document.getElementById('typee').textContent = translations[lang]['typee']; 
    document.getElementById('add-new').textContent = translations[lang]['add-new']; 
    document.getElementById('lice').textContent = translations[lang]['lice']; 
    document.getElementById('addNewItemModalLabel').textContent = translations[lang]['addNewItemModalLabel']; 
    document.getElementById('users_').textContent = translations[lang]['users_'];
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
