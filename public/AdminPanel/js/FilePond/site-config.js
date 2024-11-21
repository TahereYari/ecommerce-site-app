   //***********************************UploadImage*****************************************
function initializeImageSite(uploadUrl, deleteUrl) {
    
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
                body: JSON.stringify({ image_name: imageName,directory: 'Images/Site/' })
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

  
  //******************************************Edite User*********************************************

  document.addEventListener('DOMContentLoaded', function() {
    const pond = initializeImageSite('/admin/upload-image-site', '/admin/delete-image-site');
    var editButtons = document.querySelectorAll('#edit-u');
    editButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var userId = this.getAttribute('data-id');
            var userName = this.getAttribute('data-name');
            var userNationalCode = this.getAttribute('data-national_code');
            var userEmail = this.getAttribute('data-email');
            var userTel = this.getAttribute('data-tel');
            var userRole = this.getAttribute('data-role');
            var userImage = this.getAttribute('data-image-user');
       
            

            document.querySelector('#full-name').value = userName;
            document.querySelector('#code-national').value = userNationalCode;
            document.querySelector('#email').value = userEmail;
            document.querySelector('#tel').value = userTel;
            document.querySelector('#inputState').value = userRole;
            document.querySelector('#image_path').value = userImage;
           
          
          
            if (userImage) {
                pond.removeFiles();
                pond.addFile(baseUrl + 'Images/Site/' + userImage, {
                    type: 'local', // Indicate it's a preloaded file
                    source: baseUrl + 'Images/Site/' + userImage,
                    options: {
                        type: 'local'
                    }
                });
               
            } 


            var form = document.querySelector('#edit-site-form');
            form.setAttribute('action', '/admin/userUpdate/' + userId);
        });
    });

  

});


//******************************************Delete User*********************************************

document.addEventListener('DOMContentLoaded', function() {
    let userId;

    // Event listener for each delete button
    document.querySelectorAll('.delete-user').forEach(function(button) {
        button.addEventListener('click', function() {
            userId = button.getAttribute('data-user-id');
           
        });
    });

    // Event listener for the modal delete button
    document.getElementById('delete-d').addEventListener('click', function() {
        fetch('/admin/userDelete/' + userId, {
            method: 'GET'
        })
        .then(response => {
            console.log('User deleted successfully');
            // Refresh the page or update the UI accordingly
            location.reload();
        })
        .catch(error => {
            console.error('Error deleting user:', error);
            // Handle error appropriately
        });
    });
});
