import {translationshome} from './translateHome.js';
import {translationsIndex} from './translateindex.js';
import {translationsLogin} from './translatelogin.js';
import {translationsViewProduct} from './viewProduct.js';
import {translateDashboardUser} from './translateDashboardUser.js';
import {translationsCart} from './translatecart.js';
import {translationsProfile} from './translateprofile.js';
import {translationsTicket} from './translateTicket.js';




const translations = {
    'en': {
        'home': translationshome.en,
        'index': translationsIndex.en,
        'login': translationsLogin.en,
        'viewProduct': translationsViewProduct.en,
        'userDashboard': translateDashboardUser.en,
        'cart': translationsCart.en,
        'profile': translationsProfile.en,
        'ticket': translationsTicket.en,
      
    },
    'fa': {
        'home': translationshome.fa,
        'index': translationsIndex.fa,
        'login': translationsLogin.fa,
        'viewProduct': translationsViewProduct.fa,
        'userDashboard': translateDashboardUser.fa,
        'cart': translationsCart.fa,
        'profile': translationsProfile.fa,
        'ticket': translationsTicket.fa,
       
    }
};


// تابع برای دریافت زبان از کوکی جاوا اسکریپت
function getLanguageFromJsCookie() {
    let name = "language=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for(let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "en"; // 'en' به عنوان زبان پیش‌فرض در صورت نبود کوکی
}

// تابع برای دریافت زبان از کوکی لاراول
function getLanguageFromLaravel() {
    return fetch('/admin/getLanguage')
        .then(response => response.json())
        .then(data => data.language)
        .catch(error => {
            console.error('Error fetching language:', error);
            return 'en'; // 'en' به عنوان زبان پیش‌فرض در صورت وقوع خطا
        });
}


// ذخیره زبان در کوکی جاوا اسکریپت
function setLanguageCookie(lang) {
    const expiryDate = new Date();
    expiryDate.setDate(expiryDate.getDate() + 365);

    // ایجاد کوکی با زبان انتخابی
    document.cookie = `language=${lang}; expires=${expiryDate.toUTCString()}; path=/`;
}




