@extends('Front.User.user')

@section('content')

<section class="middle">

  <div class="container p-3">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      {{-- <div class="container-fluid">
       
         <a class="navbar-brand" href="" id="submit-t">Submit ticket</a>
      
      </div> --}}
    </nav>
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
            
             
            
            </div>
            
            
        </div>
     </div>
</section>





@endsection