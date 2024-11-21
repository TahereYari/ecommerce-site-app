@extends('layout.admin')


@section('content')

<section class="middle">
  <div class="d-flex justify-content-end mb-4">
      {{-- <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" id="add-new-product" data-bs-target="#addNewItemModal">
          Add New Product
      </button> --}}
      <a href="{{ route('product_create') }}" id="add-new-product" class="btn btn-primary  btn-lg">
          Add New Product
      </a>

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
  <table class="table align-middle mb-0 bg-white" id="example">
      <thead class="bg-light">
        <tr>
          <th id="image">Image</th>
          <th id="name">Name</th>
         
          <th id="price">Price</th>
          <th id="categoryName">Category</th>
          <th id="description">Description</th>
        
          {{-- <th id="type">Type</th> --}}
          <th id="free">Free</th>
          <th id="Has_license">license</th>
          <th id="Edit">Edit</th>
          <th id="Delete">Delete</th>
          
        </tr>
      </thead>
      <tbody>

        @foreach ($products as $product)
        <tr>
          <td>
            <div class="d-flex align-items-center">
              @if ($product->image != null)
                  <img
                  src="{{ asset('Images/Product/Images/'.$product->image) }}"
                  alt=""
                  style="width: 45px; height: 45px"
                  class="rounded-circle"
                  />
                @else
                  <img
                  src="{{ asset('AdminPanel/images/product.png')  }}"
                  alt=""
                  style="width: 45px; height: 45px"
                  class="rounded-circle"
                  />


               @endif
              
            </div>
          </td>
          <td class="fw-normal mb-1">
            {{  $product->name }}
          </td>
          <td class="fw-normal mb-1">
            {{  number_format($product->price) }}
          </td>
          <td class="fw-normal mb-1">
            {{  $product->category()->name }}
          </td>

          <td  class="description-cell fw-normal mb-1">{{  $product->description }} </td>
          
            @if ($product->free=='1')
          
              <td class="fw-normal mb-1 Yes" id="">
                {{-- <i class="fa fa-check" aria-hidden="true" style="font-size:26px;color:rgb(57, 190, 16)"></i> --}}
                Yes</td>
            @else
             <td class="fw-normal mb-1 No" id="">No</td>
            @endif

      

          @if ($product->license=='1')
            <td >
              {{-- <p class="fw-normal mb-1 Yes">Has It</p> --}}
              
              <a href="{{ route('show_licenses',['id'=>$product->id]) }}"  class="btn btn-success btn-sm view-license"  id="license-preview" > View</a>
          
            </td>
          @else
          <td class="fw-normal mb-1 No_license" id="">Does Not Have </td>
          @endif
          

          <td id="subs">
              <button type="button" class="btn btn-primary btn-sm  edit-pp"  data-bs-toggle="modal" id="edit-p" data-bs-target="#addNewItemModal"
                  data-id ="{{ $product->id }}"
                  data-product-name = "{{$product->name}}"
                  data-product-price = "{{$product->price}}"
                  data-discription-product="{{ $product->description }}"
                  data-license-product="{{ $product->license }}"
                  data-free-product="{{ $product->free }}"
                  data-license-product="{{ $product->license }}"
                  data-file-product="{{ $product->file }}"
                  data-image-product="{{ $product->image }}"
                  data-video-product="{{ $product->video }}"
                  data-category="{{ $product->category_id }}" 
                >
                Edit
              </button>
              
           

         </td>
            <td id="costt">
              <button type="button" data-product-id="{{ $product->id }}"  class="btn btn-danger delete-product delete-pp" data-bs-toggle="modal" id="delete-pp" data-bs-target="#exampleModal">
                Delete
              </button>
            </td>
            
        </tr>
        
        @endforeach
   
      </tbody>
  </table>
  

  <canvas id="chart" style="display: none;"></canvas>
 
</section>




<!-- Modal -->
<div class="modal fade" id="addNewItemModal" tabindex="-1" aria-labelledby="addNewItemModalProduct" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
  <div class="modal-header">
  <h5 class="modal-title" id="addNewItemModalProduct">Edit Product</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
  </div>
  <div class="modal-body">
  <!-- Form to add new item -->
 
  <form id="edit-form" action="" method="POST" enctype="multipart/form-data">
    @csrf
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Name product" id="name-product" name="name" required>
        </div>

        <div class="form-group">
          <input type="text" class="form-control" id="price-product" name="price"  placeholder="Price product" >
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
          <input class="form-check-input" type="checkbox"  name="license" id="product-license" onclick="showLicenseFields(this)">
          <label class="form-check-label li" for="flexSwitchCheckDefault" id="license">license</label>
        </div>

        <div class="form-check form-switch mt-3 ">
          <input class="form-check-input" type="checkbox"  name="free" id="product-free"  >
          <label class="form-check-label" for="flexSwitchCheckDefault" id="free-Product" >Free</label>
        </div>  

        <div class="form-group" id="license-fields" style="display: none;">
          <a id="add-more-update" class="btn btn-primary">Add</a>
        
          <div id="more-fields">
            <div class="form-group">
              <input type="text" class="form-control" id="type-of-Subscription" name="type[]" placeholder="Type of Subscription" >
            </div>
            <div class="form-group">
              <input type="text" class="form-control" onkeyup="separateNum(this.value,this);" id="price-of-Subscription" name="cost[]" placeholder="Price of Subscription" >
            </div>
          </div>
          {{-- <hr> --}}

        </div>

        <div class="form-group mt-5">
          <label for="formFileMultiple" id="upload-file"  class="form-label lab">Upload File </label>
          <input type="file" class="filepond"  id="upload-f-p" name="file" multiple required 
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

        <button type="submit" id="submit" class="btn btn-theme btn-block btn-form">Submit </button>
        </div> 


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
        <button type="button" id="delete-p" class="btn btn-danger ">delete</button>

     
      </div>
    </div>
  </div>
</div>


<script   src="{{ asset('AdminPanel/js/FilePond/product-config.js') }}"></script>

   
@endsection