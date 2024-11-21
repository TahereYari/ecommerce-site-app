@php
    use App\Models\BasketProduct;
    use App\Models\LicenseRecords;
@endphp

@extends('Front.User.user')

@section('content')

<section class="middle">
    <!-- Main content -->
    <section class="content">
        <div class="container mt-4">
            <div class="row">
                {{-- <div class="col-md-6 col-lg-3">
                    <div class="box" role="region" aria-labelledby="pendingUsers">
                        <div class="text-center my-3 position-relative">
                            <i class='bx bxs-credit-card-alt icon'></i>
                            <h4 class="absolute-icons m-0 text-primary">153</h4>
                        </div>
                        <h3 id="pendingUsers" class="text-center">wallet</h3>
                    </div>
                </div> --}}
                <div class="col-md-6 col-lg-4 ">
                    <div class="box card-color" role="region" aria-labelledby="activeUsers">
                        <div class="text-center my-3 position-relative">
                            <i class='bx bx-basket icon' ></i>
                            <h4 class="absolute-icons m-0 text-primary">{{ $productCount }}</h4>
                        </div>
                        <h3 id="activeUsers" class="text-center">Orders </h3>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="box" role="region" aria-labelledby="dormantUsers">
                        <div class="text-center my-3 position-relative">
                            <i class='bx bxs-credit-card icon'></i>
                            <h4 class="absolute-icons m-0 text-primary">{{ number_format($sumOfPurchase) }}</h4>
                        </div>
                        <h3 id="dormantUsers" class="text-center">Financial</h3>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="box" role="region" aria-labelledby="deletedUsers">
                        <div class="text-center my-3 position-relative">
                            <i class='bx bx-support icon '></i>
                            <h4 class="absolute-icons m-0 text-primary">{{ $ticketCount }}</h4>
                        </div>
                        <h3 id="deletedUsers" class="text-center">Support ticket</h3>
                    </div>
                </div>
            </div>
        </div>                                  
      </section>
    <div class="card small-card m-3" >
        <div class="card-header">
            <ul class="nav nav-tabs nav-justified" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="justified-tab-0" data-bs-toggle="tab" href="#justified-tabpanel-0" role="tab" aria-controls="justified-tabpanel-0" aria-selected="true">List of licensed Products</a>
                </li>
                
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="justified-tab-2" data-bs-toggle="tab" href="#justified-tabpanel-2" role="tab" aria-controls="justified-tabpanel-2" aria-selected="false">Requset PRoducts</a>
                </li>

                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="justified-tab-3" data-bs-toggle="tab" href="#justified-tabpanel-3" role="tab"
                        aria-controls="justified-tabpanel-3" aria-selected="false">Gifts</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content pt-3"  id="tab-content">
                <div class="tab-pane active" id="justified-tabpanel-0" role="tabpanel" aria-labelledby="justified-tab-0">
                    <table class="table" style="text-align: center;" >
                        <tr >
                            <th class="product_name">Product Name</th>
                            <th class="license_key">License Key</th> 
                            <th class="license_type">License type </th>
                            <th class="price">Price</th>
                            <th class="status">Status</th>
                            
                            
                        </tr>
                        @foreach ($purchasedProducts as $licenseRecord)

                                    <tr class="m-r-5">
                                        <td>{{ $licenseRecord->product->name }}</td>
                                        <td id="">{{ $licenseRecord->license_key}}</td>
                                        <td>
                                            <span>{{ $licenseRecord->license->type }}</span>
                                            <span class="month">Month</span>
                                    
                                        </td>
                                        <td>
                                            {{ number_format($licenseRecord->license->cost) }} 
                                            <span class="rial">Rial</span>
                                        </td>
                                    
                                    
                                        <td>
                                            
                                            @php
                                                $licenseCreationDate = $licenseRecord->created_at;
                                                $licenseDurationMonths = $licenseRecord->license->type; // مدت زمان لایسنس به ماه
                                                $expirationDate = $licenseCreationDate->addMonths($licenseDurationMonths);
                                                
                                                $now = now();

                                                if ($now->greaterThan($expirationDate)) {
                                                    $status = 'Invalid'; 
                                                } else {
                                                    $remainingMonths = $now->diffInMonths($expirationDate);
                                                    $remainingDays = $now->copy()->addMonths($remainingMonths)->diffInDays($expirationDate);
                                                    $status = "{$remainingMonths} Months, {$remainingDays} Days left"; // ماه‌ها و روزهای باقی‌مانده
                                                }
                                            @endphp
                                            @if ($status == 'Invalid')
                                                <button type="button" class="btn btn-danger btn-sm btn-round invalid" data-toggle="modal" data-target="#mediumModal">
                                                    {{ $status }}
                                                </button>
                                            @else
                                                <button type="button" id="" class="btn btn-primary btn-sm btn-round" data-toggle="modal" data-target="#mediumModal">
                                                   <span id="">{{ $remainingMonths }}</span>
                                                   <span class="month">Month</span>
                                                   <span id="">{{ $remainingDays }}</span>
                                                   <span class="Days_remaning">Days Remaning</span>
                                                </button>
                                            @endif

                                            {{-- <button type="button" id="" class="btn btn-primary btn-sm btn-round" data-toggle="modal" data-target="#mediumModal">
                                                {{ $status }}
                                            </button> --}}
                                    
                                        </td>
                                    
                                    
                                    
                                    
                                    </tr>
                          
                        @endforeach
                      
                        
                    </table>
                </div>

                <div class="tab-pane" id="justified-tabpanel-3" role="tabpanel" aria-labelledby="justified-tab-3">
                    <table class="table" style="text-align: center;">
                        <tr>
                            <th class="date">Date</th>
                            <th class="competetion_number">Competetion Number</th>
                            <th class="disception">Disception</th>
                            <th class="file">File </th>

                        </tr>
                        @foreach ($gifts as $gift)            
                            <tr class="m-r-5">
                                <td>
                                    <span class="card-subtitle mb-2 text-muted" id=""
                                        data-timestamp="{{ $gift->competetion->created_at->toIso8601String() }}">
                                        {{
                                        app()->getLocale() == 'fa' ?
                                        verta($gift->competetion->created_at)->format('Y/m/d') :
                                      $gift->competetion->created_at->format('Y-m-d')
                                        }}
                                    </span>
                                </td>
                                <td>{{ $gift->competetion->number }}</td>
                                <td class="description-cell">{{ $gift->discreption }}</td>
                               <td><a href="{{ asset('Files/Winers/'.$gift->file) }}" type="button" id=""
                                        class="btn btn-primary  btn-sm btn-round d-f" data-toggle="modal" data-target="#mediumModal"
                                        aria-haspopup="true" aria-controls="mediumModal">
                                        File Download
                                    </a></td>
                            
                            
                            
                            
                            </tr>
                        @endforeach
                   
                
                    </table>
                </div>
                
                <div class="tab-pane" id="justified-tabpanel-2" role="tabpanel" aria-labelledby="justified-tab-2">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                               <th class="date">Date</th>
                               <th class="status">Status</th>
                               <th class="file">File</th>
                            </tr>
                            @foreach ($requesrProducts as $requesrProduct)
                                <tr>
                                
                                    <td>
                                        <span class="card-subtitle mb-2 text-muted" id="" data-timestamp="{{ $requesrProduct->created_at->toIso8601String() }}">
                                            {{
                                            app()->getLocale() == 'fa' ?
                                            verta($requesrProduct->created_at)->format('Y/m/d') :
                                            $requesrProduct->created_at->format('Y-m-d')
                                            }}
                                        </span>
                                    </td>
                                @if ($requesrProduct->status == 'inreview')
                                    <td><button type="button" id="" class="btn btn-warning btn-sm btn-round inreview1" data-toggle="modal"
                                            data-target="#mediumModal" aria-haspopup="true" aria-controls="mediumModal">
                                            Inreview
                                    </button></td>
                                @elseif ($requesrProduct->status == 'unreviewed')
                                    <td><a href="{{ asset('Files/TicketFiles/'.$requesrProduct->file) }}" type="button" id="" class="btn btn-danger btn-sm btn-round unreviewed1" data-toggle="modal" data-target="#mediumModal"
                                            aria-haspopup="true" aria-controls="mediumModal">
                                            Unreviewed
                                     </a></td>
                                @elseif ($requesrProduct->status == 'reviewed')
                                    <td><a href="{{ asset('Files/TicketFiles/'.$requesrProduct->file) }}" type="button" id="" class="btn btn-success btn-sm btn-round reviewed1" data-toggle="modal" data-target="#mediumModal"
                                        aria-haspopup="true" aria-controls="mediumModal">
                                        Reviewed
                                    </a></td>
                                @endif
                                    
                                    <td><a href="{{ asset('Files/TicketFiles/'.$requesrProduct->file) }}" type="button" id="" class="btn btn-primary  btn-sm btn-round d-f" data-toggle="modal"
                                            data-target="#mediumModal" aria-haspopup="true" aria-controls="mediumModal">
                                            File Download
                                        </a></td>
                                </tr>
                            @endforeach
                         
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    {{-- <div class="container-m">
        <div class="row">
          
          <div class="col-md-12">
            <div class="question-card">
              <p class="lead fw-normal mb-1 p-3 text-center" id="t-m">Today's Match</p>
              <p class="lead fw-normal mb-1 m-2" id="w-p">What will be the output of the Python code below?</p>
              <div class="m-3 c-m" dir="ltr" >
                <ul class="list-group list-group-flush">
                  <li class="list-group-item">a=[1,2,3,4,5,6,7,8,9]</li>
                  <li class="list-group-item">a[::2]=10,20,30,40,50,60</li>
                  <li class="list-group-item">print(a)</li>
                </ul>
              </div>
              <div class="center-container">
                <div>
                  <p class="lead fw-normal text-center" id="f-q">Upload the answer to be checked</p>
                  <label class="file-upload m-2">
                    <button id="fileButton" class="file-upload-button btn btn-theme" style="background-color: rgb(71, 7, 234);" aria-label="آپلود فایل">
                      file upload<i class='bx bxs-file-doc' style="color: aliceblue;"></i>
                    </button>
                    <input type="file" id="fileInput" aria-labelledby="fileButton" />
                  </label>
                </div>
              </div>
              
              
            </div>
          </div>
        </div>
    </div> --}}
    
