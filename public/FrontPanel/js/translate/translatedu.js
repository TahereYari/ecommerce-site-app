const translations = {
    'en': {
        'p-t': 'zahra azizi',
        'po-t': 'profile',
        'p-s':'settings',
        'dash':'dashboard',
        'profile-':'Profile',
        'pro':'Products',
        'cart':'Cart',
        'ticket-d': 'Ticket',
        'msg':'messages',
        'support':'support',
        'seti':'setings',
        'up':'Update',
        'sc':'Security Update',
        'u-o':'Public Update',
        'u-k':' update',
        'pendingUsers': 'Wallet',
        'activeUsers': 'Orders',
        'dormantUsers': 'Financial',
        'deletedUsers': 'Support ticket',
        'justified-tab-0': 'List of recent orders',
        'justified-tab-2' :  'Results of the competition',
        'sh': 'Id ',
        'np': 'Name',
        'q': 'Quantity ',
        'p': 'Price',
        's': 'Status',
        'li': 'license',
        'lo': 'Pending',
        'id': 'Id',
        't': 'Issue',
        'd': 'date',
        'st': 'Status',
        'j': 'Answer',
        'py' : 'Python',
        're' : 'Pending',
        'd-q' : 'Display the answer to the quiz',
        't-m' : 'Todays Match',
        'w-p': 'What will be the output of the Python code below?',
        'f-q' : 'Upload the answer to be checked',
        'fileButton-2' : 'file upload',
        'r-s': 'subscription',
        'f-s': 'free services',
        's-s': 'To place an order, place your request',
        'fileButton': 'Place the order'
    },
    'fa': { 
        'p-t': 'زهرا عزیزی ',
        'po-t': 'پروفایل',
        'p-s':'تنطیمات',
        'dash':'داشبورد',
        'profile-':'پروفایل',
        'pro':'محصولات',
        'cart':'سبد خرید',
        'ticket-d': 'تیکت',
        'msg':'پیام ها',
        'support':'پشتیبانی',
        'seti':'تنطیمات',
        'up':'بروزرسانی',
        'sc':'بروزرسانی امنیتی',
        'u-o':'بروزرسانی عمومی',
        'u-k':'بروزرسانی کنید',
        'pendingUsers': 'کیف پول',
        'activeUsers': 'سفارشات',
        'dormantUsers': 'مالی',
        'deletedUsers': 'بلیط پشتیبانی',
        'justified-tab-0': 'لیست سفارشات اخیر',
        'justified-tab-2' :  'نتایج مسابقه',
        'sh': 'شناسه ',
        'np': 'نام ',
        'q': 'تعداد ',
        'p': 'قیمت',
        's': 'وضعیت',
        'li': 'لایسنس',
        'lo': 'درحال فعالسازی',
        'id': 'ایدی',
        't': 'موضوع',
        'd': 'تاریخ',
        'st': 'وضعیت',
        'j': 'جواب',
        'py' : 'پایتون',
        're': 'در حال بررسی',
        'd-q' : 'نمایش پاسخ مسابقه',
        't-m' : 'مسابقه امروز',
        'w-p': 'خروجی کد پایتون زیر چه خواهد بود؟',
        'f-q' :'پاسخ سوال را آپلود کنید تا بررسی شود',
        'fileButton-2' :  'ثبت درخواست',
        'r-s': 'اشتراک باقی مانده',
        'f-s': 'خدمات رایگان',
        's-s': 'در صورت ثبت سفارش، درخواست خود را ثبت کنید',
        'fileButton': 'اپلود فایل'
  
    }
};

function switchLanguage(lang) {
    
    document.getElementById('p-t').textContent = translations[lang]['p-t'];
    document.getElementById('po-t').textContent = translations[lang]['po-t'];
    document.getElementById('p-s').textContent = translations[lang]['p-s'];
    document.getElementById('dash').textContent = translations[lang]['dash'];
    document.getElementById('profile-').textContent = translations[lang]['profile-'];
    document.getElementById('pro').textContent = translations[lang]['pro'];
    document.getElementById('cart').textContent = translations[lang]['cart'];
    document.getElementById('ticket-d').textContent = translations[lang]['ticket-d'];
    document.getElementById('msg').textContent = translations[lang]['msg'];
    document.getElementById('support').textContent = translations[lang]['support'];
    document.getElementById('seti').textContent = translations[lang]['seti'];
    document.getElementById('up').textContent = translations[lang]['up'];
    document.getElementById('sc').textContent = translations[lang]['sc'];
    document.getElementById('u-o').textContent = translations[lang]['u-o'];
    document.getElementById('u-k').textContent = translations[lang]['u-k'];
    document.getElementById('pendingUsers').textContent = translations[lang]['pendingUsers'];
    document.getElementById('activeUsers').textContent = translations[lang]['activeUsers'];
    document.getElementById('dormantUsers').textContent = translations[lang]['dormantUsers'];
    document.getElementById('deletedUsers').textContent = translations[lang]['deletedUsers'];
    document.getElementById('justified-tab-0').textContent = translations[lang]['justified-tab-0'];
    document.getElementById('justified-tab-2').textContent = translations[lang]['justified-tab-2'];
    document.getElementById('sh').textContent = translations[lang]['sh'];
    document.getElementById('np').textContent = translations[lang]['np'];
    document.getElementById('q').textContent = translations[lang]['q'];
    document.getElementById('p').textContent = translations[lang]['p'];
    document.getElementById('s').textContent = translations[lang]['s'];
    document.getElementById('li').textContent = translations[lang]['li'];
    document.getElementById('lo').textContent = translations[lang]['lo'];
    document.getElementById('id').textContent = translations[lang]['id'];
    document.getElementById('t').textContent = translations[lang]['t'];
    document.getElementById('d').textContent = translations[lang]['d'];
    document.getElementById('st').textContent = translations[lang]['st'];
    document.getElementById('j').textContent = translations[lang]['j'];
    document.getElementById('py').textContent = translations[lang]['py'];
    document.getElementById('re').textContent = translations[lang]['re'];
    document.getElementById('d-q').textContent = translations[lang]['d-q'];
    document.getElementById('t-m').textContent = translations[lang]['t-m'];
    document.getElementById('w-p').textContent = translations[lang]['w-p'];
    document.getElementById('f-q').textContent = translations[lang]['f-q'];
    document.getElementById('fileButton-2').textContent = translations[lang]['fileButton-2'];
    document.getElementById('r-s').textContent = translations[lang]['r-s'];
    document.getElementById('f-s').textContent = translations[lang]['f-s'];
    document.getElementById('s-s').textContent = translations[lang]['s-s'];
    document.getElementById('fileButton').textContent = translations[lang]['fileButton'];

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