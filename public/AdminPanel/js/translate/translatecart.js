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
        'shopping': 'Shopping Bag',
        'format': 'Format',
        'quantity':'Quantity',
        'price':'Price',
        'game':'License game',
        'made':'Custom made',
        'digital':'Digital',
        'captcha':'Enter the CAPTCHA:',
        'code':'Enter discount code:',
        'submit-c': 'Apply',
        'submit-ca':'Submit',
        'zarin':'zarin pal',
        'pasargad':'Pasargad',
        'paypal':'PayPal',
        'typeName':'Name on card',
        'typeExp':' Expiration',
        'cardNumber': 'Card Number',
        'subtotal': 'Subtotal',
        'tax':' tax',
        'total':'Total (tax included)',
        'checkout': 'Checkout',
        
        
        
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
        'shopping': 'سبد خرید',
        'format': 'قالب',
        'quantity':'تعداد',
        'price':'قیمت',
        'game':'لایسنس بازی',
        'made':'سفارشی ',
        'digital':'دیجیتال',
        'captcha':'CAPTCHA را وارد کنید:',
        'code': 'کد تخفیف را وارد کنید:',
        'submit-c':'ثبت',
        'submit-ca':'ثبت',
        'zarin':'زرین پال',
        'pasargad':'پاسارگاد',
        'paypal':'پیپل',
        'typeName':'نام روی کارت',
        'typeExp': 'انقضاء',
        'cardNumber': 'شماره کارت',
        'subtotal':' جمع فرعی ',
        'tax' : 'مالیات',
        'total': 'کل (با احتساب مالیات)',
        'checkout': 'جمع کل',
        
        

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
    document.getElementById('shopping').textContent = translations[lang]['shopping'];
    document.getElementById('format').textContent = translations[lang]['format'];
    document.getElementById('quantity').textContent = translations[lang]['quantity'];
    document.getElementById('price').textContent = translations[lang]['price'];
    document.getElementById('game').textContent = translations[lang]['game'];
    document.getElementById('made').textContent = translations[lang]['made'];
    document.getElementById('digital').textContent = translations[lang]['digital'];
    document.getElementById('captcha').textContent = translations[lang]['captcha'];
    document.getElementById('code').textContent = translations[lang]['code'];
    document.getElementById('submit-c').value = translations[lang]['submit-c'];
    document.getElementById('submit-ca').value = translations[lang]['submit-ca'];
    document.getElementById('zarin').textContent = translations[lang]['zarin'];
    document.getElementById('pasargad').textContent = translations[lang]['pasargad'];
    document.getElementById('paypal').textContent = translations[lang]['paypal'];
    document.getElementById('typeName').placeholder = translations[lang]['typeName'];
    document.getElementById('typeExp').placeholder = translations[lang]['typeExp'];
    document.getElementById('cardNumber').placeholder = translations[lang]['cardNumber'];
    document.getElementById('subtotal').textContent = translations[lang]['subtotal'];  
    document.getElementById('tax').textContent = translations[lang]['tax'];
    document.getElementById('total').textContent = translations[lang]['total'];
    document.getElementById('checkout').textContent = translations[lang]['checkout']; 
     
    

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