</section>

<canvas id="chart" style="display: none;"></canvas>
<section class="right" dir="rtl">
    {{-- <div class="card-chart" role="region" aria-labelledby="skillLabel">
        <div class="skill">
            <div class="outer">
                <div class="inner">
                    <h4 id="r-s">subscription</h4>
                    <div id="number" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100" role="progressbar">
                        65%
                    </div>
                </div>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="160px" height="160px" aria-hidden="true">
                <defs>
                    <linearGradient id="GradientColor">
                        <stop offset="0%" stop-color="#8384f5" /> 
                        <stop offset="100%" stop-color="#2709e6" />
                    </linearGradient>
                </defs>
                <circle cx="80" cy="80" r="70" stroke-linecap="round" stroke="url(#GradientColor)" fill="none" stroke-width="20"/>
            </svg>
        </div>
    </div>  --}}
    <div class="card-chart mt-5" role="region" aria-labelledby="skillLabel">
        <div class="skill">
            <div class="outer">
                <div class="inner">
                    <h4 id="f-s">  free services</h4>
                    <div id="number"  aria-valuenow="0" aria-valuemin="0" aria-valuemax="{{ round($percentage, 0) }}" role="progressbar">
                        {{ round($percentage, 0) .'%' }}
                    </div>
                </div>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="160px" height="160px" aria-hidden="true">
                <defs>
                    <linearGradient id="GradientColor">
                        <stop offset="0%" stop-color="#8384f5" />
                        <stop offset="100%" stop-color="#2709e6" />
                    </linearGradient>
                </defs>
                {{-- <circle cx="80" cy="80" r="70" style="stroke-dashoffset: calc(472 - ({{ round($percentage, 0) }} / 100) * 472);" stroke-linecap="round" stroke="url(#GradientColor)" fill="none" stroke-width="20"/> --}}
                <circle cx="80" cy="80" r="70" stroke-linecap="round"
                    style="stroke-dashoffset: calc(472 - ({{ round($percentage, 0) }} / 100) * 472);" />
            </svg>
        </div>
    </div>
    <div class="card-chart mt-5" >
        <div style="text-align: center;">
          <i class='bx bx-cart text-primary' style="font-size: 50px; padding: 15px; text-align: center;"></i>
        </div>
        <p style="font-size: 15px;" id="s-s">To place an order, place your request</p>
        <div class="center-container">
            <div>
             <form action="{{ route('request_product') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control" name="name" id="f-l" placeholder="FullName" required>
                </div>
               
                <div class="form-group">
                    <input type="email" class="form-control" name="email" id="n-m" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="tel" id="ph" placeholder="Phone Number" required>
                </div>

                {{-- <div class="form-group">
                    <input type="file" class="form-control"  required>
                </div> --}}

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
                <label class="file-upload m-2">
                    <button id="submit" class="file-upload-button btn btn-theme" style="background-color: rgb(71, 7, 234);" aria-label="آپلود فایل">
                      Place the order<i class='bx bxs-file-doc' style="color: aliceblue;"></i>
                    </button>
                    {{-- <input type="file" id="fileInput-2" aria-labelledby="fileButton-2" /> --}}
                  </label>
            </form> 
             
            </div>
          </div>
    </div>
      
      
    
