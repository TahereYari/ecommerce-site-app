
import {translationsDashboard} from './translatedashboard.js';
import {translationadmin} from './translateadmin.js'
import {translationsSite} from './translateSite.js'
import {translationsUserCreate} from './translateuf.js';
import {translationsUserList} from './translateUserList.js';
import {translationsRoleList} from './translateRole.js';
import {translatefProductList} from './translateProductList.js';
import {translationsLicenseList} from './translateLicense.js';
import {translationsCompetitionList} from './translateCompitiotion.js';
import {translationsCategoryList} from './translateCategory.js';
import {translationsTicket} from './translateTicket.js';
import {translationsWinnerList} from './translateCompitiotionWinners.js';


const translations = {
    'en': {
        'dashboard': translationsDashboard.en,
        'admin': translationadmin.en,
        'site': translationsSite.en,
        'usercreate': translationsUserCreate.en,
        'userList': translationsUserList.en,
        'roleList': translationsRoleList.en,
        'productList': translatefProductList.en,
        'licenseList': translationsLicenseList.en,
        'competiotionList': translationsCompetitionList.en,
        'winnerList': translationsWinnerList.en,
        'categoryList': translationsCategoryList.en,
        'ticket': translationsTicket.en,
    },
    'fa': {
        'dashboard': translationsDashboard.fa,
        'admin': translationadmin.fa,
        'site': translationsSite.fa,
        'usercreate': translationsUserCreate.fa,
        'userList': translationsUserList.fa,
        'roleList': translationsRoleList.fa,
        'productList': translatefProductList.fa,
        'licenseList': translationsLicenseList.fa,
        'competiotionList': translationsCompetitionList.fa,
        'winnerList': translationsWinnerList.fa,
        'categoryList': translationsCategoryList.fa,
        'ticket': translationsTicket.fa,
    }
};
console.log(' جاوا زبان ذخیره شده:',  getLanguageFromJsCookie());
console.log('زبان ذخیره شده لاراول: ',  getLanguageFromLaravel());


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



function changeTableLanguageForRequest(lang) {
    //change table language
    if (lang==='en') {
        
        $('.example').DataTable().destroy();
    
        $(document).ready(function() {
            if (!$.fn.DataTable.isDataTable('.example')) {
            
                $('.example').DataTable();
            }
        
        });
        
    } 
    else {
        
        $('.example').DataTable().destroy();
        $(document).ready(function() {
            if (!$.fn.DataTable.isDataTable('.example')) {
                $('.example').DataTable({
                    
                    "language": {
                        "sProcessing": "در حال پردازش...",
                        "sLengthMenu": "نمایش _MENU_ رکورد",
                        "sZeroRecords": "رکوردی یافت نشد",
                        "sEmptyTable": "داده ای در جدول موجود نیست",
                        "sInfo": "نمایش _START_ تا _END_ از _TOTAL_ رکورد",
                        "sInfoEmpty": "نمایش 0 تا 0 از 0 رکورد",
                        "sInfoFiltered": "(فیلتر شده از _MAX_ رکورد)",
                        "sInfoPostFix": "",
                        "sSearch": "جستجو:",
                        "sUrl": "",
                        "sInfoThousands": ",",
                        "sLoadingRecords": "در حال بارگذاری...",
                        "oPaginate": {
                            "sFirst": "ابتدا",
                            "sLast": "انتها",
                            "sNext": "بعدی",
                            "sPrevious": "قبلی"
                        },
                        "oAria": {
                            "sSortAscending": ": فعال سازی مرتب سازی به صورت صعودی",
                            "sSortDescending": ": فعال سازی مرتب سازی به صورت نزولی"
                        }
                    }
                });
            }
        });
        
    }
}

