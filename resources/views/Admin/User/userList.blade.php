@extends('layout.admin')

@section('content')

<section class="middle">
    <div class="d-flex justify-content-end mb-4" >

      <a href="{{ route('user_create') }}" class="btn btn-primary btn-lg" id="add-new-user">Add New User</a>
      {{-- &nbsp;&nbsp;&nbsp;&nbsp; --}}
        {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" id="search" data-bs-target="#staticBackdrop">
           Search
        </button> --}}

    </div>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
   @endif
    <table class="table align-middle mb-0 bg-white"  id="example">
        <thead class="bg-light">
          <tr>
            <th ></th>
            <th id="name">Name</th>
            <th id="code">National Code</th>
            <th id="phone">phone number</th>
            <th id="roleuser">Role</th>
            <th id="editUser">Edit</th>
            <th id="delete">Delete</th>
            
            
          </tr>
        </thead>
        <tbody id="tableBody">
          @foreach ($users as $user)
          <tr>
            <td>
              <div class="d-flex align-items-center">
               @if ($user->image != null)
                  <img
                  src="{{ asset('Images/User/'.$user->image) }}"
                  alt=""
                  style="width: 45px; height: 45px"
                  class="rounded-circle"
                  />
                @else
                  <img
                  src="{{ asset('AdminPanel/images/userImage.png')  }}"
                  alt=""
                  style="width: 45px; height: 45px"
                  class="rounded-circle"
                  />


               @endif
               
              
              </div>
              <td>
                 
                <div class="ms-3" id="nama-u">
                  {{ $user->name }}
                  
                </div>
              </td>
            </td>
            <td>
               {{ $user->national_code }}
              
            </td>
            <td>
              
              {{ $user->tel }}
            </td>
            <td >{{ $user->role }}</td>
            <td >
              <button type="button" class="btn btn-primary btn-sm edit-user"  data-bs-toggle="modal" id="edit-u" data-bs-target="#addNewItemModal"
                  data-id="{{ $user->id }}"
                  data-name="{{ $user->name }}"
                  data-national_code="{{ $user->national_code }}"
                  data-email="{{ $user->email }}"
                  data-tel="{{ $user->tel }}"
                  data-role="{{ $user->role }}" 
                  data-image-user="{{ $user->image }}"

                  {{-- @if ($user->image!=null)
                     data-image="{{ asset('Images/user/'.$user->image) }}"
                     @else
                      data-image="{{ asset('AdminPanel/images/userImage.png') }}"
                  @endif --}}
                 
              >
                Edit
              </button>

              {{-- <a href="{{ route('user_edit',['id'=>$user->id ]) }}" class="btn btn-primary btn-sm ">
                edit
              </a> --}}
            </td>
            <td id="costt">
              <button type="button" data-user-id="{{ $user->id }}" class="btn btn-danger delete-user" data-bs-toggle="modal" id="delete-u" data-bs-target="#exampleModal">
                delete
              </button>
            </td>
            
          </tr>
          @endforeach
          
          
        </tbody>
      </table>
    
      {{-- <div class="row mt-3" >
       
          {{  $users->links()}}
        
       
      </div> --}}
    <canvas id="chart" style="display: none;"></canvas>
   
</section>



 <!-- Modal -->
 <div class="modal fade" id="addNewItemModal" tabindex="-1" aria-labelledby="addNewItemModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"  id="addNewItemModalLabel">Edit Form Users</h5>
       
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <!-- Form to add new item -->
        <h2 class="form-title text-center" id="form-user-edit">Form Users</h2>
                    <form id="edit-form" action="" method="POST" enctype="multipart/form-data">
                      @csrf
                  
                      <div class="form-group">
                            <input type="text" class="form-control" id="full-name" placeholder="FullName" name="name" required>
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control" id="code-national" placeholder="National Code" name="national_code" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="email" placeholder="Email" name="email" required>
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control" id="tel" placeholder="Phone Number" name="tel" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" >
                            {{-- @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror --}}
                          </div>
                          <div class="form-group">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" id="pass-repeat" placeholder="Repeat password" >
                            
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                          </div>
                          <div class="form-group ">
                            <select id="inputState" class="form-control" required  name="rolename">
                              <option value="" disabled selected id="rolename">Role</option>
                              @foreach ($roles as $role)
                              <option value="{{$role->name}}">{{$role->name}}</option>
                              @endforeach
                             
                            </select>
                          </div>    
                          {{-- <div class="form-group">
                              <input type="file" class="form-control-file form-control" id="upload" aria-describedby="fileDescription" name="image">
                              <div id="thumbnail-container" class="thumbnail">
                              <img id="preview-image" 
                              
                              @if ($user->image!= null)
                              src=  "{{ asset('Images/user/'.$user->image) }}" 
                              @else
                              src=  "{{ asset('AdminPanel/images/userImage.png') }}" 
                              @endif
                            
                              alt="User Image" style="max-width: 50%; margin-top: 10px;">
                              
                              </div>

                          </div> --}}
                      
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

                            <input type="hidden"   name="image_name" id="image_path">
                       </div>
                            
                           
                        <button type="submit" id="sub" class="btn btn-theme btn-block btn-form ">Submit </button>
                        
                    </form>
        </div>
    </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" >Modal Delete</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="modal-body" style="font-size: 20px;">
        Are you sure to delete?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="close-d" data-bs-dismiss="modal">Close</button>
        <button type="button" id="delete-d" class="btn btn-danger ">delete</button>

     
      </div>
    </div>
  </div>
</div>

<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Modal Search</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="d-flex">
          
          <input class="form-control" type="search" placeholder="Search..." aria-label="Search" id="search-s" >
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="s-close" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="s-search">search</button>
      </div>
    </div>
  </div>
</div>
<script   src="{{ asset('AdminPanel/js/FilePond/user-config.js') }}"></script>



</script>
@endsection