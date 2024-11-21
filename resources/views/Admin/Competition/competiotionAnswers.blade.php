@extends('layout.admin')


@section('content')

<section class="middle">
    <div class="d-flex justify-content-end mb-4">
  

  
    </div>

  
    <table class="table align-middle mb-0 bg-white"  id="example">
        <thead class="bg-light">
          <tr>

                <th id="n-k"> name</th>
                <th id="id-m">Competition Number</th>
                <th id="j">answer</th>
                <th id="t">date</th>

            
          </tr>
        </thead>
        <tbody id="tableBody">
            @foreach ( $competeionAnswers as $competionAnswer)
            <tr>
                {{-- <td></td> --}}
                <td> {{ $competionAnswer->user->name }}</td>
                <td>{{ $competionAnswer->competiotion->number }}</td>
                
                <td><button type="button" id="" class="btn btn-primary btn-sm btn-round s-a" 
                    data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                    data-name="{{ $competionAnswer->user->name }}"
                    data-competition="{{ $competionAnswer->competiotion->number}}"
                    data-answer="{{ $competionAnswer->answer }}" 
                    {{-- data-file-url="{{ asset('Files/CompetetionAnswers/' . $competionAnswer->file) }}" --}}
                    data-file-url="{{ $competionAnswer->file }}"
                     >
                    show answer
                </button></td>
                
                 {{-- <td>{{ $competionAnswer->created_at }}</td> --}}
                 <td class="date-cell" data-timestamp="{{ $competionAnswer->competiotion->created_at->toIso8601String() }}">
              
                     {{
                         app()->getLocale() == 'fa' ? 
                         verta($competionAnswer->competiotion->created_at)->format('Y/m/d') : 
                          $competionAnswer->competiotion->created_at->format('Y-m-d')
                    }}
                </td>
            </tr>
            @endforeach
         
       
          
          
        </tbody>
      </table>
    
    {{-- <canvas id="chart" style="display: none;"></canvas> --}}
   
  </section>


 
 <!-- Modal -->
 <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" dir="ltr">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">The answer to the competition</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
                <h3 id="n-u"></h3><hr />
                <p id="a-answer" style="display: none;"></p><hr id="hr-answer" style="display: none;" />
                <div id="file-answer" style="display: none;">
                    <h3 id="d-q" >Download the file to check the answer to the question</h3> 
                <br>
                <a class="btn btn-theme"  id="d-d" href="" download aria-label="دانلود فایل PDF">
                    file download
                </a>
                </div>
            </div>
            
        </div>
    </div>
</div>


<script>
      document.addEventListener('DOMContentLoaded', function () {
        var staticBackdrop = document.getElementById('staticBackdrop');
        
        staticBackdrop.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var userName = button.getAttribute('data-name');
            var competitionNumber = button.getAttribute('data-competition');
            var answer = button.getAttribute('data-answer');
            var fileUrl = button.getAttribute('data-file-url');
          
            // آپدیت کردن محتوای مدال با استفاده از داده‌های دریافت شده
            var modalUserName = staticBackdrop.querySelector('#n-u');
            var modalAnswer = staticBackdrop.querySelector('#a-answer');
            var modalHrAnswer = staticBackdrop.querySelector('#hr-answer');
            var modalFileDownload = staticBackdrop.querySelector('#d-d');
            // var modalTitle = staticBackdrop.querySelector('#staticBackdropLabel');

            modalUserName.textContent = userName;
            
            if (fileUrl && fileUrl !== 'null') {

                modalFileDownload.href =baseUrl + 'Files/CompetetionAnswers/'+ fileUrl;
                staticBackdrop.querySelector('#file-answer').style.display = 'block';
            }
            else{
                 staticBackdrop.querySelector('#file-answer').style.display = 'none';
            }
 
            if (answer && answer !== 'null') {
                modalAnswer.textContent = answer; // قرار دادن پاسخ در المنت
                modalAnswer.style.display = 'block'; // نمایش المنت
                modalHrAnswer.style.display = 'block'; // نمایش المنت
            } else {
                modalAnswer.style.display = 'none'; // مخفی نگه داشتن المنت اگر پاسخی وجود نداشت
                modalHrAnswer.style.display = 'none'; // مخفی نگه داشتن المنت اگر پاسخی وجود نداشت
            }
        });
    });
</script>

@endsection