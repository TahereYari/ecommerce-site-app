
       
        @extends('layout.admin')

        @section('content')

        
        <section>
            <div class="header">
                <h1  id="Ov"></h1>
                {{-- <h1  id="Ov">Overview</h1>
                <input type="date"> --}}
            </div>

            <div class="cards">
                <div class="card--admin card-1">
                    <div class="card--data">
                    <div class="card--content"> 
                        <h5 class="card--title" id="usersCount">Users</h5> 
                        <h1>{{ $totalUsers }}</h1>
                    </div> 
                    <i class='bx bx-user card-icon-lg'></i> 
                    </div>
                    {{-- <div class="card-stats">
                        <span><i class='bx bxs-bar-chart-alt-2 card--icon stat--icon'></i>65%</span>
                        <span><i class='bx bx-chevron-up up--arrow'></i>10</span>
                        <span><i class='bx bx-chevron-down down--arrow'></i>2</span>
                    </div> --}}
                </div>
                <div class="card--admin  card-2">
                    <div class="card--data">
                    <div class="card--content">  
                        <h5 class="card--title"  id="vs">Visitors</h5>
                      
                        <h1></h1>
                    </div> 
                    <i class='bx bxs-show card-icon-lg'></i>
                    </div>
                    {{-- <div class="card-stats">
                        <span><i class='bx bxs-bar-chart-alt-2 card--icon stat--icon'></i>82%</span>
                        <span><i class='bx bx-chevron-up up--arrow'></i>230</span>
                        <span><i class='bx bx-chevron-down down--arrow'></i>45</span>
                    </div> --}}
                </div>
                <div class="card--admin card-3">
                    <div class="card--data">
                    <div class="card--content">  
                        <h5 class="card--title"  id="productsCount">Products</h5>
                        <h1>{{ $totalProducts }}</h1>
                    </div> 
                    <i class='bx bx-calendar card-icon-lg'></i> 
                    </div>
                    {{-- <div class="card-stats">
                        <span><i class='bx bxs-bar-chart-alt-2 card--icon stat--icon'></i>27%</span>
                        <span><i class='bx bx-chevron-up up--arrow'></i>31</span>
                        <span><i class='bx bx-chevron-down down--arrow'></i>23</span>
                    </div> --}}
                </div>
            
                
            </div>

            <div class="monthly-report">
                <div class="report">
                    <h3 id="t-r">Total revenue</h3>
                    <div>
                        <details>
                            @if ($total_revenue)
                                <h1>{{ number_format($total_revenue) }}
                                    <span class="rial">Rial</span>
                                </h1>
                               
                            @endif
                            
                            {{-- <h6 class="success">+3.5%</h6> --}}
                        </details>
                        @if ($total_revenue_last_month)
                            <span class="text-muted" id="last_month">Last month's income is :</span>
                            <span>{{ number_format($total_revenue_last_month) }}</span>
                            <span class="rial">Rial</span>
                        @endif
                        
                    </div>
                </div>

                {{-- <div class="report">
                    <h3 id="m-kh">Expenses</h3>
                    <div>
                        <details>
                            <h1>$9,005</h1>
                            <h6 class="danger">-6.5%</h6>
                        </details>
                        <p class="text-muted" id="t-m1">Last months expenses $250</p>
                    </div>
                </div> --}}
{{-- 
                <div class="report">
                    <h3 id="cb">Cash back</h3>
                    <div>
                        <details>
                            <h1>$9,004</h1>
                            <h6 class="success">+7.1%</h6>
                        </details>
                        <p class="text-muted" id="r-l">Refund of $500 last month</p>
                    </div>
                </div> --}}

                {{-- <div class="report">
                    <h3 id="s-f">Subscription fee</h3>
                    <div>
                        <details>
                            <h1>$118,224</h1>
                            <h6 class="danger">-17.8%</h6>
                        </details>
                        <p class="text-muted" id="t-s">This month's subscriptions are $2000</p>
                    </div>
                </div> --}}
            </div>

            

            <canvas id="chart"></canvas>
            <div class="card small-card m-3">
                <div class="card-header">
                    <ul class="nav nav-tabs nav-justified" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="justified-tab-0" data-bs-toggle="tab" href="#justified-tabpanel-0" role="tab" aria-controls="justified-tabpanel-0" aria-selected="true">Open Tickets</a>
                            @if ($openTicketsCount >0)
                             <span class="badge badge-success">{{ $openTicketsCount }}</span>
                            @endif
                            
                        </li>
                       
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" style="font-size: 15px;" id="justified-tab-1" data-bs-toggle="tab" href="#justified-tabpanel-1" role="tab" aria-controls="justified-tabpanel-1" aria-selected="false">Messages </a>
                           @if ($unreadMessageCount >0)
                           <span class="badge badge-success" id="unread-count">{{ $unreadMessageCount }}</span>
                           @endif
                           
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="justified-tab-2" data-bs-toggle="tab" href="#justified-tabpanel-2" role="tab" aria-controls="justified-tabpanel-2" aria-selected="false">The answer to the competition</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content pt-3"  id="tab-content">
                        <div class="tab-pane active" id="justified-tabpanel-0" role="tabpanel" aria-labelledby="justified-tab-0">
                            <table class="table" style="text-align: center;" >
                                <tr>
                                    <th class="userName">User Name</th>
                                    <th class="userEmail">Email</th>
                                    <th class="Status">Status</th>
                                    <th class="View">View</th>
                                </tr>
                                <tr class="m-r-5">
                                    @foreach($openTickets as $openTicket)
                       
                                    <tr>
                                        <td>{{ $openTicket->user()->name }}</td>
                                        <td>{{ $openTicket->user()->email }}</td>
                                       
                                        @php
                                         $unReadCount = $openTicket->Messages()->where('read','0')->count();
             
                                        @endphp
                                        @if ($unReadCount>0)
                                        <td>
                                            <span class="badge badge-success newMessage">New Message</span>
                                           
                                        </td>
                                        @else
                                        <td>
                                            <span class="badge badge-success "></span>
                                           
                                        </td>
                                        @endif
                                        <td>
                                          
                                            <a href="{{ route('ticket_messages',['id'=>$openTicket->id]) }}" class="view">View</a>
                                        </td>
                                    </tr>
                               
                                @endforeach
                                </tr>
                                
                                
                            </table>
                        </div>
                        <div class="tab-pane" id="justified-tabpanel-1" role="tabpanel" aria-labelledby="justified-tab-1">
                        
                            
                            <table class="table" style="text-align: center;"  >
                                <tr >
                                    {{-- <th id="ph">photos </th> --}}
                                    <th id="user-name">User Name</th> 
                                    <th id="email">Email</th>
                                    <th id="message">Message</th>
                                    <th id="status">Status</th>
                                  
                                </tr>
                                @foreach($messages as $message)
                                <tr class="m-r-5">
                                    {{-- <td><img src="images/profile-1.jpg" alt="prod img" class="img-fluid img-p"></td> --}}
                                    <td>{{ $message->name }}</td>
                                    <td>{{ $message->email }}</td>
                                    <td class="message-cell" data-message-id="{{ $message->id }}" data-is-read="{{ $message->read ? 'true' : 'false' }}">
                                        {{ $message->comment }}</td>                     
                                   
                                    <td>
                                        @if($message->read == 0)
                                            <span class="badge badge-success read" >Unread</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            
                                
                                
                            </table>
                            <a href="{{ route('message_list') }}" type="button" class="btn btn-primary btn-lg btn-round" id="viewAll">
                                View All
                             </a>
                        </div>
                        <div class="tab-pane" id="justified-tabpanel-2" role="tabpanel" aria-labelledby="justified-tab-2">
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        {{-- <th id="id-u">id</th> --}}
                                        <th id="n-k"> name</th>
                                        <th id="id-m">Competition Number</th>
                                        <th id="j">answer</th>
                                        <th id="t">date</th>
                                    </tr>
                                    @foreach ( $competionAnswers as $competionAnswer)
                                    <tr>
                                        {{-- <td></td> --}}
                                        <td> {{ $competionAnswer->user->name }}</td>
                                        <td>{{ $competionAnswer->competiotion->number }}</td>
                                        
                                        <td><button type="button" id="" class="btn btn-primary btn-sm btn-round s-a" 
                                            data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                                            data-name="{{ $competionAnswer->user->name }}"
                                            data-competition="{{ $competionAnswer->competiotion->number}}"
                                            data-answer="{{ $competionAnswer->answer }}" 
                                            data-file-url="{{ asset('Files/CompetetionAnswers/' . $competionAnswer->file) }}" >
                                            show answer
                                        </button></td>
                                        
                                         {{-- <td>{{ $competionAnswer->created_at }}</td> --}}
                                         <td class="date-cell" data-timestamp="{{ $competionAnswer->created_at->toIso8601String() }}">
                                      
                                             {{
                                                 app()->getLocale() == 'fa' ? 
                                                 verta($competionAnswer->created_at)->format('Y/m/d') : 
                                                  $competionAnswer->created_at->format('Y-m-d')
                                            }}
                                        </td>
                                    </tr>
                                    @endforeach
                                 
                                    
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            
        </section>


        <section class="right">
            
            <div class="recent-transactions">
                <div class="header ">
                    <h2 id="r-a">Recent activities</h2>
                    <a href="#">more <span class="material-icons-sharp">chevron_right</span></a>
                </div>
                
                <div class="transaction">
                    <div class="service">
                        
                        <div class="card-details">
                            <div class="card bg-primary">
                                <i class='bx bxs-bell-ring icon'></i>
                            </div>

                            <div class="details">
                                @if ($lastNewUserNotification)
                                    @php
                                        $data = json_decode($lastNewUserNotification->data, true);
                                    @endphp
                                    @if (is_array($data) && array_key_exists('name', $data)) 
                                    {{ $data['name']}}  <p id="a-u"> joined the website</p>
                                        
                                    @else
                                        <p id="a-u">Invalid notification data</p>
                                    @endif

                                    @else
                                    <p id="a-u">No notifications found</p>
                                @endif
                              
                            </div>
                            

                           
                        </div>
                    </div>
                </div>  
                <div class="transaction">
                    <div class="service">
                        
                        <div class="card-details">
                            <div class="card bg-primary">
                                <i class='bx bxs-bell-ring icon'></i>
                            </div>
                            <div class="details">
                              <p id="a-p">A user purchased a subscription</p>
                              
                            </div>
                            
                        </div>
                        
                        
                        
                    </div>
                </div> 
                <div class="transaction">
                    <div class="service">
                        
                        <div class="card-details">
                            <div class="card bg-primary">
                                <i class='bx bxs-bell-ring icon'></i>
                            </div>
                            <div class="details">
                                @if ($lastDeleteUserNotification)
                                    @php
                                        $data = json_decode($lastDeleteUserNotification->data, true);
                                    @endphp
                                    @if (is_array($data) && array_key_exists('name', $data)) 
                                    {{ $data['name']}}  <p id="a-l">  left the site</p>
                                        
                                    @else
                                        <p id="a-l">Invalid notification data</p>
                                    @endif

                                    @else
                                    <p id="a-l">No notifications found</p>
                                @endif
                              
                            </div>
                            
                            
                            
                        </div>
                    </div>
                </div> 
                <div class="transaction">
                    <div class="service">
                        
                        <div class="card-details">
                            <div class="card bg-primary">
                                <i class='bx bxs-bell-ring icon'></i>
                            </div>
                            <div class="details">
                              <p id="a-a">A user asked for quick advice</p>
                            
                            </div>
                           
                        </div>
                    </div>
                </div> 
                <div class="transaction">
                    <div class="service">
                        
                        <div class="card-details">
                            <div class="card bg-primary">
                                <i class='bx bxs-bell-ring icon'></i>
                            </div>
                            <div class="details">
                              <p id="a-c">A user participated in todays contest</p>
                            
                            </div>
                            
                        </div>
                    </div>
                </div> 
                
            </div>
            <div class="investments">
                <div class="header">
                    <h2 id="a-w">Analysis of users use of the website</h2>          
                </div>
                <hr>
                <div class="card-analiz">
                    <div class="stat">  
                        <label for="" class="stat label" id="p-u" >Purchased by users</label>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                           
                        </div>
                        25%
                    </div>  
                    <div class="stat">  
                        <label for="" class="stat label" id="u-r">Registered users</label>
                        <div class="progress">
                            {{-- {{ round($registered_users_percentage, 0) }}% --}}
                            <div class="progress-bar" role="progressbar" style="width: {{ round($registered_users_percentage, 0) }}%" aria-valuenow=" {{ round($registered_users_percentage, 0) }}%" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        {{ round($registered_users_percentage, 0) }}%
                    </div>
                    <div class="stat">  
                        <label for="" class="stat label" id="d-u">Deleted users </label>
                        <div class="progress">
                            
                            <div class="progress-bar" role="progressbar" style="width:   {{ round($deleted_users_percentage, 0) }}%" aria-valuenow="  {{ round($deleted_users_percentage, 0) }}%" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        {{ round($deleted_users_percentage, 0) }}%
                    </div>
                    <div class="stat">  
                        <label for="" class="stat label" id="u-t">User usage time</label>
                        <div class="progress">
                            
                            <div class="progress-bar " role="progressbar" style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        85%
                    </div>
                </div>
                
                
            </div>  

  

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
                        <h3 id="d-q">Download the file to check the answer to the question</h3> 
                        <br>
                        <a class="btn btn-theme d-f" id="d-d" href="path/to/question.pdf" download aria-label="دانلود فایل PDF">
                            file download
                        </a>
                    </div>
                    
                </div>
            </div>
        </div>
  
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header" dir="ltr">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit product</h1>
                <button type="button"  class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
                <h2 class="form-title text-center" id="p-count">Form productsCount</h2>
                <form action="">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Name productsCount" id="n-m" required>
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" id="p-price"  placeholder="Price productsCount" required>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" placeholder="Description" id="des"></textarea>
                    </div>
                    
                    <div class="form-group ">
                        
                        <select id="inputState" class="form-control" required>
                            <option selected id="category">Category</option>
                            <option>...</option>
                            <option>....</option>
                            <option>.....</option>
                            <option>......</option>
                        </select>
                    </div> 
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                        <label class="form-check-label" for="flexSwitchCheckDefault" id="isfree">Free</label>
                        </div>  
                    <div class="form-group">
                        
                        <input type="file" class="form-control-file form-control" id="upload" aria-describedby="fileDescription">
                        
                    </div>       
                    <button type="submit" id="submit" class="btn btn-theme btn-block btn-form">Submit </button>
                    
                </form>
            </div>

            </div>
            </div>
        </div>
       <div id="number"></div>

 @endsection

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
    
            modalFileDownload.href = fileUrl;
            // modalTitle.textContent =   competitionNumber;

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


    
    document.addEventListener("DOMContentLoaded", function() {
        const descriptionCells = document.querySelectorAll('.message-cell');

        descriptionCells.forEach(cell => {
            cell.addEventListener('click', function() {
                cell.classList.toggle('expanded');

                const messageId = cell.getAttribute('data-message-id');
                const isRead = cell.getAttribute('data-is-read'); // گرفتن وضعیت خوانده شده

                // فقط در صورتی که پیام خوانده نشده باشد، درخواست AJAX ارسال شود
                if (isRead === 'false') {
                    // ارسال درخواست AJAX برای به‌روزرسانی وضعیت read
                    fetch(`/admin/message/read/${messageId}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ read: true })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            console.log('Message marked as read');
                            
                            // پیدا کردن برچسب 'New' و حذف آن
                            const badge = cell.parentElement.querySelector('.badge-success');
                            if (badge) {
                                badge.remove();
                            }
                            cell.setAttribute('data-is-read', 'true');
                            const unreadCountElement = document.getElementById('unread-count');
                            let unreadCount = parseInt(unreadCountElement.textContent, 10);
                            unreadCount = unreadCount > 0 ? unreadCount - 1 : 0;
                            unreadCountElement.textContent = unreadCount;
                            

                            if (unreadCount === 0) {
                                unreadCountElement.style.display = 'none'; // مخفی کردن عنصر
                            } else {
                                unreadCountElement.textContent = unreadCount;
                            }


                        } else {
                            console.error('Error marking message as read');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
                }
            });
        });
    });






</script>


