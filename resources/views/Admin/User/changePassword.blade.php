@extends('layout.admin')

@section('content')

<section class="middle">
            
    <div class="form" dir="rtl">
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-6 col-xl-5">
                <div class="login-form box-1">
                    <h2 class="form-title text-center" id="ChangeModalLabel">Change Password Form</h2>
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

                   <form id="edit-form" action="{{ route('profile_updatePass') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                  
                
                      <div class="form-group">
                          <input type="password" class="form-control"  name="current_password" id="old-password" placeholder="Old Password" required >
                          @error('current_password')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                      </div>
                    
                      <div class="form-group">
                          <input type="password" class="form-control "  name="password" id="new-password" placeholder="New Password" required >
                          {{-- @error('password')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror --}}
                      </div>
                      <div class="form-group">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" id="new-pass-repeat" placeholder="Repeat New password"  >
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                      </div>
                       
                          
                         
                      <button type="submit" id="sub" class="btn btn-theme btn-block btn-form ">Submit </button>
                      
                  </form>
                  
                </div>
            </div>
        </div>
    </div>
    

 

    <canvas id="chart" style="display: none;"></canvas>
   
</section>




@endsection