@extends('layout.admin')

@section('content')

<section class="middle">
            
    <div class="form">
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-6 col-xl-5">
                <div class="login-form box-1">
                    <h2 class="form-title text-center" id="form-categorys">Form Categories</h2>
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                   @endif
                
                    <form id="add-category-form" action="{{ route('category_insert') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="form-group">
                            <input type="text" class="form-control" id="category-name" placeholder="Category Name" name="name" required>
                        </div>

                        <div class="form-group">
                            <textarea class="form-control" placeholder="Description"  id="description-of-category" name="description"></textarea>
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

<script   src="{{ asset('AdminPanel/js/FilePond/category-config.js') }}"></script>

  

@endsection