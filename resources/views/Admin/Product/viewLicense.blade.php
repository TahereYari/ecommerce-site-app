@extends('layout.admin')

@section('content')

<section class="middle">
  <div class="d-flex justify-content-end mb-4">

 
    {{-- &nbsp;&nbsp;&nbsp;&nbsp; --}}
      {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" id="search" data-bs-target="#staticBackdrop">
         Search
      </button> --}}

  </div>
  {{-- @if ($errors->any())
  <div class="alert alert-danger">
      <ul>
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
      </ul>
  </div>
 @endif --}}

  <table class="table align-middle mb-0 bg-white"  id="example">
      <thead class="bg-light">
        <tr>
         
          <th id="licenseType">Type of Subscription </th>
          <th id="price">Price of Subscription</th>
          <th id="Delete">Delete</th>
         
          
          
        </tr>
      </thead>
      <tbody id="tableBody">
      @foreach ($licenses as $license)
      <tr>
        <td>
          <div class="ms-3">{{  $license->type }}</div>
        </td>

        <td>
           <div class="ms-3">{{  number_format($license->cost) }}</div>
        </td>
   
      <td id="costt">
        <button type="button" data-license-id="{{ $license->id }}"  class="btn btn-danger delete-license" data-bs-toggle="modal" id="delete-r" data-bs-target="#exampleModal">
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
  
  


<script>
    //******************************************Delete license*********************************************

document.addEventListener('DOMContentLoaded', function() {
 let licenseId;

    // Event listener for each delete button
    document.querySelectorAll('.delete-license').forEach(function(button) {
        button.addEventListener('click', function() {
            licenseId = button.getAttribute('data-license-id');
           
        });
    });
   
    // Event listener for the modal delete button
    document.getElementById('delete-p').addEventListener('click', function() {
        fetch('/admin/licenseDelete/' + licenseId, {
            method: 'GET'
        })
        .then(response => {
            console.log('license deleted successfully');
            // Refresh the page or update the UI accordingly
            location.reload();
        })
        .catch(error => {
            console.error('Error deleting license:', error);
            // Handle error appropriately
        });
    });
});
</script>

@endsection

