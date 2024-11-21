@extends('Front.User.user')

@section('content')

<section class="middle">

  <div class="container p-3">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
       
         <a class="navbar-brand" href="" id="submit-t">Submit ticket</a>
      
      </div>
    </nav>
  </div>
  @if ($openTicket)
    <div class="container p-3">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
          <a class="navbar-brand" href="{{ route('close_ticket',['id' =>$openTicket->id]) }}" id="ticket-close">Close Ticket</a>
        </div>
      </nav>
    </div>
  @endif
  
      
      <div class="card card-u p-3">
        {{-- <input type="text" class="form-control" id="ticket-title" placeholder="Ticket title..."> --}}
        <form method="POST" enctype="multipart/form-data" action="{{ route('insert_ticket') }}">
          @csrf
            <textarea class="form-control" id="ticket-text" placeholder="Ticket text:" name="message"></textarea>
          
            <div class="container-fluid">
              <a class="navbar-brand" href="#" id="appendices">Appendices</a>
            </div>

          <input class="form-control" type="file" id="formFileMultiple" multiple name="file"/>
          <div id="file-input-container"></div>


      

          <button type="submit" id="submit" class="btn btn-block btn-theme btn-form">Submit</button>

     
        </form>
      
      </div>
     
      <div class="card card-u p-3">
        <div class="card-row">
      
            <div class="card " >
         
              <hr>
              @if ($tickettMessages != null)
                @foreach ($tickettMessages as $tickettMessage)
                <div class="card-body">
                  <h5 class="card-title">{{ $tickettMessage->user()->name }}</h5>
                  <h6 class="card-subtitle mb-2 text-muted" id="">{{ $tickettMessage->message }}</h6>
                <br>
                  <h6 class="card-subtitle mb-2 text-muted" id="" 
                  data-timestamp="{{ $tickettMessage->created_at->toIso8601String() }}"
                  >
                    {{
                          app()->getLocale() == 'fa' ? 
                          verta($tickettMessage->created_at)->format('Y/m/d') : 
                          $tickettMessage->created_at->format('Y-m-d')
                      }}
                  </h6>
               
                </div>
                <hr>
                @endforeach

                @else
                <div class="card-body">
                  <h2 id="No-messages">There is no open ticket</h2>
              
                </div>
                <hr>
              @endif
            
             
              {{-- <div class="card-body">
                <h5 class="card-title">#3059931</h5>
                <h6 class="card-subtitle mb-2 text-muted" id="server">Server support for files...</h6>
                <h6 class="card-subtitle mb-2 text-muted" id="closed-1">4 months ago - closed</h6>
                
              </div>
              <hr>
              
              <div class="card-body">
                <h5 class="card-title">#898815</h5>
                <h6 class="card-subtitle mb-2 text-muted" id="database">Failure to identify the database</h6>
                <h6 class="card-subtitle mb-2 text-muted" id="closed-2">9 months ago - closed</h6>
                
               
              </div> --}}
            </div>
            
            
        </div>
     </div>
</section>



<section class="right" >
    <div class="container p-3">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <div class="container-fluid">
            <a class="navbar-brand" href="" id="tickets">Your recent tickets</a>
          </div>
        </nav>
      </div>
       @if ($tickets)
       
        <div class="card-row">
            
              <div class="card " >
              
                <hr>
            
                  @foreach ($tickets as $ticket)
                  <div class="card-body">
                    <h5 class="card-title">#{{ $ticket->id }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted message-cell" id="">
                      <a href="{{ route('ticket_view',['id'=>$ticket->id]) }}">
                        {{
                          $ticket->Messages()->where('user_id', auth()->user()->id)->first()->message ?? 'No message found'
                      }}
                      </a>
                    
                    </h6>
                    <br>
                        <h6 class="card-subtitle mb-2 text-muted" id="" 
                          data-timestamp="{{ $ticket->created_at->toIso8601String() }}"
                        >
                          {{
                                app()->getLocale() == 'fa' ? 
                                verta($ticket->created_at)->format('Y/m/d') : 
                                $ticket->created_at->format('Y-m-d')
                            }}
                        </h6>
                    
                    
                  </div>
                  <hr>
                  @endforeach
              
          
                  {{-- <a href="{{ route('all_tickets') }}" id="all_ticketView" class="btn btn-primary">Submit</a> --}}

              </div>
              
              
        </div>

       @endif 
      
    
</section>


<script>
  // const addFileBtn = document.getElementById('add-file-btn');
  // const fileInputContainer = document.getElementById('file-input-container');

  // addFileBtn.addEventListener('click', () => {
  //   const newFileInput = document.createElement('input');
  //   newFileInput.type = 'file';
  //   newFileInput.className = 'form-control';
  //   fileInputContainer.appendChild(newFileInput);
  // });




</script>
@endsection