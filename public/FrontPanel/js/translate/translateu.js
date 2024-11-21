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
        'licensess': 'licenses',       
        'name':'Name',
        'code':'National Code',
        'phone':'phone number',
        'role':'Role',
        'delete': 'Delete',
        'edit':'Edit',
        'duration':'Duration',
        'type':'Type',
        'nama-u': 'zahra',
        'role-a': 'Admin',
        'categorys': 'category',
        'delete-u': 'delete',
        'month': '6 months',
        'typee': 'license',
        'edit-u': 'edit',
        'lice': 'license',
        'addNewItemModalLabel':'edit form users',
        'users_': 'Users',
        'f-l': 'FullName',
        'category': 'Category',
        'n-m': 'Email',
        'p-p': 'National Code',
        'ph': 'Phone Number',
        'pass': 'Password',
        'sub' : 'Submit',
        'passc': 'Repeat password',
        'search': 'Search',
        'exampleModalLabel': 'Modal Delete',
        'modal-body': 'Are you sure you want to delete the user?',
        'close-d': 'Close',
        'delete-d': 'delete',
        'staticBackdropLabel': 'Modal Search',
        's-close': 'Close',
        's-search':'Search',
        'search-s': 'Search...'
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
        'licensess': 'لایسنس',
        'name':'نام',
        'code':'کد ملی',
        'phone':'شماره تلفن',
        'role':'نقش',
        'delete': 'حذف ',
        'edit':'ویرایش ',
        'duration':'مدت',
        'type':'نوع',
        'nama-u': 'زهرا',
        'role-a': 'ادمین',
        'categorys': 'ها دسته بندی',
        'delete-u': 'حذف',
        'month': '6ماهه',
        'typee': 'لایسنس',
        'edit-u': 'ویرایش',
        'lice': 'لایسنس',
        'addNewItemModalLabel':'فرم ویرایش کاربران',
        'users_': 'کاربران',
        'f-m': 'فرم کاربران ',
        'f-l': 'نام و نام خانوادگی',
        'category': 'دسته بندی',
        'n-m': 'ایمیل',
        'p-p': ' کد ملی',
        'ph': 'شماره تماس',
        'pass': 'پسوورد',
        'sub' : 'ثبت',
        'passc': 'تکرار پسوورد',
        'search': 'سرچ',
        'exampleModalLabel': 'مدال حذف',
        'modal-body': 'ایا از حذف کاربر مطمئن هستید',
        'close-d': 'بستن',
        'delete-d': 'حذف',
        'staticBackdropLabel': 'مدال سرچ',
        's-close': 'بستن',
        's-search':'سرچ',
        'search-s': 'سرچ...'
        
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
    document.getElementById('licensess').textContent = translations[lang]['licensess'];
    document.getElementById('up').textContent = translations[lang]['up'];
    document.getElementById('sc').textContent = translations[lang]['sc'];
    document.getElementById('u-o').textContent = translations[lang]['u-o'];
    document.getElementById('u-k').textContent = translations[lang]['u-k'];     
    document.getElementById('sub').textContent = translations[lang]['sub'];  
    document.getElementById('n-m').placeholder = translations[lang]['n-m'];
    document.getElementById('p-p').placeholder = translations[lang]['p-p']; 
    document.getElementById('name').textContent = translations[lang]['name']; 
    document.getElementById('code').textContent = translations[lang]['code']; 
    document.getElementById('phone').textContent = translations[lang]['phone']; 
    document.getElementById('role').textContent = translations[lang]['role']; 
    document.getElementById('delete').textContent = translations[lang]['delete']; 
    document.getElementById('edit').textContent = translations[lang]['edit']; 
    document.getElementById('nama-u').textContent = translations[lang]['nama-u']; 
    document.getElementById('role-a').textContent = translations[lang]['role-a']; 
    document.getElementById('delete-u').textContent = translations[lang]['delete-u']; 
    document.getElementById('edit-u').textContent = translations[lang]['edit-u']; 
    document.getElementById('addNewItemModalLabel').textContent = translations[lang]['addNewItemModalLabel']; 
    document.getElementById('users_').textContent = translations[lang]['users_'];
    document.getElementById('f-m').textContent = translations[lang]['f-m']; 
    document.getElementById('category').textContent = translations[lang]['category'];   
    document.getElementById('f-l').placeholder = translations[lang]['f-l'];
    document.getElementById('p-p').placeholder = translations[lang]['p-p'];
    document.getElementById('n-m').placeholder = translations[lang]['n-m'];
    document.getElementById('ph').placeholder = translations[lang]['ph'];
    document.getElementById('pass').placeholder = translations[lang]['pass'];
    document.getElementById('passc').placeholder = translations[lang]['passc'];
    document.getElementById('search-s').placeholder = translations[lang]['search-s'];
    document.getElementById('search').textContent = translations[lang]['search'];
    document.getElementById('exampleModalLabel').textContent = translations[lang]['exampleModalLabel'];
    document.getElementById('modal-body').textContent = translations[lang]['modal-body'];
    document.getElementById('close-d').textContent = translations[lang]['close-d'];
    document.getElementById('delete-d').textContent = translations[lang]['delete-d'];
    document.getElementById('staticBackdropLabel').textContent = translations[lang]['staticBackdropLabel'];
    document.getElementById('s-close').textContent = translations[lang]['s-close'];
    document.getElementById('s-search').textContent = translations[lang]['s-search'];

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