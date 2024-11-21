 //***********************************UploadImage*****************************************
function initializeImageCategory(uploadUrl, deleteUrl) {
    
    let pond;
        FilePond.registerPlugin(
            FilePondPluginFileValidateType,
            FilePondPluginImagePreview
        );
     pond = FilePond.create(document.querySelector('#upload-i-p'), {
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

    pond.on('removefile', () => {
        const imageName = document.querySelector('#image_path').value;
        if (imageName) {
            fetch(deleteUrl, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ image_name: imageName,directory: 'Images/Category/' })
            }).then(response => response.json()).then(data => {
                if (data.success) {
                    document.querySelector('#image_path').value = '';
                }
            }).catch(error => {
                console.error('Error deleting file:', error);
            });
        }
    });


    return pond;
}


//******************************************Edit Category*********************************************
 
      document.addEventListener('DOMContentLoaded', function() {
        const pond = initializeImageCategory('/admin/upload-image-category', '/admin/delete-image-category');
         var editButtons = document.querySelectorAll('.edit-category');
         editButtons.forEach(function(button) {
             button.addEventListener('click', function() {
     
                 var categoryId = this.getAttribute('data-category-id');
                 var categoryTitle = this.getAttribute('data-category-name');
                 var categoryDescription = this.getAttribute('data-category-description');
               
                 var categoryImage = this.getAttribute('data-category-image');
               
              
                 document.querySelector('#category-name').value = categoryTitle;
                 document.querySelector('#description-of-category').value = categoryDescription;
                 document.querySelector('#image_path').value = categoryImage;
       
     
             if (categoryImage) {
                 pond.removeFiles();
                 pond.addFile(baseUrl + 'Images/Category/' + categoryImage, {
                     type: 'local', // Indicate it's a preloaded file
                     source: baseUrl + 'Images/Category/' + categoryImage,
                     options: {
                         type: 'local'
                     }
                 });
                
             } 
     
     
                 // تنظیم فرم برای ویرایش
                 var form = document.querySelector('#edit-category-form');
                 form.setAttribute('action', '/admin/categoryUpdate/' + categoryId);
             });
         });
     
         
     });
     

//******************************************Delete category*********************************************

document.addEventListener('DOMContentLoaded', function() {
    let   categoryId;

    // Event listener for each delete button
    document.querySelectorAll('.delete-category').forEach(function(button) {
        button.addEventListener('click', function() {
              categoryId = button.getAttribute('data-category-id');

        });
    });

    // Event listener for the modal delete button
    document.getElementById('delete-c').addEventListener('click', function() {
        fetch('/admin/categoryDelete/' +  categoryId, {
            method: 'GET'
        })
        .then(response => {
            console.log('category deleted successfully');
            // Refresh the page or update the UI accordingly
            location.reload();
        })
        .catch(error => {
            console.error('Error deleting category:', error);
            // Handle error appropriately
        });
    });
});

