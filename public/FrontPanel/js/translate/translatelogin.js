export const translationsLogin = {
    'en': {
        'sign': 'Sign In',
        'account': 'Create Account',
        'register-':'Use your email to register',
        'button-':'Sign Up',
        'password-e':'Use your email password',
        'email-p':'Email',
        'password-p':'Password',
        'forget':'Forget Your Password?',
        'button-s':'Sign In',
        'text': 'Name',
        'email-l':'Email',
        'password-l':'Password',
        'password-confirm':'Password Confirm',
        'welcome':'Welcome Back!',
        'enter':'Enter your personal details to use all of site features',
        'login': 'Sign In',
        'khosh': 'Hello, Friend!',
        'register-d':'Register with your personal details to use all of site features',
        'register':'Sign Up',
        'tel':'Phone Number',
        
        
    },
    'fa': { 
        'sign': 'ثبت نام',
        'account': 'ایجاد حساب کاربری',
        'register-':'برای ثبت نام از ایمیل خود استفاده کنید',
        'button-':'ثبت نام',
        'password-e':'از رمز عبور ایمیل خود استفاده کنید',
        'email-p':'ایمیل',
        'password-p':'پسوورد',
        'forget':'رمزتان را فراموش کرده اید؟',
        'button-s': 'ورود',
        'text': 'نام',
        'email-l':'ایمیل',
        'password-l':'پسوورد',
        'password-confirm':'تکرار پسورد',
        'welcome':'خوش برگشتی!',
        'enter':'اطلاعات شخصی خود را وارد کنید تا از همه امکانات سایت استفاده کنید',
        'login': 'ورود',
        'khosh': 'سلام دوست من',   
        'register-d': 'برای استفاده از تمامی امکانات سایت، با مشخصات شخصی خود ثبت نام کنید',
        'register' : 'ثبت نام',
        'tel':'شماره تلفن',
        

    }
};

// function switchLanguage(lang) {
    
//     document.getElementById('sign').textContent = translations[lang]['sign'];
//     document.getElementById('account').textContent = translations[lang]['account'];
//     document.getElementById('register-').textContent = translations[lang]['register-'];
//     document.getElementById('button-').textContent = translations[lang]['button-'];
//     document.getElementById('password-e').textContent = translations[lang]['password-e'];
//     document.getElementById('email-p').placeholder = translations[lang]['email-p'];  
//     document.getElementById('password-p').placeholder = translations[lang]['password-p'];   
//     document.getElementById('forget').textContent = translations[lang]['forget'];
//     document.getElementById('button-s').textContent = translations[lang]['button-s'];
//     document.getElementById('text').placeholder = translations[lang]['text'];
//     document.getElementById('email-l').placeholder = translations[lang]['email-l'];
//     document.getElementById('password-l').placeholder = translations[lang]['password-l'];
//     document.getElementById('welcome').textContent = translations[lang]['welcome'];
//     document.getElementById('enter').textContent = translations[lang]['enter'];
//     document.getElementById('login').textContent = translations[lang]['login'];
//     document.getElementById('khosh').textContent = translations[lang]['khosh'];
//     document.getElementById('register-d').textContent = translations[lang]['register-d'];
//     document.getElementById('register').textContent = translations[lang]['register'];
   

    

//     document.documentElement.lang = lang;
//     document.body.setAttribute('dir', lang === 'fa' ? 'rtl' : 'ltr');

//     localStorage.setItem('lang', lang);
// }
// // On page load, check if a language is stored in local storage
// const storedLang = localStorage.getItem('lang');
// if (storedLang) {
//     switchLanguage(storedLang);
// } else {
//     // Default language (e.g., English)
//     switchLanguage('en');
// }

// // Add an event listener to the window object to detect page navigations
// window.addEventListener('popstate', function() {
//     const storedLang = localStorage.getItem('lang');
//     if (storedLang) {
//         switchLanguage(storedLang);
//     }
// }); 