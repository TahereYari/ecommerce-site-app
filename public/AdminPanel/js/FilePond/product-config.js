  //******************************************Edite Product*********************************************
let productId;
  document.addEventListener('DOMContentLoaded', function() {
    const filePond = initializeFileProduct('/admin/upload-file-endpoint', '/admin/delete-filePond-product');
    const imagePond = initializeImageProduct('/admin/upload-image-endpoint', '/admin/delete-imagePond-product');
    const videoPond = initializeVideoProduct('/admin/upload-video-endpoint', '/admin/delete-videoPond-product');

    var editButtons = document.querySelectorAll('#edit-p');
    editButtons.forEach(function(button) {
        button.addEventListener('click', function() {
         
            productId = this.getAttribute('data-id');
            var productName = this.getAttribute('data-product-name');
            var productPrice = this.getAttribute('data-product-price');
            var formattedPrice = Number(productPrice).toLocaleString();
            var productDiscription = this.getAttribute('data-discription-product');
            var productFree = this.getAttribute('data-free-product');
            var productLicense = this.getAttribute('data-license-product');
            var productFile = this.getAttribute('data-file-product');
            var productImage = this.getAttribute('data-image-product');
            var productVideo = this.getAttribute('data-video-product');
            var productCategory = this.getAttribute('data-category');
          
        

            const licenseCheckbox = document.querySelector('#product-license');
            
            if (productLicense == '1') {
              licenseCheckbox.checked = true;
              showEditLicenseFields(true);
            } else {
              licenseCheckbox.checked = false;
              showEditLicenseFields(false);
            }

            const freeCheckbox = document.querySelector('#product-free');
            if (productFree === '1') {
              freeCheckbox.checked = true;
            } 
            else {
              freeCheckbox.checked = false;
            }

          


            document.querySelector('#name-product').value = productName;
            document.querySelector('#price-product').value = formattedPrice;
            document.querySelector('#description-of-product').value = productDiscription;

            document.querySelector('#file_path').value = productFile;
            document.querySelector('#image_path').value = productImage;
            document.querySelector('#video_path').value = productVideo;
            document.querySelector('#inputState').value = productCategory;
 
         

            if (productFile) {
                filePond.removeFiles();
                filePond.addFile(baseUrl + 'Images/Product/Files/' + productFile, {
                    type: 'local', // Indicate it's a preloaded file
                    source: baseUrl + 'Images/Product/Files/' + productFile,
                    options: {
                        type: 'local'
                    }
                }); 
            } 


            if (productImage) {
                imagePond.removeFiles();
                imagePond.addFile(baseUrl + 'Images/Product/Images/' + productImage, {
                    type: 'local', // Indicate it's a preloaded file
                    source: baseUrl + 'Images/Product/Images/' + productImage,
                    options: {
                        type: 'local'
                    }
                }); 
            } 

          
            if (productVideo) {
                videoPond.removeFiles();
                videoPond.addFile(baseUrl + 'Images/Product/Videos/' + productVideo, {
                    type: 'local', // Indicate it's a preloaded file
                    source: baseUrl + 'Images/Product/Videos/' + productVideo,
                    options: {
                        type: 'local'
                    }
                }); 
            } 

            var form = document.querySelector('#edit-form');
            form.setAttribute('action', '/admin/productUpdate/' + productId);
          
          
           
        });
    });



});


//******************************************Delete Product*********************************************

document.addEventListener('DOMContentLoaded', function() {
    let productIdd;

    // Event listener for each delete button
    document.querySelectorAll('.delete-product').forEach(function(button) {
        button.addEventListener('click', function() {
            productIdd = button.getAttribute('data-product-id');
           
        });
    });

    // Event listener for the modal delete button
    document.getElementById('delete-p').addEventListener('click', function() {
        fetch('/admin/productDelete/' + productIdd, {
            method: 'GET'
        })
        .then(response => {
            console.log('Product deleted successfully');
            // Refresh the page or update the UI accordingly
            location.reload();
        })
        .catch(error => {
            console.error('Error deleting product:', error);
            // Handle error appropriately
        });
    });
});



 //***********************************UploadFile*****************************************
