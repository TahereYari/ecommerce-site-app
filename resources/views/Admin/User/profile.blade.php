@extends('layout.admin')

@section('content')

<section class="middle">
            
    <div class="form" dir="rtl">
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-6 col-xl-5">
                <div class="login-form box-1">
                    <h2 class="form-title text-center" id="edit-profile">Edit Profile</h2>
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                   @endif
                  
                    <form id="edit-user-form" action="{{ route('profile_update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control" id="f-l" placeholder="FullName" name="name" value="{{ auth()->user()->name }}" required>
                        </div>

                        <div class="form-group">
                            <input type="number" class="form-control" id="national-code" placeholder="National Code" name="national_code" value="{{ auth()->user()->national_code }}" required>
                        </div>


                        <div class="form-group">
                            <input type="text" class="form-control" id="email" placeholder="Email" name="email" value="{{ auth()->user()->email }}" required>
                        </div>

                        <div class="form-group">
                            <input type="number" class="form-control" id="Phone" name="tel" value="{{ auth()->user()->tel }}" placeholder="Phone Number" required>
                        </div>
                     
                        <div class="form-group">
                                <label for="formFileMultiple" id="upload-image" class="form-label lab">Upload Image</label>
                        
                                <input type="file" class="filepond" id="upload-i-p"  name="image" 
                                    aria-describedby="imageDescriptionformat,imageDescriptionSize" 
                                    data-allow-reorder="true"
                                   
                                    data-max-file-size="5MB"/>
                               
                                <small id="imageDescriptionSize"  class="form-text text-muted hidden text-muted-u" style="color: rgb(249 3 3) !important">The maximum image size is 5MB.</small>
                                <br>
                                <small id="imageDescriptionformat"  class="form-text text-muted hidden text-muted-u" style="color: rgb(249 3 3) !important">
                                Only image with permitted formats (jpeg,png,jpg) are accepted.</small>
    
                                <input type="hidden" value="{{ auth()->user()->image }}"   name="image_name" id="image_path">
                                <input type="hidden" value="{{ auth()->user()->id }}"   name="user_id" id="user__id">
                           </div>

                        <button type="submit" id="sub" class="btn btn-theme btn-block btn-form ">Submit </button>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>

    <canvas id="chart" style="display: none;"></canvas>
   
</section>
{{-- <script   src="{{ asset('AdminPanel/js/FilePond/user-config.js') }}"></script> --}}
<script>
 
//***********************************UploadImage*****************************************
  document.addEventListener('DOMContentLoaded', () => {
    const imageInputElement = document.querySelector('input[id="upload-i-p"]');
    FilePond.registerPlugin(
        FilePondPluginFileValidateType,
        FilePondPluginImagePreview
    );

    
     imagePondUser  = FilePond.create(imageInputElement);
     var UserImage = document.querySelector('#image_path').value;
   
    if (UserImage) {
            imagePondUser.removeFiles();
            imagePondUser.addFile('{{ asset("Images/User") }}/' + UserImage);
    }
     imagePondUser.setOptions({
      acceptedFileTypes: ['image/jpeg', 'image/png','image/jpg'], // تنظیم پذیرفتن فایل‌های ویدیویی
        maxFileSize: '5MB', // حداکثر اندازه فایل 500 مگابایت
        instantUpload: false,
        fileValidateTypeLabelExpectedTypesMap: {
            'image/jpeg': '.jpeg',
            'image/png': '.png',
            'image/jpg': '.jpg',
        },
        fileValidateTypeLabelExpectedTypes: 'فقط عکس های با فرمت‌های مجاز (jpeg,png,jpg) پذیرفته می‌شوند.',
        labelFileTypeNotAllowed: 'فرمت عکس معتبر نیست.',
        labelMaxFileSizeExceeded: 'اندازه عکس بیش از حد مجاز است.',
        labelMaxFileSize: 'حداکثر اندازه عکس: {filesize}',
        server: {
            process: {
                url: '/admin/upload-image-user',
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
                url: '/admin/delete-image-user',
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

    imagePondUser.on('removefile', () => {
        const imageName = document.querySelector('#image_path').value;
        if (imageName) {
            fetch('/admin/delete-image-user', {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ image_name: imageName,directory: 'Images/User/' })
            }).then(response => response.json()).then(data => {
                if (data.success) {
                    document.querySelector('#image_path').value = '';
                }
            }).catch(error => {
                console.error('Error deleting file:', error);
            });
        }
    });
  });

  

</script>


@endsection