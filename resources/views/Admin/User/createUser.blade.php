@extends('layout.admin')

@section('content')

<section class="middle">
            
    <div class="form" dir="">
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-6 col-xl-5">
                <div class="login-form box-1">
                    <h2 class="form-title text-center" id="f-m">Form Users</h2>
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                   @endif
                  
                    <form id="add-user-form" action="{{ route('user_insert') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control" id="f-l" placeholder="FullName" name="name" required>
                        </div>

                        <div class="form-group">
                            <input type="number" class="form-control" id="national-code" placeholder="National Code" name="national_code" required>
                        </div>


                        <div class="form-group">
                            <input type="text" class="form-control" id="email" placeholder="Email" name="email" required>
                        </div>

                        <div class="form-group">
                            <input type="number" class="form-control" id="Phone" name="tel" placeholder="Phone Number" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="pass" placeholder="Password" name="password" required>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input type="password" class="form-control @error('password') is-invalid @enderror"  id="pass-confirm" placeholder="Repeat password" name="password_confirmation" required>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group ">
                            
                            <select id="inputState" class="form-control" required name="rolename">
                              <option value="" disabled selected id="role" >Role</option>

                              @foreach ($roles as $role)
                              <option value="{{$role->name}}">{{$role->name}}</option>
                              @endforeach
                              
                            </select>
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

                            <input type="hidden"  name="image_name" id="image_path">
                        </div>

                        <button type="submit" id="sub" class="btn btn-theme btn-block btn-form ">Submit </button>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>


    <canvas id="chart" style="display: none;"></canvas>
   
</section>

<script   src="{{ asset('AdminPanel/js/FilePond/user-config.js') }}"></script>
     


@endsection