function changeTableLanguage(lang) {
    //change table language
    if (lang==='en') {
        
        $('#example').DataTable().destroy();
    
        $(document).ready(function() {
            if (!$.fn.DataTable.isDataTable('#example')) {
            
                $('#example').DataTable();
            }
        
        });
        
    } 
    else {
        
        $('#example').DataTable().destroy();
        $(document).ready(function() {
            if (!$.fn.DataTable.isDataTable('#example')) {
                $('#example').DataTable({
                    
                    "language": {
                        "sProcessing": "در حال پردازش...",
                        "sLengthMenu": "نمایش _MENU_ رکورد",
                        "sZeroRecords": "رکوردی یافت نشد",
                        "sEmptyTable": "داده ای در جدول موجود نیست",
                        "sInfo": "نمایش _START_ تا _END_ از _TOTAL_ رکورد",
                        "sInfoEmpty": "نمایش 0 تا 0 از 0 رکورد",
                        "sInfoFiltered": "(فیلتر شده از _MAX_ رکورد)",
                        "sInfoPostFix": "",
                        "sSearch": "جستجو:",
                        "sUrl": "",
                        "sInfoThousands": ",",
                        "sLoadingRecords": "در حال بارگذاری...",
                        "oPaginate": {
                            "sFirst": "ابتدا",
                            "sLast": "انتها",
                            "sNext": "بعدی",
                            "sPrevious": "قبلی"
                        },
                        "oAria": {
                            "sSortAscending": ": فعال سازی مرتب سازی به صورت صعودی",
                            "sSortDescending": ": فعال سازی مرتب سازی به صورت نزولی"
                        }
                    }
                });
            }
        });
        
    }
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



function updatePermissionLabels(language) {
    $('.permission-label').each(function() {
        var label = $(this);
        if (language == 'fa') {
            label.text(label.data('fa') );
        } else {
            label.text(label.data('en'));
        }
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


function translateForAdmin(lang) {
    if (typeof translations[lang]['admin'] !== 'undefined') {
    
        const elements = ['p-t', 'po-t', 'p-s', 'dash', 'pro', 'f-p', 'user-list', 'm', 'msg',
                            'support', 'seti', 'up', 'sc', 'u-o', 'u-k','mf',
                            'old-password','new-password','new-pass-repeat','ChangeModalLabel',
                            'change-user-pass',,'change-pass','titleOfSite','Log_out','categories','site'
                        ];
            elements.forEach(id => {
                const element = document.getElementById(id);
                if (element) {
                    if (id === 'old-password' || id === 'new-password' || id === 'new-pass-repeat') {
                        element.placeholder = translations[lang]['admin'][id];
                    } else {
                        element.textContent = translations[lang]['admin'][id];
                    }
                }
            });
      }
}

function translateForDashboard(lang) {
    if (typeof translations[lang]['dashboard'] !== 'undefined') {
       
        const elements = [
            'usersCount', 'vs', 'productsCount', 't-r', 't-m', 'm-kh', 't-m1', 'cb', 't-s', 's-f', 'r-a', 'a-u', 
            'a-p', 'a-l', 'a-a', 'a-c', 'a-w', 'p-u', 'u-r', 'd-u', 'u-t', 'justified-tab-0', 'justified-tab-1', 
            'justified-tab-2', 'ax', 'n-p', 'd', 'p', 'cat', 'e', 'd-p', 'lc', 'em', 'eh', 'de', 'ph', 'user-name', 'message', 
            'email', 'ca', 'u', 'dp', 'nd', 'viewAll', 'mh', 'edi-1', 'del', 'id-u', 'n-k', 'id-m', 'j', 't', 's-a', 
            'p-count', 'des', 'category', 'n-m', 'p-price', 'isfree', 'submit', 'exampleModalLabel', 'staticBackdropLabel', 
            'n-u', 'd-q', 'd-f', 'edit-profile', 'Categorys', 'status', 'read', 'request_product', 'phone', 'file',
            'unreviewed1','inreview1','reviewed1','invoice','date','invoice_number','total_amount','lice-type','rial','last_month'
        ];
        elements.forEach(id => {
            const element = document.getElementById(id);
            if (element) {
                if (id === 'n-m' || id === 'p-p') {
                    element.placeholder = translations[lang]['dashboard'][id];
                } else {
                    element.textContent = translations[lang]['dashboard'][id];
                }
            }
        });


           //for clasess
        const classofUser = ['s-a', 'read', 'phone', 'file', 'd-f', 'unreviewed1',
                            'inreview1', 'reviewed1', 'date', 'status'
                            ,'invoice_number','total_amount','lice-type','rial'
        ];
       classofUser.forEach(id => {
        document.querySelectorAll(`.${id}`).forEach(element => {
          
            element.textContent = translations[lang]['dashboard'][id];
          
        });
      });
            
    }

}
function translateForSite(lang) {
    if (typeof translations[lang]['site'] !== 'undefined') {
       
        const elements = ['form-site', 'name','experience','completed_projects','email','Phone',
                          'instagram','tweeter','facebook','telegram','address','description-of-site',
                          'form-site-edit',
                         ];
       elements.forEach(id => {
           const element = document.getElementById(id);
           if (element) {
               if (id === 'name' || id === 'experience' || id === 'completed_projects' || id === 'Phone' || id === 'email' 
                    || id === 'instagram' || id === 'tweeter' || id === 'facebook'  || id === 'telegram'|| id === 'address'|| id === 'description-of-site') {
                   element.placeholder = translations[lang]['site'][id];
               } else {
                   element.textContent = translations[lang]['site'][id];
               }
           }
       });


    }


}

function translateForUsercreate(lang) {
    if (typeof translations[lang]['usercreate'] !== 'undefined') {
       
        const elements = ['f-m', 'role', 'f-l', 'national-code', 'email', 'Phone', 'pass', 'pass-confirm', 'sub'];
       elements.forEach(id => {
           const element = document.getElementById(id);
           if (element) {
               if (id === 'f-l' || id === 'national-code' || id === 'email' || id === 'Phone' || id === 'pass' || id === 'pass-confirm') {
                   element.placeholder = translations[lang]['usercreate'][id];
               } else {
                   element.textContent = translations[lang]['usercreate'][id];
               }
           }
       });


    }


}

function translateForUserList(lang) {
    if (typeof translations[lang]['userList'] !== 'undefined') {
      
        const elements = ['delete-u','edit-u','subEdit','rolename' ,'n-m', 'p-p', 'name', 'code', 'phone', 'roleuser', 'delete', 'editUser',   'addNewItemModalLabel', 'users_', 'form-user-edit', 'category', 'full-name', 'code-national', 'email', 'tel', 'password', 'pass-repeat', 'search-s', 'search', 'exampleModalLabel', 'modal-body', 'close-d', 'delete-d', 'staticBackdropLabel', 's-close', 's-search' , 'add-new-user'];

        elements.forEach(id => {
           const element = document.getElementById(id);
           if (element) {
               if (id === 'full-name' || id === 'code-national' || id === 'email' || id === 'tel' || id === 'password' || id === 'pass-repeat' ||id==='search-s') {
                   element.placeholder = translations[lang]['userList'][id];
               } else {
                   element.textContent = translations[lang]['userList'][id];
               }
           }
       });

       //for clasess
       const classofUser = ['delete-user','edit-user'];
       classofUser.forEach(id => {
        document.querySelectorAll(`.${id}`).forEach(element => {
          
            element.textContent = translations[lang]['userList'][id];
          
        });
      });




    }

}

function translateForProductList(lang) {
    if (typeof translations[lang]['productList'] !== 'undefined') {
        
        const elements = ['form-add-product','add-new-product','image','name','price','description','free','free-Product','description-of-product','Edit','Delete','edit-p','delete-p','not-enter-price','addNewItemModalProduct','name-product','price-product','license','type-of-Subscription',
                            'price-of-Subscription','add-more-update','add-moree','upload-file','upload-image','Start-uploading',
                            'upload-video',
                            'Is_license','No_license','Yes','No','delete-pp',
                            'fileDescriptionSize','fileDescriptionformat',
                            'videoDescriptionformat','videoDescriptionSize','categoryName',
                            'imageDescriptionSize','imageDescriptionformat','Edit','Delete','Has_license'

                        ];
                     

       elements.forEach(id => {
           const element = document.getElementById(id);
           if (element) {
               if (id === 'name-product' || id === 'price-product' || id === 'description-of-product' || id === 'type-of-Subscription'  || id==='price-of-Subscription') {
                   element.placeholder = translations[lang]['productList'][id];
               } else {
                   element.textContent = translations[lang]['productList'][id];
               }
           }
       });
        //for Classes
        const classofProduct = ['edit-pp','Is_license','No_license','Yes','No','delete-pp','view-license' ];
       classofProduct.forEach(id => {
        document.querySelectorAll(`.${id}`).forEach(element => {
          
            element.textContent = translations[lang]['productList'][id];
          
        });
      });
     }
}

function translateForRoleList(lang) {
    if (typeof translations[lang]['roleList'] !== 'undefined') {
        
        const elements = ['add-new-Role','rolename','permissions','Edit','Delete','edit-r','delete-r','form-role-edit','nameOfRol','submit','close-d','delete-d','search-s','s-close','s-search','inputCheckbox','edit-form-role','form-access'];
       
      
        elements.forEach(id => {
           const element = document.getElementById(id);
           if (element) {
               if (id === 'Permissions' || id === 'search-s' || id === 'inputCheckbox' || id === 'nameOfRol'  ||id==='search-s') {
                   element.placeholder = translations[lang]['roleList'][id];
               } else {
                   element.textContent = translations[lang]['roleList'][id];
               }
           }
       });

          //for clasess
          const classofRole = ['delete-role','edit-role'];
          classofRole.forEach(id => {
           document.querySelectorAll(`.${id}`).forEach(element => {
             
               element.textContent = translations[lang]['roleList'][id];
             
           });
         });


    }
}

function translateForCompetitionList(lang) {
    if (typeof translations[lang]['competiotionList'] !== 'undefined') {
        
        const elements = ['add-new-competition','title-of-competition','number-of-competition',
                            'discription-of-competition','Edit','Delete',
                            'form-competitions','description-of-competiotion','description-of-answer','title','view',
                             'edit-form-competition', 'form-competition-edit', 'number_of_competiton', 'answers',
                              'question','answer','winers','winers1'
                        ];
       
      
        elements.forEach(id => {
           const element = document.getElementById(id);
           if (element) {
               if (id === 'title' || id ==='description-of-competiotion' || id ==='description-of-answer') {
                   element.placeholder = translations[lang]['competiotionList'][id];
               } else {
                   element.textContent = translations[lang]['competiotionList'][id];
               }
           }
       });

          //for clasess
          const classofcompetition = ['delete-competition','edit-competition','view','winers1'];
          classofcompetition.forEach(id => {
           document.querySelectorAll(`.${id}`).forEach(element => {
             
               element.textContent = translations[lang]['competiotionList'][id];
             
           });
         });


    }
}

function translateForWinnerList(lang) {
    if (typeof translations[lang]['winnerList'] !== 'undefined') {
        
        const elements = ['pageWinner', 'add-new-winer', 'UserName', 'Email',
                            'NumberQuestion', 'Discrption', 'File',
                            'add-form-winner', 'form-winner', 'numberCompetition',
                            'giftDiscription', 'user_email'
                        ];
       
      
        elements.forEach(id => {
           const element = document.getElementById(id);
           if (element) {
               if (id ==='giftDiscription') {
                   element.placeholder = translations[lang]['winnerList'][id];
               } else {
                   element.textContent = translations[lang]['winnerList'][id];
               }
           }
       });

          //for clasess
        //   const classofcompetition = ['delete-competition','edit-competition','view','winers1'];
        //   classofcompetition.forEach(id => {
        //    document.querySelectorAll(`.${id}`).forEach(element => {
             
        //        element.textContent = translations[lang]['winnerList'][id];
             
        //    });
        //  });


    }
}

function translateForcategoryList(lang) {
    if (typeof translations[lang]['categoryList'] !== 'undefined') {
        
        const elements = ['add-new-category','name-of-category',
                            'description-of-category','Edit','Delete',
                            'form-categorys','name','discription-of-category',
                            'edit-form-category','form-category-edit','category-name'
                        ];
       
      
        elements.forEach(id => {
           const element = document.getElementById(id);
           if (element) {
               if (id === 'category-name' || id ==='description-of-category' ) {
                   element.placeholder = translations[lang]['categoryList'][id];
               } else {
                   element.textContent = translations[lang]['categoryList'][id];
               }
           }
       });

          //for clasess
          const classofcompetition = ['delete-category','edit-category'];
          classofcompetition.forEach(id => {
           document.querySelectorAll(`.${id}`).forEach(element => {
             
               element.textContent = translations[lang]['categoryList'][id];
             
           });
         });


    }
}

function translateForLicenseList(lang) {
    if (typeof translations[lang]['licenseList'] !== 'undefined') {
        
        const elements = ['licenseType', 'price', 'Delete', 'delete-license',
              'product_name',  'lice_type',   'price', 'image'
        ];
       
      
        elements.forEach(id => {
           const element = document.getElementById(id);
           if (element) {

                element.textContent = translations[lang]['licenseList'][id];
           }
       });

          //for clasess
          const classofLicense = ['delete-license', 'product_name',  'lice_type',   'price', 'image'];
          classofLicense.forEach(id => {
           document.querySelectorAll(`.${id}`).forEach(element => {
             
               element.textContent = translations[lang]['licenseList'][id];
             
           });
         });


    }
}

function translateForTicket(lang) {
    if (typeof translations[lang]['ticket'] !== 'undefined') {
    
        const elements = ['ticket-n','support-s','seles-d','accounting','general','comments',
                            'complaints', 'ask', 'pre-purchase', 'accounting-d', 'general-d', 'comments-d', 'complaints-d',
                             'ticket-title', 'submit-t', 'ticket-text', 'submit','tickets', 'new-host', 'closed', 'server','closed-1',
                             'database', 'closed-2','appendices', 'upload-f', 'add-file-btn','userName','userEmail',
                             'Status','View','open-tab','close-tab','newMessage'
                                 
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
            const classofLicense = ['userName','userEmail','Status','View','newMessage'];
                classofLicense.forEach(id => {
                document.querySelectorAll(`.${id}`).forEach(element => {
                    
                    element.textContent = translations[lang]['ticket'][id];
                    
                });
            });
      }
}


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

function renderChart(lang) {
    const months = lang === 'fa'
        ? ['فروردین', 'اردیبهشت', 'خرداد', 'تیر', 'مرداد', 'شهریور', 'مهر', 'آبان', 'آذر', 'دی', 'بهمن', 'اسفند']
        : ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

    fetch(`/admin/get-monthly-sales?lang=${lang}`)
        .then(response => response.json())
        .then(data => {
            const salesData = data.sales; // داده‌های فروش

            const chart = document.querySelector('#chart').getContext('2d');

            // حذف نمودار قبلی اگر موجود باشد
            if (window.chartInstance) {
                window.chartInstance.destroy();
            }

            // ایجاد نمودار جدید
            window.chartInstance = new Chart(chart, {
                type: 'line',
                data: {
                    labels: months,
                    datasets: [
                          {
                            label: lang === 'fa'? 'فروش ماهانه کل محصولات' :  'Monthly Sales',
                            data: Object.values(data.sales), // فروش کل
                            borderColor: 'green',
                            borderWidth: 2
                        },
                        {
                            label: lang === 'fa'? 'فروش ماهانه محصولات اشتراک دار ' :'Licensed Products Sales',
                            data: Object.values(data.licensedSales), // فروش محصولات دارای لایسنس
                            borderColor: 'red',
                            borderWidth: 2
                        }
                    ]
                },
                options: {
                    responsive: true,
                    plugins: {
                        title: {
                            display: true,
                            text:lang === 'fa'? 'فروش سال جاری' :  'This years sale',
                            font: {
                                size: 18
                            }
                        }
                    }
                }
            });
        })
        .catch(error => console.error('Error fetching sales data:', error));
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

    // const dateField = document.getElementById('competition-date');
    // const originalDate = new Date(dateField.value);

    // if (dateField) {  // چک کردن وجود عنصر
    //     const originalDate = new Date(dateField.value);

    //     if (jsLanguage === 'fa') {
    //         const persianDateObj = new persianDate(originalDate);
    //         dateField.value = persianDateObj.format('YYYY/MM/DD');
    //     } else {
    //         dateField.value = originalDate.toISOString().split('T')[0];
    //     }
    // }

    document.getElementById('btnPersian').addEventListener('click', () => switchLanguage('fa'));
    document.getElementById('btnEnglish').addEventListener('click', () => switchLanguage('en'));

        // نمایش محتوا پس از تغییر زبان
    document.body.classList.remove('loading');
    document.body.classList.add('loaded');
});


function switchLanguage(lang) {


     setLanguageCookie(lang); //  ذخیره زبان در کوکی با استفاده از جاوا اسکریپت
     setLanguageLaravelCookie(lang); // ذخیره زبان در کوکی با استفاده از لاراول
    updatePermissionLabels(lang);
    renderChart(lang);
    //  updateDateField(lang);

     updateDates(lang);
     changeTableLanguage(lang);
     changeTableLanguageForRequest(lang);

     languageForFilePond(lang);
      document.documentElement.lang = lang;
      document.body.setAttribute('dir', lang === 'fa' ? 'rtl' : 'ltr');
      
     console.log("Switching language to: " + lang);


  


    //  ترجمه برای ادمین
    translateForAdmin(lang);
   
    //  ترجمه برای داشبورد
    translateForDashboard(lang);

    //  ترجمه برای افزودن کاربر
    translateForUsercreate(lang);

      //  ترجمه برای لیست کاربر
      translateForUserList(lang);
    


     //  ترجمه برای لیست نقش ها
     translateForRoleList(lang);

   

      //  ترجمه برای لیست محصولات ها
      translateForProductList(lang);
   
      //  ترجمه برای لیست لایسنس ها
      translateForLicenseList(lang);
   
        //  ترجمه برای لیست مسابقات
    translateForCompetitionList(lang);
    translateForWinnerList(lang)

   
        //  ترجمه برای لیست دسته ها
    translateForcategoryList(lang);
    

        translateForSite(lang);
        translateForTicket(lang);

}

window.switchLanguage = switchLanguage;



