@extends('layout.admin')

@section('content')

<section class="middle">
    <div class="d-flex justify-content-end mb-4">

      <a href="{{ route('role_create') }}" class="btn btn-primary  btn-lg" id="add-new-Role">Add New Role</a>
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
           
            <th id="rolename">Role Name</th>
            <th id="permissions">Permissions</th>
            <th id="Edit">Edit</th>
            <th id="Delete">Delete</th>
           
            
            
          </tr>
        </thead>
        <tbody id="tableBody">
          @foreach ($roles as $role)
          <tr>
              <td>
                 
                <div class="ms-3" id="nama-u">
                  {{ $role->name }}
                  
                </div>
              </td>
            
            <td >
              @php
                $permissionsOfRole = $role->permissions;
              @endphp
               {{-- {{ $role->permissions->pluck('name') }} --}}

              @foreach ($permissionsOfRole as $permission) 
                {{-- {{ $permission->label.'-' }}  --}}
                <span class="permission-label" data-en="{{ $permission->name.' '.'-' .' '}}" data-fa="{{ $permission->label.' '.'-' .' '}}">
                  @if (app()->getLocale() == 'fa')
                  {{ $permission->label }} 
                  @else
                    {{ $permission->name }}
                  @endif
                
               </span>
                

               
                @endforeach
            
              
            </td>

            <td id="subs">
              <button type="button" class="btn btn-primary btn-sm edit-role"  data-bs-toggle="modal" id="edit-r" data-bs-target="#addNewItemModal"
                  data-id-role ="{{ $role->id }}"
                  data-role-name = "{{$role->name}}"
                  data-permissions="{{ $role->permissions->pluck('name') }}"
                >
                edit
              </button>
              
           

            </td>
            <td id="costt">
              <button type="button" data-role-id="{{ $role->id }}" class="btn btn-danger delete-role" data-bs-toggle="modal" id="delete-r" data-bs-target="#exampleModal">
                delete
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
          <h5 class="modal-title"  id="edit-form-role">Edit Form Role</h5>
        
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <!-- Form to add new item -->
               <h2 class="form-title text-center" id="form-role-edit">Form Roles</h2>
                    <form id="edit-role-form" action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                          <input type="text" class="form-control" id="nameOfRol" required  placeholder="role name.." name="rolename">
                        </div>

                        <div class="container-m">
                          <div class="custom-combobox-container">
                              <div class="custom-combobox" onclick="showOptions(this)">
                                  <input type="text" placeholder="Permissions" id="inputCheckbox" readonly><i class='bx bx-chevron-down down'></i>
                                  
                              </div>
                              <div class="options-container" id="divOptions" onmouseleave="hideOptions(this)" >
                                  @foreach ($permissions as $permission)
                                  <label for="{{ $permission->name }}">
                                      <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->name }}" id="{{ $permission->name }}" onchange="updateInputCheckbox(this)"> 
                                      
                                      <span class="permission-label" data-en="{{ $permission->name }}" data-fa="{{ $permission->label }}">
                                        {{ app()->getLocale() == 'fa' ? $permission->label : $permission->name }}
                                     </span>
                                  
                                    </label>

                                  @endforeach
                                  
                              </div>
                          </div>
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

<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Modal Search</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-d"></button>
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


<script>

  //******************************************Edit role*********************************************

  document.addEventListener('DOMContentLoaded', function() {
    var editButtons = document.querySelectorAll('.edit-role');
    editButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var roleId = this.getAttribute('data-id-role');
            var roleName = this.getAttribute('data-role-name');
            var permissions = JSON.parse(this.getAttribute('data-permissions').replace(/&quot;/g,'"'));
         
            // تنظیم نام رول
            document.querySelector('#nameOfRol').value = roleName;

            // تنظیم تیک برای مجوزها
            var checkboxes = document.querySelectorAll('.form-check-input');
            checkboxes.forEach(function(checkbox) {
                if (permissions.includes(checkbox.value)) {
                    checkbox.checked = true;
                } else {
                    checkbox.checked = false;
                }
            });

            // تنظیم فرم برای ویرایش
            var form = document.querySelector('#edit-role-form');
            form.setAttribute('action', '/admin/roleUpdate/' + roleId);
        });
    });
});


//******************************************Delete role*********************************************

document.addEventListener('DOMContentLoaded', function() {
    let roleId;

    // Event listener for each delete button
    document.querySelectorAll('.delete-role').forEach(function(button) {
        button.addEventListener('click', function() {
            roleId = button.getAttribute('data-role-id');
           
        });
    });

    // Event listener for the modal delete button
    document.getElementById('delete-d').addEventListener('click', function() {
        fetch('/admin/roledelete/' + roleId, {
            method: 'GET'
        })
        .then(response => {
            console.log('role deleted successfully');
            // Refresh the page or update the UI accordingly
            location.reload();
        })
        .catch(error => {
            console.error('Error deleting role:', error);
            // Handle error appropriately
        });
    });
});


</script>
@endsection