</section>


<script>
    document.addEventListener('DOMContentLoaded', function() {

        const fileInputElement = document.querySelector('input[id="upload-f-p"]');
        FilePond.registerPlugin(
            FilePondPluginFileValidateType
            );
        filePond  = FilePond.create(fileInputElement);

        filePond.setOptions({
        acceptedFileTypes: ['application/zip', 'application/x-rar-compressed'], 
            maxFileSize: '500MB', 
            instantUpload: false,
            fileValidateTypeLabelExpectedTypesMap: {
                'application/zip': '.zip',
                'application/x-rar-compressed': '.rar',
                
            },
            fileValidateTypeLabelExpectedTypes: 'فقط فایل‌های با فرمت‌های مجاز (rar, zip) پذیرفته می‌شوند.',
            labelFileTypeNotAllowed: 'فرمت فایل معتبر نیست.',
            labelMaxFileSizeExceeded: 'اندازه فایل بیش از حد مجاز است.',
            labelMaxFileSize: 'حداکثر اندازه فایل: {filesize}',
            server: {
            
                process: {
                    url: 'upload-file-endpoint',
                    method: 'POST',
                    withCredentials: false,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    timeout: 10000000, 
                    chunkUploads: true, 
                    chunkSize: 5000000, 
                    onload: (response) => {
                        const jsonResponseFile = JSON.parse(response);
                        if (jsonResponseFile.fileName) {
                        
                            document.getElementById('file_path').value = jsonResponseFile.fileName;
                        } else {
                            console.error('File name not found in response:', jsonResponseFile);
                        }
                    },
                    onerror: (response) => {
                        console.error('Upload error:', response);
                    },
                
                },
                revert: {
                    url: 'delete-filePond-user',
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    // onload: (response) => {
                    //     document.querySelector('#image_path').value = '';
                    // },
                    onerror: (response) => {
                        console.error('Error deleting file:', response);
                    }
                },
                load: (source, load) => {
                    fetch(source).then(response => response.blob()).then(blob => {
                        load(blob);
                    });
                }
            }
        });

        filePond.on('removefile', () => {
            const fileName = document.querySelector('#file_path').value;
            if (fileName) {
                fetch('delete-filePond-user', {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ file_name: fileName,directory: 'Files/TicketFiles/' })
                }).then(response => response.json()).then(data => {
                    if (data.success) {
                        document.querySelector('#file_path').value = '';
                    }
                }).catch(error => {
                    console.error('Error deleting file:', error);
                });
            }
        });
    });
</script>

@endsection