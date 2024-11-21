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
        
        
        'licenses': 'Licenses',
        'users_': 'Users',
        'section__titlee': 'New Products',
        'work__title': 'Web design',
        'see-more': 'See More',
        'services__modal-title':'Product Designer',
        'services__modal-description': 'Up to 6 months of free support after project completion in case of any issues or bugs',
        'services_modal-info': 'We design the site according to your taste',
        'services_modal-infoo': 'One month free SEO.',
        'services_modal-iinfo': 'The ability to connect the website to the mobile app and other apps...',
        'services_modaal-info': 'Free hosting and domain',
        'seervices_modal-info': 'Free consultation during implementation',
        'servicess_modal-info': 'Responsive and dedicated website design',
        'buy': 'Buy',
        'app':'App Mobile',
        'services_button': 'See More',
        'services_modal-title': 'Product Designer',
        'services_modal-description': 'One of the best services of Rushsan company in the field of software design is one year of free support for all application services.',
        'services_modal--info': 'free consultation',
        'services_modal--infoo':'Dedicated user interface',
        'services_modal-innfo': 'Security software',
        'services-modaal-info': ' Native application design',
        'servicess--modal-info': 'Fast support',
        'buy_': 'Buy',
        'work_title': 'Telegram bot',
        'services__button': 'See More',
        'services_modaal-description': 'Telegram bot design can be done with php, python and other programming languages ​​like websites.\nTherefore, almost all the facilities that can be designed and used in websites are also available in Telegram bots.',
        'modal-title': 'Product Designer',
        'modal-info': 'Cheap and affordable',
       '_modal-info': 'Easy Access',
       '_modal-iinfo': 'Compatible with all Android and iOS operating systems',
       '_modaal-info':  'Many features and capabilities',
       '_moodal-info': 'Fast support',
       'buy_t': 'Buy',
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
        
        'licenses': 'لایسنس',
        'users_': 'کاربران',
        'section__titlee': 'محصولات جدید ',
        'work__title': 'طراحی سایت',
        'see-more': 'توضیحات بیشتر',
        'services__modal-title':'طراح محصول',
        'services__modal-description': 'تا 6 ماه پشتیبانی رایگان پس از اتمام پروژه در صورت بروز هرگونه مشکل یا باگ',
        'services_modal-info': 'ما سایت را مطابق سلیقه شما طراحی می کنیم',
        'services_modal-infoo': 'یک ماه سئو رایگان',
        'services_modal-iinfo': 'قابلیت اتصال وبسایت به اپ موبایل و اپ های دیگر ...',
        'services_modaal-info': 'هاست و دامنه رایگان',
        'seervices_modal-info': 'مشاوره رایگان در حین اجرا',
        'servicess_modal-info': 'طراحی سایت ریسپانسیو و اختصاصی',
        'buy':'خرید',
        'app':'اپ موبایل',
        'services_button': 'توضیحات بیشتر',
        'services_modal-title': 'طراح محصول',
        'services_modal-description': 'یکی از بهترین خدمات شرکت راشسان در زمینه طراحی نرم افزار، یک سال پشتیبانی رایگان از کلیه خدمات اپلیکیشن می باشد.',
        'services_modal--info': 'مشاوره رایگان',
        'services_modal--infoo': 'رابط کاربری اختصاصی',
        'services_modal-innfo': 'نرم افزار امنیتی',
        'services-modaal-info': ' طراحی اپلیکیشن بومی',
        'servicess--modal-info': 'پشتیبانی سریع',
        'buy_':'خرید',
        'work_title': 'ربات تلگرام',
        'services__button': 'توضیحات بیشتر',
        'services_modaal-description': 'طراحی ربات تلگرام با php، python و سایر زبان های برنامه نویسی مانند وب سایت ها قابل انجام است.\n بنابراین تقریباً تمامی امکانات قابل طراحی و استفاده در وب سایت ها در ربات های تلگرام نیز موجود است.',
        'modal-title': 'طراح محصول',
        'modal-info': 'ارزان و مقرون به صرفه',
        '_modal-info': 'دسترسی آسان',
        '_modal-iinfo': 'سازگار با تمامی سیستم عامل های اندروید و iOS',
        '_modaal-info': 'امکانات و قابلیت های زیاد',
        '_moodal-info': 'پشتیبانی سریع',
        'buy_t':'خرید',
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
    
    document.getElementById('up').textContent = translations[lang]['up'];
    document.getElementById('sc').textContent = translations[lang]['sc'];
    document.getElementById('u-o').textContent = translations[lang]['u-o'];
    document.getElementById('u-k').textContent = translations[lang]['u-k'];
    document.getElementById('support').textContent = translations[lang]['support'];
    document.getElementById('seti').textContent = translations[lang]['seti'];
    
    
   
   
    document.getElementById('section__titlee').textContent = translations[lang]['section__titlee'];
    document.getElementById('work__title').textContent = translations[lang]['work__title'];
    document.getElementById('services__modal-title').textContent = translations[lang]['services__modal-title'];
    document.getElementById('services__modal-description').textContent = translations[lang]['services__modal-description'];
    document.getElementById('services_modal-info').textContent = translations[lang]['services_modal-info'];
    document.getElementById('services_modal-infoo').textContent = translations[lang]['services_modal-infoo'];
    document.getElementById('services_modal-iinfo').textContent = translations[lang]['services_modal-iinfo'];
    document.getElementById('services_modaal-info').textContent = translations[lang]['services_modaal-info'];
    document.getElementById('servicess_modal-info').textContent = translations[lang]['servicess_modal-info'];
    document.getElementById('app').textContent = translations[lang]['app'];
    document.getElementById('services_modal-title').textContent = translations[lang]['services_modal-title'];
    document.getElementById('services_modal-description').textContent = translations[lang]['services_modal-description'];
    document.getElementById('services_button').innerHTML = `${translations[lang]['services_button']} <i class="ri-arrow-left-fill"></i>`;
    document.getElementById('services_modal--info').textContent = translations[lang]['services_modal--info'];
    document.getElementById('services_modal--infoo').textContent = translations[lang]['services_modal--infoo'];
    document.getElementById('services_modal-innfo').textContent = translations[lang]['services_modal-innfo'];
    document.getElementById('services-modaal-info').textContent = translations[lang]['services-modaal-info'];
    document.getElementById('servicess--modal-info').textContent = translations[lang]['servicess--modal-info'];
    document.getElementById('buy_').innerHTML = `${translations[lang]['buy_']} <i class="ri-shopping-basket-fill"></i>`;
    document.getElementById('work_title').textContent = translations[lang]['work_title'];
    document.getElementById('services__button').innerHTML = `${translations[lang]['services__button']} <i class="ri-arrow-left-fill"></i>`;
    document.getElementById('services_modaal-description').textContent = translations[lang]['services_modaal-description'];
    const descriptionElement = document.getElementById('home__description');
    const descriptionText = translations[lang]['home__description'];
    document.getElementById('services_modaal-description').innerHTML = translations[lang]['services_modaal-description'].replace(/\n/g, '<br>');
    document.getElementById('modal-title').textContent = translations[lang]['modal-title'];
    document.getElementById('modal-info').textContent = translations[lang]['modal-info'];
    document.getElementById('_modal-info').textContent = translations[lang]['_modal-info'];
    document.getElementById('_modal-iinfo').textContent = translations[lang]['_modal-iinfo'];
    document.getElementById('_modaal-info').textContent = translations[lang]['_modaal-info'];
    document.getElementById('_moodal-info').textContent = translations[lang]['_moodal-info'];
    document.getElementById('see-more').innerHTML = `${translations[lang]['see-more']} <i class="ri-arrow-left-fill"></i>`;
    document.getElementById('buy').innerHTML = `${translations[lang]['buy']} <i class="ri-shopping-basket-fill"></i>`;
    document.getElementById('buy_t').innerHTML = `${translations[lang]['buy_t']} <i class="ri-shopping-basket-fill"></i>`;




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