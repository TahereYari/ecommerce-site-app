@extends('layout.admin')

@section('content')





<section class="middle">
            
    <div class="form" >
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-6 col-xl-5">
                <div class="login-form box-1">
                    <h2 class="form-title text-center" id="form-add-product">Add New Role</h2>
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                   @endif

                    <form id="product-form" action="{{ route('product_insert') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                        <div class="form-group">
                          <input type="text" class="form-control" placeholder="Name product" id="name-product" name="name" required>
                        </div>
                        <div class="form-group">
                          <input type="text" class="form-control" id="price-product" name="price"  placeholder="Price product" onkeyup="separateNum(this.value,this);">
                          <span id="not-enter-price">
                            If the product is licensed, do not enter the price. 
                          </span>
                        </div>
                        <div class="form-group">
                          <textarea class="form-control" placeholder="Description"  id="description-of-product" name="description"></textarea>
                        </div>
                        
                        <div class="form-group ">
                          <select id="inputState" class="form-control" required name="categoryName">
                            <option selected id="categoryName" disabled>Category</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="form-check form-switch ">
                          <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefaultlicense" name="license" onclick="showLicenseFields(this)">
                          <label class="form-check-label li" for="flexSwitchCheckDefault" id="license">license</label>
                        </div>
                        <div class="form-check form-switch mt-3 ">
                          <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="free">
                          <label class="form-check-label" for="flexSwitchCheckDefault" id="free-Product" >Free</label>
                        </div>  
                        <div class="form-group" id="license-fields" style="display: none;">
                          <a   id="add-moree" class="btn btn-primary">Add</a>
                          <div id="more-fields">
                            <div class="form-group">
                              <input type="text" class="form-control" id="type-of-Subscription" name="type[]" placeholder="Type of Subscription" >
                            </div>
                            <div class="form-group">
                              <input type="text" class="form-control" id="price-of-Subscription" name="cost[]" placeholder="Price of Subscription" onkeyup="separateNum(this.value,this);">
                            </div>
                          </div>
                          <hr>
                          

                        </div>

                        <div class="form-group mt-5">
                          <label for="formFileMultiple" id="upload-file"  class="form-label lab">Upload File </label>
                          <input type="file" class="filepond"  id="upload-f-p" name="file" multiple  
                            aria-describedby="fileDescriptionSize,fileDescriptionformat" required
                            data-allow-reorder="true"
                            data-max-file-size="500MB"
                           />
                           
                          <small id="fileDescriptionSize"  class="form-text text-muted hidden text-muted-u" style="color: rgb(249 3 3) !important">The maximum file size is 500 MB.</small>
                         <br>
                          <small id="fileDescriptionformat"  class="form-text text-muted hidden text-muted-u" style="color: rgb(249 3 3) !important">
                            Only files with permitted formats (rer, zip) are accepted.</small>
                            <input type="hidden"  name="file_name" id="file_path">
                        </div>
                        <hr>
                        <div class="form-group">
                          <label for="formFileMultiple" id="upload-image" class="form-label lab">Upload Image</label>
                    
                          <input type="file" class="filepond" id="upload-i-p"  name="image" 
                          aria-describedby="imageDescriptionformat,imageDescriptionSize" required
                          data-allow-reorder="true"
                           data-max-file-size="5MB"/>
                          {{-- <div id="thumbnail-container" class="thumbnail"></div> --}}
                          <small id="imageDescriptionSize"  class="form-text text-muted hidden text-muted-u" style="color: rgb(249 3 3) !important">The maximum image size is 5MB.</small>
                         <br>
                          <small id="imageDescriptionformat"  class="form-text text-muted hidden text-muted-u" style="color: rgb(249 3 3) !important">
                            Only image with permitted formats (jpeg,png,jpg) are accepted.</small>

                          <input type="hidden"  name="image_name" id="image_path">

                        </div>
                        <hr>

                        <div class="form-group">
                          <label for="formFileMultiple" id="upload-video" class="form-label lab">Upload Video</label>
                          <input type="file" class="filepond" id="upload-v-p" name="video"
                           aria-describedby="videoDescriptionformat,fileDescriptionSize" required
                           data-allow-reorder="true"
                            data-max-file-size="500MB"
                            
                           />
                          <small id="videoDescriptionSize"  class="form-text text-muted hidden text-muted-u" style="color: rgb(249 3 3) !important">The maximum video size is 500 MB.</small>
                         <br>
                          <small id="videoDescriptionformat"  class="form-text text-muted hidden text-muted-u" style="color: rgb(249 3 3) !important">
                            Only video with permitted formats (mp4, avi, mov) are accepted.</small>

                          <input type="hidden"  name="video_name" id="video_path">
                        </div>
                      
                        {{-- <progress id="fileProgress" value="0" max="100" class="progress progress-u"></progress>
                        <span id="progressPercent" class="progress-text">0%</span>
                        <div class="progress-indicator p-3">
                            <button type="button" id="Start-uploading" class="btn btn-theme uploadButton">Start Uploading</button>
                            
                        </div> --}}
                        <button type="submit" id="submit" class="btn btn-theme btn-block btn-form">Submit </button>
                      </div> 
                      
                    
                    </form>


                </div>
            </div>
        </div>
    </div>
    

    <canvas id="chart" style="display: none;"></canvas>
   
</section>
<script   src="{{ asset('AdminPanel/js/FilePond/product-config.js') }}"></script>

<script>

  document.getElementById('flexSwitchCheckDefaultlicense').addEventListener('change', function() {
    var priceField = document.getElementById('price-product');
    if (this.checked) {
      priceField.removeAttribute('required');
    } else {
      priceField.setAttribute('required', 'required');
    }
  });


  document.getElementById('product-form').addEventListener('submit', function(event) {
    var licenseCheckbox = document.getElementById('flexSwitchCheckDefaultlicense');
    var priceField = document.getElementById('price-product');

    if (!licenseCheckbox.checked && !priceField.hasAttribute('required')) {
      priceField.setAttribute('required', 'required');
      // Trigger form validation by focusing and blurring the field
      priceField.focus();
      priceField.blur();
    }
  });





  </script>




@endsection