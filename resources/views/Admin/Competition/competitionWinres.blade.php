@extends('layout.admin')


@section('content')

<section class="middle">
    <br>
    <div class="alert alert-primary" >
       <span id="pageWinner">The list of winners of the contest number:</span> 
       <span>{{ $competeion->number }}</span>
    </div>
    <div class="d-flex justify-content-end mb-4">

        <a href="{{ route('competition_create') }}" id="add-new-winer" class="btn btn-primary  btn-lg" 
        data-bs-toggle="modal" data-bs-target="#addNewItemModalWiner" >
             Add New Winner
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

                <th id="UserName">User Name</th>
                <th id="Email">Email</th>
                <th id="NumberQuestion">Number Question</th>
                <th id="Discrption">Discrption</th>
                <th id="File">File</th>
           



            </tr>
        </thead>
        <tbody id="tableBody">
            @foreach ($competeionWinners as $competeionWinner)
            <tr>
                <td>
                    <div class="ms-3">{{ $competeionWinner->user->name }}</div>
                </td>

                <td>
                    <div class="ms-3">{{ $competeionWinner->user->email }}</div>
                </td>
                <td>
                    <div class="ms-3">{{ $competeion->number }}</div>
                </td>

                <td>
                    <div class="description-cell fw-normal mb-1">{{ $competeionWinner->discreption }}</div>
                </td>
                <td>
                    <a href="{{ asset('Files/Winers/'.$competeionWinner->file) }}" type="button" id=""
                        class="btn btn-success btn-sm btn-round d-f" data-toggle="modal" data-target="#mediumModal"
                        aria-haspopup="true" aria-controls="mediumModal">
                        File Download
                    </a>
                </td>

     



            </tr>
            @endforeach

        </tbody>
    </table>

    {{-- <canvas id="chart" style="display: none;"></canvas> --}}

</section>

<!-- Modal -->
<div class="modal fade" id="addNewItemModalWiner" tabindex="-1" aria-labelledby="addNewItemModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add-form-winner"> Add Winner Form  </h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form to add new item -->
                <h2 class="form-title text-center" id="form-winner">Form Winner</h2>

                <form id="edit-competition-form" action="{{ route('competition_winers_insert') }}" method="POST" enctype="multipart/form-data">
                    @csrf


                    <div class="form-group">
                    
                            <div class="alert alert-secondary" role="alert">
                                <span id="numberCompetition">Number Competition : </span>
                                <span>{{ $competeion->number }}</span>
                            </div>
                    </div>
                    <div class="form-group">
                      <textarea class="form-control" id="giftDiscription" placeholder="Gift Discription" name="discription" required></textarea>
                    </div>

                    <div class="form-group ">
                        <select id="inputState" class="form-control"  name="user_id">
                            <option selected id="user_email" disabled >User Email</option>
                            @foreach ($competeionAnswers as $competeionAnswer)
                          
                            <option value="{{ $competeionAnswer->user->id }}" >{{ $competeionAnswer->user->email }}</option>
                            @endforeach
                        </select>
                      
                    </div>

                    <div class="form-group mt-5">
                        <label for="formFileMultiple" id="upload-file" class="form-label lab">Upload File </label>
                        <input type="file" class="filepond" id="upload-f-p" name="file" multiple
                            aria-describedby="fileDescriptionSize,fileDescriptionformat" required data-allow-reorder="true"
                            data-max-file-size="500MB" />
                    
                        <small id="fileDescriptionSize" class="form-text text-muted hidden text-muted-u"
                            style="color: rgb(249 3 3) !important">The maximum file size is 500 MB.</small>
                        <br>
                        <small id="fileDescriptionformat" class="form-text text-muted hidden text-muted-u"
                            style="color: rgb(249 3 3) !important">
                            Only files with permitted formats (rer, zip) are accepted.</small>
                        <input type="hidden" name="file_name" id="file_path">
                    </div>
                   <input type="hidden" class="form-control" id="" value="{{$competeion->id  }}"  name="compet_id" >
                    <button type="submit" id="submit" class="btn btn-block btn-theme btn-form">Submit</button>

                </form>





            </div>
        </div>
    </div>
</div>



<script>

//******************************************FilePond*********************************************

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
                        url: 'upload-file-compitetion',
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
                        url: 'delete-filePond-compitetion',
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
                    fetch('delete-filePond-compitetion', {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({ file_name: fileName,directory: 'Files/Winers/' })
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