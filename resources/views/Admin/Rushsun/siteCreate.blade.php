@extends('layout.admin')

@section('content')

<section class="middle">
            
    <div class="form" dir="">
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-6 col-xl-5">
                <div class="login-form box-1">
                    <h2 class="form-title text-center" id="form-site">Form Site</h2>
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                   @endif
                  
                    <form id="add-user-form" action="{{ route('site_insert') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control" id="name" placeholder="Name" name="name" required>
                        </div>

                        <div class="form-group">
                            <input type="number" class="form-control" id="experience" placeholder="Experience Years" name="experience" >
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control" id="completed_projects" placeholder="Completed Projects" name="completed_projects" >
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" id="email" placeholder="Email" name="email" >
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" id="Phone" name="tel" placeholder="Phone Number" >
                        </div>
                      
                        
                        <div class="form-group">
                            <input type="text" class="form-control" id="instagram" name="instagram" placeholder="Instagram" >
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" id="tweeter" name="tweeter" placeholder="Tweeter" >
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" id="facebook" name="facebook" placeholder="Facebook" >
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" id="telegram" name="telegram" placeholder="Telegram" >
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" id="address" name="address" placeholder="Address" >
                        </div>

                        <div class="form-group">
                            <textarea class="form-control" placeholder="Description"  id="description-of-site" name="description"></textarea>
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

<script   src="{{ asset('AdminPanel/js/FilePond/site-config.js') }}"></script>
     


@endsection