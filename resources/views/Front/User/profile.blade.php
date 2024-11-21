@php
  use App\Models\BasketProduct;
@endphp
@extends('Front.User.user')

@section('content')

   
  <div class="container emp-profile">
    <form method="post">
      <div class="row">
        <div class="col-md-4">
          <div class="profile-img">
            @if (auth()->user()-> image != null)
             <img src="{{ asset('Images/User/' . auth()->user()-> image) }}" alt=""/>
            @else
             <img src="{{ asset('AdminPanel/images/userImage.png') }}" alt=""/>
            @endif
           
            {{-- <div class="file btn btn-lg btn-primary" id="change-photo">
              Change Photo
              <input type="file" name="file"/>
              
            </div> --}}
          </div>
        </div>
        
        
        
        <div class="col-md-6">
          <div class="profile-head">
            @if (auth()->user()->name != null)
              <h5 id="">{{ auth()->user()->name }}</h5>
            @endif
           
            <h6 id=""></h6>
            
            <p class="proile-rating" id=""></span></p>
            
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home1" role="tab" aria-controls="home" aria-selected="true">profile</a>
              </li>
              {{-- <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile1" role="tab" aria-controls="profile" aria-selected="false">List of courses</a>
              </li> --}}
            </ul>
          </div>
        </div>
        
        <div class="col-md-2">
          <div class="btn-group btn-group-wide">
            <button type="button" class="btn btn-primary" id="edit-p" data-bs-toggle="modal" data-bs-target="#exampleModal">
              edit profile
            </button>
          
          </div>
        </div>
          
        
          
      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="profile-work">
            <p id="purchased">Purchased courses</p>
          
              @foreach ($products as $product)
                <a id="" href="{{ route('view_product',['id'=>$product->id]) }}">{{ $product->name }}</a><br />
              @endforeach
           
         
            
          </div>
          
        </div>
        
        <div class="col-md-8">
          <div class="tab-content profile-tab" id="myTabContent">
            
            <div class="tab-pane fade show active" id="home1" role="tabpanel" aria-labelledby="home-tab">
                
              <!-- About content -->
              <div class="row">
                <div class="col-md-6">
                    <label class="userName">User Name</label>
                </div>
                <div class="col-md-6">
                  @if (auth()->user()->name != null)
                    <p id="">{{ auth()->user()->name }}</p>
                  @endif
                   
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <label class="email">Email</label>
                </div>
                <div class="col-md-6">
                    @if (auth()->user()->email != null)
                    <p >{{ auth()->user()->email }}</p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label class="phone">Phone</label>
                </div>
                <div class="col-md-6">
                  @if (auth()->user()->tel != null)
                  <p id="">{{ auth()->user()->tel }}</p>
                  @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label class="national_code" >National Code</label>
                </div>
                <div class="col-md-6">
                  <div class="col-md-6">
                    @if (auth()->user()->national_code != null)
                    <p id="">{{ auth()->user()->national_code }}</p>
                    @endif
                  </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label id="password">Change password</label>
                </div>
                <!-- Button to trigger the modal -->
            <div class="col-md-6">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" id="change-password" data-bs-target="#changePasswordModal">
                Change password
                </button>
            </div>


                
            </div>
            </div>

            {{-- <div class="tab-pane fade" id="profile1" role="tabpanel" aria-labelledby="profile-tab">
              <!-- Timeline content -->
              
              <div class="row">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th scope="col" id="">Educational title</th>
                        <th scope="col" id="">Last update time</th>
                        <th scope="col" id="">Evidence</th>
                      </tr>
                    </thead>
                      <tbody>
                        <tr>
                          <td id="">Python</td>
                          <td>2024/4/7</td>
                          <td>gfgfgf</td>
                        </tr>
                      
                      </tbody>
                    </table>
              </div>
              
            </div> --}}

          </div>
        </div>
      </div>
    </form>
    
  </div>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
            
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              
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
              <form id="edit-user-form" action="{{ route('profile_update_user') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <input type="text" class="form-control" id="f-l" placeholder="FullName" name="name"
                    value="{{ auth()->user()->name }}" required>
                </div>
              
                <div class="form-group">
                  <input type="number" class="form-control" id="national-code" placeholder="National Code" name="national_code"
                    value="{{ auth()->user()->national_code }}" required>
                </div>
              
              
                <div class="form-group">
                  <input type="text" class="form-control" id="email" placeholder="Email" name="email"
                    value="{{ auth()->user()->email }}" required>
                </div>
              
                <div class="form-group">
                  <input type="number" class="form-control" id="Phone" name="tel" value="{{ auth()->user()->tel }}"
                    placeholder="Phone Number" required>
                </div>
              
                <div class="form-group">
                  <label for="formFileMultiple" id="upload-image" class="form-label lab">Upload Image</label>
              
                  <input type="file" class="filepond" id="upload-i-p" name="image"
                    aria-describedby="imageDescriptionformat,imageDescriptionSize" data-allow-reorder="true"
                    data-max-file-size="5MB" />
              
                  <small id="imageDescriptionSize" class="form-text text-muted hidden text-muted-u"
                    style="color: rgb(249 3 3) !important">The maximum image size is 5MB.</small>
                  <br>
                  <small id="imageDescriptionformat" class="form-text text-muted hidden text-muted-u"
                    style="color: rgb(249 3 3) !important">
                    Only image with permitted formats (jpeg,png,jpg) are accepted.</small>
              
                  <input type="hidden" value="{{ auth()->user()->image }}" name="image_name" id="image_path">
                  <input type="hidden" value="{{ auth()->user()->id }}" name="user_id" id="user__id">
                </div>
              
                <button type="submit" id="sub" class="btn btn-theme btn-block btn-form ">Submit </button>
              
              </form>
          </div>
        
      </div>
    </div>
  </div>
  <!-- Modal form for changing password -->
  <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                  <div>
                      {{ session('success') }}
                  </div>
            @endif
          <form id="edit-form" action="{{ route('profile_changPass') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
              
              <input type="password" class="form-control" name="current_password" id="current-password" placeholder="Current Password:"
                  required>
                @error('current_password')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="mb-3">
              <input type="password" class="form-control " name="password" id="new-password" placeholder="New Password:" required>
            </div>
            <div class="mb-3">
              <input type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation"
                  placeholder="Confirm New Password:" id="confirm-password">
                @error('password')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="modal-footer">
            
              <button type="submit" class="btn btn-primary" id="change">Change Password</button>
            </div>
          </form>
        </div>
       
      </div>
    </div>
  </div>

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
                // body: JSON.stringify({ image_name: imageName })
                body: JSON.stringify({ image_name: imageName,directory: 'Images/User/' })
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
  });

  

</script>


@endsection