const translations = {
    'en': {
        'p-t': 'zahra azizi',
        'po-t': 'profile',
        'p-s':'settings',
        'dash':'Dashboard',
        'profile-':'Profile',
        'pro':'Products',
        'cart': 'Cart',
        'ticket-d': 'Ticket',
        'msg':'Messages',
        'support':'Support',
        'seti':'Setings',
        'up':'Update',
        'sc':'Security Update',
        'u-o':'Public Update',
        'u-k':' update',
        'response': 'Response',
        'submit': 'Submit',
        'ticket-title': 'Ticket title',
        'ticket-text': 'Ticket text:',
        'conversation':'Conversation',
        'name-user':'Sara Shiasi',
        'ask':'I wanted a 6-month hosting, please guide me',
        'name-admin':'Zahra Azizi',
        'answer':'You should choose a host based on how much space the website products take up',
       
        
        
        
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
        'response': 'پاسخ ',
        'submit': 'ثبت',
        'quantity':'تعداد',
        'ticket-title': 'عنوان تیکت',
        'ticket-text': 'متن تیکت:',
        'conversation':'گفتگو ',
        'name-user':'سارا شیاسی',
        'ask':'من هاست 6 ماهه میخواستم لطفا راهنماییم کنید',
        'name-admin': 'زهرا عزیزی',
        'answer':'شما باید بر اساس میزان فضایی که محصولات وب سایت اشغال می کنند، هاست را انتخاب کنید',
        
        
        

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
    document.getElementById('response').textContent = translations[lang]['response'];
    document.getElementById('submit').textContent = translations[lang]['submit'];
    document.getElementById('ticket-title').placeholder = translations[lang]['ticket-title'];
    document.getElementById('ticket-text').placeholder = translations[lang]['ticket-text'];
    document.getElementById('conversation').textContent = translations[lang]['conversation'];
    document.getElementById('name-user').textContent = translations[lang]['name-user'];
    document.getElementById('ask').textContent = translations[lang]['ask'];
    document.getElementById('name-admin').textContent = translations[lang]['name-admin'];
    document.getElementById('answer').textContent = translations[lang]['answer'];
     
     
    

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