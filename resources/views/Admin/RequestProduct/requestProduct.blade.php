@extends('layout.admin')


@section('content')

<section class="middle">
    <div class="d-flex justify-content-end mb-4">
  
     

  
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
  
    {{-- <table class="table align-middle mb-0 bg-white"  id="example">
        <thead class="bg-light">
          <tr>
       
            <th class="userName">User Name</th>
            <th class="userEmail">Email</th>
            <th class="phone">Phone Number</th>
            <th class="file">File</th>
           
            
            
          </tr>
        </thead>
        <tbody id="tableBody">
            @foreach ($requestProducts as $requestProduct)
            <tr>

               
                <td>
                    <div class="ms-3">{{ $requestProduct->name }}</div>
                </td>
        
              
                <td>
                    <div class="ms-3">{{ $requestProduct->email }}</div>
                </td>
        
              
                <td>
                    <div class="ms-3">{{ $requestProduct->tel }}</div>
                </td>
        
              
            
                <td>
                    <a class="btn btn-theme d-f" class="d-d" href="{{ asset('Files/TicketFiles/'.$requestProduct->file) }}" download aria-label="دانلود فایل">
                        file download
                    </a>
                </td>
        
              
            
                
              
                
            </tr>

  
            @endforeach
       
          
          
        </tbody>
    </table> --}}
    
   
    <div class="container mt-5">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" id="requestTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active unreviewed1" id="unreviewed-tab" data-bs-toggle="tab" data-bs-target="#unreviewed" type="button" role="tab" aria-controls="unreviewed" aria-selected="true">بررسی نشده</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link inreview1" id="inreview-tab" data-bs-toggle="tab" data-bs-target="#inreview" type="button" role="tab" aria-controls="inreview" aria-selected="false">در حال بررسی</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link reviewed1" id="reviewed-tab" data-bs-toggle="tab" data-bs-target="#reviewed" type="button" role="tab" aria-controls="reviewed" aria-selected="false">بررسی شده</button>
            </li>
        </ul>
    
        <!-- Tab panes -->
        <div class="tab-content" id="requestTabContent">
            <!-- Unreviewed Tab -->
            <div class="tab-pane fade show active" id="unreviewed" role="tabpanel" aria-labelledby="unreviewed-tab">
                 <table class="table align-middle mb-0 bg-white example" id="">
                    <thead class="bg-light">
                        <tr>
                            <th class="date">Date</th>
                            <th class="userName">User Name</th>
                            <th class="userEmail">Email</th>
                            <th class="phone">Phone Number</th>
                            <th class="file">File</th>
                            <th class="status">Status</th>
                           
                        </tr>
                    </thead>
                    <tbody id="unreviewedBody">
                        @foreach ($requestProducts->where('status', 'unreviewed') as $requestProduct)
                        <tr>
                            <td>
                                <span class="card-subtitle mb-2 text-muted" id=""
                                    data-timestamp="{{ $requestProduct->created_at->toIso8601String() }}">
                                    {{
                                    app()->getLocale() == 'fa' ?
                                    verta($requestProduct->created_at)->format('Y/m/d') :
                                    $requestProduct->created_at->format('Y-m-d')
                                    }}
                                </span>
                            </td>
                            <td>{{ $requestProduct->name }}</td>
                            <td>{{ $requestProduct->email }}</td>
                            <td>{{ $requestProduct->tel }}</td>
                            <td>
                                <a class="btn btn-theme d-f" id="d-d" href="{{ asset('Files/TicketFiles/'.$requestProduct->file) }}" download aria-label="دانلود فایل">
                                    file download
                                </a>
                            </td>
                            <td>
                                <a class="btn btn-danger btn-sm unreviewed1" href="{{ route('update-status-request',['id'=>$requestProduct->id, 'status'=>'inreview']) }}">
                                    Unreviewed
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
    
            <!-- In Review Tab -->
            <div class="tab-pane fade" id="inreview" role="tabpanel" aria-labelledby="inreview-tab">
                <table class="table align-middle mb-0 bg-white example" id="">
                    <thead class="bg-light">
                        <tr>
                            <th class="date">Date</th>
                            <th class="userName">User Name</th>
                            <th class="userEmail">Email</th>
                            <th class="phone">Phone Number</th>
                            <th class="file">File</th>
                            <th class="status">Status</th>
                        </tr>
                    </thead>
                    <tbody id="inreviewBody">
                        @foreach ($requestProducts->where('status', 'inreview') as $requestProduct)
                        <tr>
                            <td>
                                <span class="card-subtitle mb-2 text-muted" id=""
                                    data-timestamp="{{ $requestProduct->created_at->toIso8601String() }}">
                                    {{
                                    app()->getLocale() == 'fa' ?
                                    verta($requestProduct->created_at)->format('Y/m/d') :
                                    $requestProduct->created_at->format('Y-m-d')
                                    }}
                                </span>
                            </td>
                            <td>{{ $requestProduct->name }}</td>
                            <td>{{ $requestProduct->email }}</td>
                            <td>{{ $requestProduct->tel }}</td>
                            <td>
                                <a class="btn btn-theme d-f" id="d-d" href="{{ asset('Files/TicketFiles/'.$requestProduct->file) }}" download aria-label="دانلود فایل">
                                    file download
                                </a>
                            </td>

                            <td>
                                <a class="btn btn-warning btn-sm inreview1" href="{{ route('update-status-request',['id'=>$requestProduct->id, 'status'=>'reviewed'])}}" >
                                    Inreview
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
    
            <!-- Reviewed Tab -->
            <div class="tab-pane fade" id="reviewed" role="tabpanel" aria-labelledby="reviewed-tab">
                 <table class="table align-middle mb-0 bg-white example" id="">
                    <thead class="bg-light">
                        <tr>
                            <th class="date">Date</th>
                            <th class="userName">User Name</th>
                            <th class="userEmail">Email</th>
                            <th class="phone">Phone Number</th>
                            <th class="file">File</th>
                            <th class="status">Status</th>
                            
                        </tr>
                    </thead>
                    <tbody id="reviewedBody">
                        @foreach ($requestProducts->where('status', 'reviewed') as $requestProduct)
                        <tr>
                            <td>
                                <span class="card-subtitle mb-2 text-muted" id=""
                                    data-timestamp="{{ $requestProduct->created_at->toIso8601String() }}">
                                    {{
                                    app()->getLocale() == 'fa' ?
                                    verta($requestProduct->created_at)->format('Y/m/d') :
                                    $requestProduct->created_at->format('Y-m-d')
                                    }}
                                </span>
                            </td>
                            <td>{{ $requestProduct->name }}</td>
                            <td>{{ $requestProduct->email }}</td>
                            <td>{{ $requestProduct->tel }}</td>
                            <td>
                             <a class="btn btn-theme d-f" id="d-d" href="{{ asset('Files/TicketFiles/'.$requestProduct->file) }}" download aria-label="دانلود فایل">
                                    File Download
                                </a>
                            </td>
                            <td>
                                <a style="color: green" class="reviewed1">
                                    Reviewed
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
   
  </section>




@endsection