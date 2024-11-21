@extends('layout.admin')


@section('content')

<section class="middle">
    <div class="d-flex justify-content-end mb-4">
  
        <a href="{{ route('competition_create') }}" id="add-new-competition" class="btn btn-primary  btn-lg">
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
           
            <th id="title-of-competition">Title</th>
            <th id="t">date</th>
            <th id="number-of-competition">Number</th>
            <th id="question">Question</th>
            <th id="answer">Answer</th>
            <th id="Edit">Edit</th>
            <th id="Delete">Delete</th>
            <th id="answers">Answers</th>
            <th id="winers">Winers</th>
           
            
            
          </tr>
        </thead>
        <tbody id="tableBody">
            @foreach ($competitions as $competition)
            <tr>
                <td>
                    <div class="ms-3">{{ $competition->title }}</div>
                </td>
                <td class="date-cell" data-timestamp="{{ $competition->created_at->toIso8601String() }}">
                
                    {{
                    app()->getLocale() == 'fa' ?
                    verta($competition->created_at)->format('Y/m/d') :
                    $competition->created_at->format('Y-m-d')
                    }}
                </td>
                <td>
                    <div class="ms-3">{{ $competition->number }}</div>
                </td>
            
                <td>
                    <div class="description-cell fw-normal mb-1">{{ $competition->description }}</div>
                </td>
            
                <td>
                    <div class="answer-cell fw-normal mb-1">{{ $competition->answer }}</div>
                </td>
            
                <td id="subs">
                    <button type="button" class="btn btn-primary btn-sm  edit-competition"  data-bs-toggle="modal" id="edit-c" data-bs-target="#addNewItemModal"
                        data-competition-id ="{{ $competition->id }}"
                        data-competition-title = "{{$competition->title}}"
                        data-competition-description = "{{$competition->description}}"
                        data-competition-answer = "{{$competition->answer}}"
                        data-competition-number = "{{$competition->number}}"
                    >
                    Edit
                    </button>
                    
                

                </td>
            
                <td id="costt">
                    <button type="button" data-competition-id="{{ $competition->id }}"  class="btn btn-danger delete-competition" data-bs-toggle="modal" id="delete-c" data-bs-target="#exampleModal">
                        Delete
                    </button>
                </td>

                <td >
                    <a href="{{ route('competition_answers',['id'=>$competition->id]) }}" type="button"   class="btn btn-success view">
                        View
                    </a>
                </td>

                
                <td >
                    <a href="{{ route('competition_winers',['id'=>$competition->id]) }}" type="button"   class="btn btn-warning winers1">
                        Winers
                    </a>
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
          <h5 class="modal-title"  id="edit-form-competition">Edit Form Competition</h5>
         
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <!-- Form to add new item -->
               <h2 class="form-title text-center" id="form-competition-edit">Edit Competitions</h2>
                   
                        <form id="edit-competition-form" action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                    
                   
                    <div class="form-group">
                        <input type="text" class="form-control" id="title" placeholder="Title" name="title" required>
                    </div>

                    <div class="form-group">
                        <textarea class="form-control" placeholder="Description"  id="description-of-competition" name="description"></textarea>
                    </div>
              
                   <div class="form-group">
                        <textarea class="form-control" placeholder="Answer" id="description-of-answer" name="answer"></textarea>
                    </div>
                    <div class="form-group">
                        <p class="number_of_competiton" style="font-size: 12px; margin:22px;font-weight:bold"></p>
                        <input type="text" class="form-control" id="numberCompetition" disabled placeholder="Number Competition" name="number" required>
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


<script>
 //******************************************Edit Competition*********************************************

    document.addEventListener('DOMContentLoaded', function() {
        var editButtons = document.querySelectorAll('.edit-competition');
        editButtons.forEach(function(button) {
            button.addEventListener('click', function() {

                var competitionId = this.getAttribute('data-competition-id');
                var competitionTitle = this.getAttribute('data-competition-title');
                var competitionDescription = this.getAttribute('data-competition-description');
                var competitionAnswer = this.getAttribute('data-competition-answer');
                var competitionNumber = this.getAttribute('data-competition-number');
            
            
                document.querySelector('#title').value = competitionTitle;
                document.querySelector('#description-of-competition').value = competitionDescription;
                document.querySelector('#description-of-answer').value = competitionAnswer;
                document.querySelector('#numberCompetition').value = competitionNumber;
            


                // تنظیم فرم برای ویرایش
                var form = document.querySelector('#edit-competition-form');
                form.setAttribute('action', '/admin/competitionUpdate/' + competitionId);
            });
        });
    });


//******************************************Delete competition*********************************************

    document.addEventListener('DOMContentLoaded', function() {
        let   competitionId;

        // Event listener for each delete button
        document.querySelectorAll('.delete-competition').forEach(function(button) {
            button.addEventListener('click', function() {
                competitionId = button.getAttribute('data-competition-id');

            });
        });

        // Event listener for the modal delete button
        document.getElementById('delete-c').addEventListener('click', function() {
            fetch('/admin/competitionDelete/' +  competitionId, {
                method: 'GET'
            })
            .then(response => {
                console.log('competition deleted successfully');
                // Refresh the page or update the UI accordingly
                location.reload();
            })
            .catch(error => {
                console.error('Error deleting competition:', error);
                // Handle error appropriately
            });
        });
    });

</script>

@endsection