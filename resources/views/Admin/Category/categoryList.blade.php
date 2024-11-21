@extends('layout.admin')


@section('content')

<section class="middle">
    <div class="d-flex justify-content-end mb-4">
  
        <a href="{{ route('category_create') }}" id="add-new-category" class="btn btn-primary  btn-lg">
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
  
    <table class="table align-middle mb-0 bg-white"  id="example">
        <thead class="bg-light">
          <tr>
            <th ></th>
            <th id="name-of-category">Name</th>
            <th id="discription-of-category">Discription</th>
            <th id="Edit">Edit</th>
            <th id="Delete">Delete</th>
           
            
            
          </tr>
        </thead>
        <tbody id="tableBody">
            @foreach ($categorys as $category)
            <tr>

                <td>
                    <div class="d-flex align-items-center">
                     @if ($category->image != null)
                        <img
                        src="{{ asset('Images/Category/'.$category->image) }}"
                        alt=""
                        style="width: 45px; height: 45px"
                        class="rounded-circle"
                        />
                      @else
                        <img
                        src="{{ asset('AdminPanel/images/category.png')  }}"
                        alt=""
                        style="width: 45px; height: 45px"
                        class="rounded-circle"
                        />
      
      
                     @endif
                     
                    
                    </div>
                   
                  </td>
                <td>
                    <div class="ms-3">{{ $category->name }}</div>
                </td>
        
              
            
                <td>
                    <div class="description-cell fw-normal mb-1">{{ $category->description }}</div>
                </td>
              
            
                <td id="subs">
                    <button type="button" class="btn btn-primary btn-sm  edit-category"  data-bs-toggle="modal" id="edit-c" data-bs-target="#addNewItemModal"
                        data-category-id ="{{ $category->id }}"
                        data-category-name = "{{$category->name}}"
                        data-category-description = "{{$category->description}}"
                        data-category-image = "{{$category->image}}"
                    >
                    Edit
                    </button>
                    
                

                </td>
            
                <td id="costt">
                  <button type="button" data-category-id="{{ $category->id }}"  class="btn btn-danger delete-category" data-bs-toggle="modal" id="delete-c" data-bs-target="#exampleModal">
                      Delete
                  </button>
                </td>
                
            </tr>

  
            @endforeach
       
          
          
        </tbody>
    </table>
    
    {{-- <canvas id="chart" style="display: none;"></canvas> --}}
   
  </section>


   <!-- Modal -->
 <div class="modal fade" id="addNewItemModal" tabindex="-1" aria-labelledby="addNewItemModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"  id="edit-form-category">Edit Form Category</h5>
         
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <!-- Form to add new item -->
               <h2 class="form-title text-center" id="form-category-edit">Edit Category</h2>
                   
                        <form id="edit-category-form" action="" method="POST" enctype="multipart/form-data">
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
          
                            <button type="submit" id="submit" class="btn btn-block btn-theme btn-form">Submit</button>
                
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
        Are you sure you want to delete?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="close-d" data-bs-dismiss="modal">Close</button>
        <button type="button" id="delete-d" class="btn btn-danger ">delete</button>
      </div>
    </div>
  </div>
</div>

<script   src="{{ asset('AdminPanel/js/FilePond/category-config.js') }}"></script>


@endsection