function initializeFileProduct(uploadFileUrl, deleteFileUrl) {
    
    const fileInputElement = document.querySelector('input[id="upload-f-p"]');
    FilePond.registerPlugin(
         FilePondPluginFileValidateType
        );
     filePond  = FilePond.create(fileInputElement);

     filePond.setOptions({
      acceptedFileTypes: ['application/zip', 'application/x-rar-compressed'], 
        maxFileSize: '500MB', 
        instantUpload: false,
        fileValidateTypeLabelExpectedTypesMap: {
            'application/zip': '.zip',
            'application/x-rar-compressed': '.rar',
            
        },
        fileValidateTypeLabelExpectedTypes: 'فقط فایل‌های با فرمت‌های مجاز (rar, zip) پذیرفته می‌شوند.',
        labelFileTypeNotAllowed: 'فرمت فایل معتبر نیست.',
        labelMaxFileSizeExceeded: 'اندازه فایل بیش از حد مجاز است.',
        labelMaxFileSize: 'حداکثر اندازه فایل: {filesize}',
        server: {
         
            process: {
                url: uploadFileUrl,
                method: 'POST',
                withCredentials: false,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                timeout: 10000000, 
                chunkUploads: true, 
                chunkSize: 5000000, 
                onload: (response) => {
                    const jsonResponseFile = JSON.parse(response);
                    if (jsonResponseFile.fileName) {
                      
                        document.getElementById('file_path').value = jsonResponseFile.fileName;
                    } else {
                        console.error('File name not found in response:', jsonResponseFile);
                    }
                },
                onerror: (response) => {
                    console.error('Upload error:', response);
                },
             
            },
            revert: {
                url: deleteFileUrl,
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                // onload: (response) => {
                //     document.querySelector('#image_path').value = '';
                // },

                onerror: (response) => {
                    console.error('Error deleting file:', response);
                }
            },
            load: (source, load) => {
                fetch(source).then(response => response.blob()).then(blob => {
                    load(blob);
                });
            }
        }
    });

    filePond.on('removefile', () => {
        const fileName = document.querySelector('#file_path').value;
        if (fileName) {
            fetch(deleteFileUrl, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ file_name: fileName,directory: 'Images/Product/Files/' })
            }).then(response => response.json()).then(data => {
                if (data.success) {
                    document.querySelector('#file_path').value = '';
                }
            }).catch(error => {
                console.error('Error deleting file:', error);
            });
        }
    });

    return filePond;
}


  //***********************************UploadImage*****************************************

    function initializeImageProduct(uploadUrl, deleteUrl) {
        
        let imagePond;
            FilePond.registerPlugin(
                FilePondPluginFileValidateType,
                FilePondPluginImagePreview
            );
        imagePond = FilePond.create(document.querySelector('#upload-i-p'), {
            acceptedFileTypes: ['image/jpeg', 'image/png', 'image/jpg'],
            maxFileSize: '5MB',
            instantUpload: false, // Disable instant upload
            
            server: {
                process: {
                    url: uploadUrl,
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    onload: (response) => {
                        const data = JSON.parse(response);
                        if (data.success) {
                            document.querySelector('#image_path').value = data.imageName;
                        }
                    },
                    onerror: (response) => {
                        console.error('Error uploading file:', response);
                    }
                },
                revert: {
                    url: deleteUrl,
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    // onload: (response) => {
                    //     document.querySelector('#image_path').value = '';
                    // },
                    
                    onerror: (response) => {
                        console.error('Error deleting file:', response);
                    }
                },
                load: (source, load) => {
                    fetch(source).then(response => response.blob()).then(blob => {
                        load(blob);
                    });
                }
            }
        });

        imagePond.on('removefile', () => {
            const imageName = document.querySelector('#image_path').value;
            if (imageName) {
                fetch(deleteUrl, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ image_name: imageName,directory: 'Images/Product/Images/' })
                }).then(response => response.json()).then(data => {
                    if (data.success) {
                        console.log('delete');
                        document.querySelector('#image_path').value = '';
                    }
                }).catch(error => {
                    console.error('Error deleting file:', error);
                });
            }
        });


        return imagePond;
    }

 //***********************************UploadVideo*****************************************
 function initializeVideoProduct(uploadUrl, deleteUrl) {
        
    const videoInputElement = document.querySelector('input[id="upload-v-p"]');
    FilePond.registerPlugin(
        FilePondPluginFileValidateType,
            FilePondPluginFileEncode,
            FilePondPluginMediaPreview,
            FilePondPluginFileValidateSize
        );
     videoPond  = FilePond.create(videoInputElement);

    videoPond.setOptions({
      acceptedFileTypes: ['video/mp4', 'video/avi', 'video/mov'], // تنظیم پذیرفتن فایل‌های ویدیویی
        maxFileSize: '500MB', // حداکثر اندازه فایل 500 مگابایت
        instantUpload: false,
        fileValidateTypeLabelExpectedTypesMap: {
            'video/mp4': '.mp4',
            'video/avi': '.avi',
            'video/mov': '.mov'
        },
        fileValidateTypeLabelExpectedTypes: 'فقط فایل‌های با فرمت‌های مجاز (mp4, avi, mov) پذیرفته می‌شوند.',
        labelFileTypeNotAllowed: 'فرمت فایل معتبر نیست.',
        labelMaxFileSizeExceeded: 'اندازه فایل بیش از حد مجاز است.',
        labelMaxFileSize: 'حداکثر اندازه فایل: {filesize}',
        server: {
         
            process: {
                url: uploadUrl,
                method: 'POST',
                withCredentials: false,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                timeout: 10000000, 
                chunkUploads: true, 
                chunkSize: 5000000, 
                onload: (response) => {
                    const jsonResponseVideo = JSON.parse(response);
                    if (jsonResponseVideo.videoFileName) {
                        document.getElementById('video_path').value = jsonResponseVideo.videoFileName;
                    } else {
                        console.error('File name not found in response:', jsonResponseVideo);
                    }
                },
                onerror: (response) => {
                    console.error('Upload error:', response);
                },
            },
            revert: {
                url: deleteUrl,
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                // onload: (response) => {
                //     document.querySelector('#image_path').value = '';
                // },
                onerror: (response) => {
                    console.error('Error deleting file:', response);
                }
            },
            load: (source, load) => {
                fetch(source).then(response => response.blob()).then(blob => {
                    load(blob);
                });
            }
        }
    });

    videoPond.on('removefile', () => {
        const videoName = document.querySelector('#video_path').value;
        if (videoName) {
            fetch(deleteUrl, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ video_name: videoName,directory: 'Images/Product/Videos/' })
            }).then(response => response.json()).then(data => {
                if (data.success) {
                    document.querySelector('#video_path').value = '';
                }
            }).catch(error => {
                console.error('Error deleting file:', error);
            });
        }
    });


    return videoPond;
}


  //***********************************ShowLicense*****************************************

  function showEditLicenseFields(hasLicense) {
    var moreFieldsDiv = $('#more-fields');
    moreFieldsDiv.empty(); // پاک کردن محتوای قبلی

    if (hasLicense) {
        // AJAX request or data retrieval to get license details
        $.ajax({
            url: '/admin/get-license-details', // مسیری که اطلاعات لایسنس‌ها را بر می‌گرداند
            method: 'GET',
            data: { productId: productId }, // شناسه محصول برای دریافت اطلاعات

            success: function(response) {
                // برای هر لایسنس، یک فیلد اضافه کنید
                response.licenses.forEach(function(license) {
                    var typeInput = $('<input>').attr({
                        type: 'text',
                        class: 'form-control',
                        name: 'type[]',
                        // id:"type-of-Subscription",
                        placeholder: 'Type of Subscription',
                        value: license.type // مقدار نوع لایسنس
                    });

                    var priceInput = $('<input>').attr({
                        type: 'text',
                        class: 'form-control',
                        name: 'cost[]',
                        // id:"price-of-Subscription",
                        placeholder: 'Price of Subscription',
                        value: Number(license.cost).toLocaleString(),// مقدار قیمت لایسنس
                        onkeyup:separateNum(this.value,this)
                    });

                    var typeFormGroup = $('<div>').addClass('form-group').append(typeInput);
                    var priceFormGroup = $('<div>').addClass('form-group').append(priceInput);

                    moreFieldsDiv.append(typeFormGroup).append(priceFormGroup);
                
                    // document.getElementById("license-fields").style.display = "block";

                    // اضافه کردن خط افقی
                    moreFieldsDiv.append('<hr>');

                    // نمایش فیلدهای لایسنس
                    $('#license-fields').show();
                });
            },
            error: function(xhr, status, error) {
                console.error('Error fetching license details: ' + error);
            }
        });
    }
}



//***********************************Add New License*****************************************
document.getElementById('add-more-update').addEventListener('click', function() {
   
    var newFields = document.createElement('div');
    newFields.innerHTML = `
        <div class="form-group">
            <input type="text" class="form-control" id="type-of-Subscription" name="type[]">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" id="price-of-Subscription" name="cost[]" onkeyup="separateNum(this.value,this);">
        </div>
        <hr>
    `;

    // افزودن عناصر جدید به div با شناسه more-fields
    document.getElementById('more-fields').appendChild(newFields);
});


  function separateNum(value, input) {
        /* seprate number input 3 number */
        var nStr = value + '';
        nStr = nStr.replace(/\,/g, "");
        x = nStr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
        if (input !== undefined) {

            input.value = x1 + x2;
        } else {
            return x1 + x2;
        }
    }