function setLanguageLaravelCookie(lang) {
    fetch('/admin/switchLanguage/' + lang, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => {
        if (response.ok) {
            // location.reload(); // بارگذاری مجدد صفحه برای اعمال تغییرات
        } else {
            console.error('Failed to switch language');
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
    

}

function updateDates(language) {
    const dateCells = document.querySelectorAll('.date-cell');
    dateCells.forEach((cell) => {
        let date = new Date(cell.getAttribute('data-timestamp'));
        
        if (language === 'fa') {
            // تبدیل به تاریخ شمسی
            const persianDate = new Intl.DateTimeFormat('fa-IR', {
                year: 'numeric',
                month: 'numeric',
                day: 'numeric',
            }).format(date);
            cell.textContent = persianDate;
        } else {
            // نمایش تاریخ میلادی
            const englishDate = date.toLocaleString('en-GB', {
                year: 'numeric',
                month: 'numeric',
                day: 'numeric',
            });
            cell.textContent = englishDate;
        }
    });
}
// فراخوانی تابع هنگام لود صفحه
document.addEventListener('DOMContentLoaded', async (event) => {
    const jsLanguage = getLanguageFromJsCookie();
    const laravelLanguage = await getLanguageFromLaravel();

    if (jsLanguage !== laravelLanguage) {
        console.log('Languages do not match. Using last selected language:', jsLanguage);
       
        switchLanguage(jsLanguage);
    } else {
        console.log('Languages match. Using Laravel cookie language:', laravelLanguage);
        
        switchLanguage(laravelLanguage);
    }

    document.getElementById('btnPersian').addEventListener('click', () => switchLanguage('fa'));
    document.getElementById('btnEnglish').addEventListener('click', () => switchLanguage('en'));

        // نمایش محتوا پس از تغییر زبان
    document.body.classList.remove('loading');
    document.body.classList.add('loaded');
});



function languageForFilePond(lang) {
    if (lang ==='fa') {
        FilePond.setOptions({
            labelIdle: 'برای بارگذاری فایل اینجا کلیک کنید یا فایل‌ها را اینجا بکشید و رها کنید',
            labelInvalidField: 'فایل حاوی داده‌های نامعتبر است',
            labelFileWaitingForSize: 'در حال بررسی اندازه فایل',
            labelFileSizeNotAvailable: 'اندازه فایل در دسترس نیست',
            labelFileLoading: 'در حال بارگذاری',
            labelFileLoadError: 'خطا در بارگذاری',
            labelFileProcessing: 'در حال پردازش',
            labelFileProcessingComplete: 'پردازش کامل شد',
            labelFileProcessingAborted: 'پردازش متوقف شد',
            labelFileProcessingError: 'خطا در پردازش',
            labelFileProcessingRevertError: 'خطا در بازگردانی پردازش',
            labelFileRemoveError: 'خطا در حذف',
            labelTapToCancel: 'برای لغو کلیک کنید',
            labelTapToRetry: 'برای تلاش مجدد کلیک کنید',
            labelTapToUndo: 'برای بازگردانی کلیک کنید',
            labelButtonRemoveItem: 'حذف',
            labelButtonAbortItemLoad: 'لغو',
            labelButtonRetryItemLoad: 'تلاش مجدد',
            labelButtonAbortItemProcessing: 'لغو',
            labelButtonUndoItemProcessing: 'بازگردانی',
            labelButtonRetryItemProcessing: 'تلاش مجدد',
            labelButtonProcessItem: 'بارگذاری',
            labelMaxFileSizeExceeded: 'فایل خیلی بزرگ است',
            labelMaxFileSize: 'حداکثر اندازه فایل: {filesize}',
            labelMaxTotalFileSizeExceeded: 'مجموع اندازه فایل‌ها از حد مجاز بیشتر است',
            labelMaxTotalFileSize: 'حداکثر اندازه کل فایل‌ها: {filesize}',
            labelFileTypeNotAllowed: 'فایل از نوع مجاز نیست',
            fileValidateTypeLabelExpectedTypes: 'فقط فایل‌های با فرمت‌های مجاز پذیرفته می‌شوند: {allButLastType} یا {lastType}',
            imageValidateSizeLabelFormatError: 'نوع فایل تصویر پشتیبانی نمی‌شود',
            imageValidateSizeLabelImageSizeTooSmall: 'تصویر خیلی کوچک است',
            imageValidateSizeLabelImageSizeTooBig: 'تصویر خیلی بزرگ است',
            imageValidateSizeLabelExpectedMinSize: 'حداقل اندازه تصویر: {minWidth} × {minHeight}',
            imageValidateSizeLabelExpectedMaxSize: 'حداکثر اندازه تصویر: {maxWidth} × {maxHeight}',
            imageValidateSizeLabelImageResolutionTooLow: 'رزولوشن تصویر خیلی کم است',
            imageValidateSizeLabelImageResolutionTooHigh: 'رزولوشن تصویر خیلی زیاد است',
            imageValidateSizeLabelExpectedMinResolution: 'حداقل رزولوشن: {minResolution}',
            imageValidateSizeLabelExpectedMaxResolution: 'حداکثر رزولوشن: {maxResolution}',

            // stylePanelAspectRatio: 0.75, // نسبت ابعاد پنل FilePond برای نمایش بهتر
            // imagePreviewHeight: 200, // ارتفاع پیش‌نمایش تصویر
            // imageCropAspectRatio: '1:1', // نسبت ابعاد برش تصویر
            // imageResizeTargetWidth: 800, // عرض مورد نظر برای تغییر اندازه تصویر
            // imageResizeTargetHeight: 600, // ارتفاع مورد نظر برای تغییر اندازه تصویر
            // stylePanelLayout: 'integrated ',
            // styleLoadIndicatorPosition: 'center bottom',
            // styleProgressIndicatorPosition: 'right bottom',
            // styleButtonRemoveItemPosition: 'left bottom'
        });
    }
    else{
          // تنظیمات پیش‌فرض برای هر نوع فایل
          const defaultOptions = {
            labelIdle: 'Drag & Drop your files or <span class="filepond--label-action">Browse</span>',
            labelInvalidField: 'Field contains invalid files',
            labelFileWaitingForSize: 'Waiting for size',
            labelFileSizeNotAvailable: 'Size not available',
            labelFileLoading: 'Loading',
            labelFileLoadError: 'Error during load',
            labelFileProcessing: 'Uploading',
            labelFileProcessingComplete: 'Upload complete',
            labelFileProcessingAborted: 'Upload cancelled',
            labelFileProcessingError: 'Error during upload',
            labelFileProcessingRevertError: 'Error during revert',
            labelFileRemoveError: 'Error during remove',
            labelTapToCancel: 'Tap to cancel',
            labelTapToRetry: 'Tap to retry',
            labelTapToUndo: 'Tap to undo',
            labelButtonRemoveItem: 'Remove',
            labelButtonAbortItemLoad: 'Abort',
            labelButtonRetryItemLoad: 'Retry',
            labelButtonAbortItemProcessing: 'Cancel',
            labelButtonUndoItemProcessing: 'Undo',
            labelButtonRetryItemProcessing: 'Retry',
            labelButtonProcessItem: 'Upload',
            labelMaxFileSizeExceeded: 'File is too large',
            labelMaxFileSize: 'Max file size is {filesize}',
            labelMaxTotalFileSizeExceeded: 'Max total file size exceeded',
            labelMaxTotalFileSize: 'Max total file size is {filesize}',
            labelFileTypeNotAllowed: 'File type not allowed',
            fileValidateTypeLabelExpectedTypes: 'Expecting {allButLastType} or {lastType} files only',
            imageValidateSizeLabelFormatError: 'Image type not supported',
            imageValidateSizeLabelImageSizeTooSmall: 'Image is too small',
            imageValidateSizeLabelImageSizeTooBig: 'Image is too large',
            imageValidateSizeLabelExpectedMinSize: 'Minimum size is {minWidth} × {minHeight}',
            imageValidateSizeLabelExpectedMaxSize: 'Maximum size is {maxWidth} × {maxHeight}',
            imageValidateSizeLabelImageResolutionTooLow: 'Resolution is too low',
            imageValidateSizeLabelImageResolutionTooHigh: 'Resolution is too high',
            imageValidateSizeLabelExpectedMinResolution: 'Minimum resolution is {minResolution}',
            imageValidateSizeLabelExpectedMaxResolution: 'Maximum resolution is {maxResolution}',

            // stylePanelAspectRatio: 0.75, // نسبت ابعاد پنل FilePond برای نمایش بهتر
            // imagePreviewHeight: 200, // ارتفاع پیش‌نمایش تصویر
            //  imageCropAspectRatio: '1:1', // نسبت ابعاد برش تصویر
            // imageResizeTargetWidth: 800, // عرض مورد نظر برای تغییر اندازه تصویر
            // imageResizeTargetHeight: 600, // ارتفاع مورد نظر برای تغییر اندازه تصویر
            // stylePanelLayout: 'compact circle',
            // styleLoadIndicatorPosition: 'center bottom',
            // styleProgressIndicatorPosition: 'right bottom',
            // styleButtonRemoveItemPosition: 'left bottom'
        };
        
        FilePond.setOptions(defaultOptions);
      
    }
}

function translateForHome(lang) {
    if (typeof translations[lang]['home'] !== 'undefined') {
    
        const elements = ['home','login1','profile','products-menue','footer__description','footer__title',
                            'footer_link_login','footer_link_register','footer_link_dashboad','footer__title_blog',
                            'footer_link_Events','footer_link_news','footer_link_newsRecent', 'footer_time','footer__information',
                            'footer_title_contact', 'contact_us','logout'
                            
                         ];
            elements.forEach(id => {
                const element = document.getElementById(id);
                if (element) {
                   
                        element.textContent = translations[lang]['home'][id];
                    
                }
            });
      }
}

function translateForIndex(lang) {
    if (typeof translations[lang]['index'] !== 'undefined') {
    
        const elements = ['home__title','home__description','button__link','users','projects','products',
                            'section__title','about__title','about__subtitle','completed','project',
                            'support','online','about__description','button-c','section__titlee','work__title',
                            'see-more','services__modal-title','services__modal-description',
                            'services_modal-info','services_modal-infoo','services_modal-iinfo','services_modaal-info',
                            'seervices_modal-info','servicess_modal-info','buy','app', 'services_button','services_modal-title',
                            'services_modal-description','services_modal--info', 'services_modal--infoo','services_modal-innfo','services-modaal-info','servicess--modal-info',
                            'buy_','work_title','services__button', 'services_modaal-description','modal-title',
                            'modal-info', '_modal-info','_modal-iinfo','_modaal-info', '_moodal-info', 'section__tiitle','all','web',
                            'movil','robot','buy_t', 'web_design','see-more-w','web-design','web-design-d','template','coding','management',
                            'order','jobs','buy-w','app_1','services_button_1','services_modal-title_1','services_modal-description_1',
                            'services_modal--info_1','services_modal--infoo_1','services_modal-innfo_1','services-modaal-info_1',
                            'servicess--modal-info_1', 'buy_1','work_title_2','services__button_2','services_modaal-description_2',
                            'modal-title_2', 'modal-info_2','_modal-info_2','_modal-iinfo_2','_modaal-info_2','_moodal-info_2','buy_t_2',
                            'collection__title','collection__title_1','button__link_1','button__link_2','section__title_',
                            'testimonial__name_1', 'testimonial__description_1','testimonial__name_3','testimonial__description_3','testimonial__name_2','dtestimonial__description_2',
                            'brands', 'contact-me','contact__title','email','contact__button','instagram','tweeter', 'contact__button_',
                            'telegram','contact__button_1','contact__titlee','names','names-p',  'mail','Has_license',
                            'mail-1','comment','nazar','send', 'quiz-title','quiz-question','quiz-answer','quiz-label-answer','free_section__title',
                            'answer', 'quiz-label-file', 'quiz-submit-btn', 'all_product', 'view', 'category__title',
                            'quiz-number', 'quiz-Not-Auth', 'free', 'already-participated',
                            'previously','expired','valid','purchased','No_license_record','cart_shopping'
                        ];
            elements.forEach(id => {
                const element = document.getElementById(id);
                if (element) {
                    if (id === 'names-p' || id === 'mail-1' || id === 'nazar' || id==='answer' ) {
                        element.placeholder = translations[lang]['index'][id];
                    } else {
                        element.textContent = translations[lang]['index'][id];
                    }
                }
            });

              //for clasess
        const classofIndex = [
            'buy', 'view', 'Has_license', 'free', 'all_product',
            'previously','expired','valid','purchased','No_license_record'
        ];
       classofIndex.forEach(id => {
        document.querySelectorAll(`.${id}`).forEach(element => {
          
            element.textContent = translations[lang]['index'][id];
          
        });
      });
      }
}

function translateForLogin(lang) {
    if (typeof translations[lang]['login'] !== 'undefined') {
    
        const elements = ['sign','account','register-','button-','password-e','email-p','password-p',
                            'forget','button-s','text','email-l','password-l','welcome','enter',
                            'login','khosh','register-d','register','password-confirm','tel'

                         ];
            elements.forEach(id => {
                const element = document.getElementById(id);
                if (element) {
                    if (id === 'email-p' || id === 'text' || id === 'email-l' || id==='password-l' ||
                         id==='password-p' || id==='password-confirm' || id==='tel') {
                        element.placeholder = translations[lang]['login'][id];
                    } else {
                        element.textContent = translations[lang]['login'][id];
                    }
                }
            });
      }
}


function translateForViewProduct(lang) {
    if (typeof translations[lang]['viewProduct'] !== 'undefined') {
    
        const elements = ['product-licence','month','rial','product-price','download'];
            elements.forEach(id => {
                const element = document.getElementById(id);
                if (element) {
                   
                        element.textContent = translations[lang]['viewProduct'][id];
                    
                }
            });


        //for clasess
       const classofIndex = ['month','rial'];
       classofIndex.forEach(id => {
        document.querySelectorAll(`.${id}`).forEach(element => {
          
            element.textContent = translations[lang]['viewProduct'][id];
          
        });
      });
      }
}


function translateForUserDashboard(lang) {
    if (typeof translations[lang]['userDashboard'] !== 'undefined') {
        
        const elements = ['po-t','p-s','dash','profile-','pro','cart','ticket-d','msg','support',
                          'seti','up','sc', 'u-o','u-k','pendingUsers','activeUsers','dormantUsers','image',
                            'deletedUsers','justified-tab-0','justified-tab-2','sh','np','q','p','s',
                            'li','lo','id','t','d','st','j','py', 're','d-q','t-m','w-p','f-q','fileButton-2',
                             'r-s', 'f-s', 's-s', 'fileButton', 'fileDescriptionSize', 'fileDescriptionformat', 'upload-file',
                              'file', 'unreviewed1', 'inreview1', 'reviewed1', 'status', 'date', 'd-f','Log_out',
                             'competetion_number', 'disception', 'justified-tab-3', 'imageDescriptionSize', 'imageDescriptionformat',
                            'userName', 'email', 'phone', 'national_code', 'total_sum', 'pay', 'empty_shopping',
                            'product_name','Days_remaning','invalid', 'product_name', 'license_key','license_type', 'price'

        ];
       
      
        elements.forEach(id => {
           const element = document.getElementById(id);
           if (element) {

                element.textContent = translations[lang]['userDashboard'][id];
           }
       });

          //for clasess
        const classofLicense = [
            'file', 'unreviewed1', 'inreview1', 'reviewed1', 'status', 'date', 'd-f',
            'competetion_number', 'disception','image',
            'userName', 'email', 'phone', 'national_code', 'Days_remaning', 'invalid',
             'product_name', 'license_key','license_type', 'price'
        ];
          classofLicense.forEach(id => {
           document.querySelectorAll(`.${id}`).forEach(element => {
             
               element.textContent = translations[lang]['userDashboard'][id];
             
           });
         });


    }
}

function translateForCart(lang) {
    if (typeof translations[lang]['cart'] !== 'undefined') {
    
        const elements = ['shopping','format','quantity','price','game','made','digital',
                            'captcha','code','submit-c','submit-ca','zarin','pasargad',
                            'paypal','typeName','typeExp','cardNumber','subtotal',
                            'tax','total','checkout', 'myPurchase','invoice_number','total_amount','lice-type'
                            
                         ];
            elements.forEach(id => {
                const element = document.getElementById(id);
                if (element) {
                    if (id === 'typeName' || id === 'typeExp' || id === 'cardNumber' ) {
                        element.placeholder = translations[lang]['cart'][id];
                    } else {
                        element.textContent = translations[lang]['cart'][id];
                    }
                }
            });
        
        //for clasess
        const classofLicense = ['myPurchase','invoice_number','total_amount','lice-type'];
          classofLicense.forEach(id => {
           document.querySelectorAll(`.${id}`).forEach(element => {
             
               element.textContent = translations[lang]['cart'][id];
             
           });
         });
      }
}

function translateForProfile(lang) {
    if (typeof translations[lang]['profile'] !== 'undefined') {
    
        const elements = ['change-photo','position','points','home-tab','profile-tab','edit-p',
                            'purchased', 'python', 'php', 'react', 'purchase', 'template', 'licensee',
                             'bot', 'user-id', 'name-u', 'user-name','u-name', 'n-k', 'email', 'phone','profession',
                             'profession-u', 'password','change-password', 'educational', 'update','evidence', 'python-1',
                              'request','php-1','request-1','f-m','f-l','category','n-m','p-p','ph','pass',
                              'passc','sub','changePasswordModalLabel','current-password','new-password','confirm-password','change',
                            
                         ];
            elements.forEach(id => {
                const element = document.getElementById(id);
                if (element) {
                    if (id === 'f-l' || id === 'p-p' || id === 'n-m' || id === 'ph'
                        || id === 'pass' || id === 'passc' || id === 'current-password' 
                        || id === 'new-password' || id === 'confirm-password'
                    ) {
                        element.placeholder = translations[lang]['profile'][id];
                    } else {
                        element.textContent = translations[lang]['profile'][id];
                    }
                }
            });

             // for clasess
            const classofLicense = ['delete-license'];
                classofLicense.forEach(id => {
                document.querySelectorAll(`.${id}`).forEach(element => {
                    
                    element.textContent = translations[lang]['profile'][id];
                    
                });
            });
      }
}



function translateForTicket(lang) {
    if (typeof translations[lang]['ticket'] !== 'undefined') {
    
        const elements = ['ticket-close','support-s','seles-d','accounting','general','comments',
                            'complaints', 'ask', 'pre-purchase', 'accounting-d', 'general-d', 'comments-d', 'complaints-d',
                             'ticket-title', 'submit-t', 'ticket-text', 'submit','tickets', 'new-host', 'closed', 'server','closed-1',
                             'database', 'closed-2','appendices', 'upload-f', 'add-file-btn','No-messages','all_ticketView'
                                 
                         ];
            elements.forEach(id => {
                const element = document.getElementById(id);
                if (element) {
                    if (id === 'ticket-title' || id === 'ticket-text') {
                        element.placeholder = translations[lang]['ticket'][id];
                    } else {
                        element.textContent = translations[lang]['ticket'][id];
                    }
                }
            });

             // for clasess
            // const classofLicense = ['delete-license'];
            //     classofLicense.forEach(id => {
            //     document.querySelectorAll(`.${id}`).forEach(element => {
                    
            //         element.textContent = translations[lang]['ticket'][id];
                    
            //     });
            // });
      }
}




function switchLanguage(lang){
   
     setLanguageCookie(lang); 
     setLanguageLaravelCookie(lang); 
   
    document.documentElement.lang = lang;
    document.body.setAttribute('dir', lang === 'fa' ? 'rtl' : 'ltr');
     
    console.log("Switching language to: " + lang);
    languageForFilePond(lang);
    updateDates(lang);

    translateForHome(lang);
    translateForIndex(lang);
    translateForLogin(lang);
    translateForViewProduct(lang);
    translateForUserDashboard(lang);
    translateForCart(lang);
    translateForProfile(lang);
    translateForTicket(lang);
}
window.switchLanguage = switchLanguage;