@extends('layout.admin')


@section('content')

<section class="middle">

        <!-- Tab navigation -->
        <ul class="nav nav-tabs" id="messageTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="open-tab" data-toggle="tab" href="#openTickets" role="tab" aria-controls="openTickets" aria-selected="true">Open Tickets</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="close-tab" data-toggle="tab" href="#closeTickets" role="tab" aria-controls="closeTickets" aria-selected="false">Close Tickets</a>
            </li>
        </ul>
    <div class="tab-content" id="messageTabsContent">
        <!-- Unread messages -->
        <div class="tab-pane fade show active" id="openTickets" role="tabpanel" aria-labelledby="open-tab">
            <table class="table align-middle mb-0 bg-white">
                <thead class="bg-light">
                    <tr>
                        <th class="userName">User Name</th>
                        <th class="userEmail">Email</th>
                        <th class="Status">Status</th>
                        <th class="View">View</th>
                    </tr>
                </thead>
                <tbody>
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
                </tbody>
            </table>
        </div>

        <!-- Read messages -->
        <div class="tab-pane fade" id="closeTickets" role="tabpanel" aria-labelledby="close-tab">
            <table class="table align-middle mb-0 bg-white">
                <thead class="bg-light">
                    <tr>
                        <th class="userName">User Name</th>
                        <th class="userEmail">Email</th>
                        <th class="View">View</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($closeTickets as $closeTicket)
                       
                        <tr>
                            <td>{{ $closeTicket->user()->name }}</td>
                            <td>{{ $closeTicket->user()->email }}</td>

                        
                            <td>
                                <a href="{{ route('ticket_messages',['id'=>$closeTicket->id]) }}" class="view">View</a>
                            </td>
                        </tr>
                   
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>


@endsection


<script>
//   document.addEventListener("DOMContentLoaded", function() {
//        const descriptionCells = document.querySelectorAll('.message-cell');

//        descriptionCells.forEach(cell => {
//            cell.addEventListener('click', function() {
//                cell.classList.toggle('expanded');

//                const messageId = cell.getAttribute('data-message-id');
//                const isRead = cell.getAttribute('data-is-read'); // گرفتن وضعیت خوانده شده

//                // فقط در صورتی که پیام خوانده نشده باشد، درخواست AJAX ارسال شود
//                if (isRead === 'false') {
//                    // ارسال درخواست AJAX برای به‌روزرسانی وضعیت read
//                    fetch(`/admin/message/read/${messageId}`, {
//                        method: 'POST',
//                        headers: {
//                            'Content-Type': 'application/json',
//                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
//                        },
//                        body: JSON.stringify({ read: true })
//                    })
//                    .then(response => response.json())
//                    .then(data => {
//                        if (data.status === 'success') {
//                            console.log('Message marked as read');
                           
//                            // پیدا کردن برچسب 'New' و حذف آن
//                            const badge = cell.parentElement.querySelector('.badge-success');
//                            if (badge) {
//                                badge.remove();
//                            }
//                            cell.setAttribute('data-is-read', 'true');
//                            const unreadCountElement = document.getElementById('unread-count');
//                            let unreadCount = parseInt(unreadCountElement.textContent, 10);
//                            unreadCount = unreadCount > 0 ? unreadCount - 1 : 0;
//                            unreadCountElement.textContent = unreadCount;
                           

//                            if (unreadCount === 0) {
//                                unreadCountElement.style.display = 'none'; // مخفی کردن عنصر
//                            } else {
//                                unreadCountElement.textContent = unreadCount;
//                            }


//                        } else {
//                            console.error('Error marking message as read');
//                        }
//                    })
//                    .catch(error => {
//                        console.error('Error:', error);
//                    });
//                }
//            });
//        });
//   });

  document.addEventListener('DOMContentLoaded', function() {
    var tabs = document.querySelectorAll('#messageTabs a');
    
    tabs.forEach(function(tab) {
        tab.addEventListener('click', function(e) {
            e.preventDefault();
            var tabId = this.getAttribute('href');

            // همه تب‌ها را غیرفعال کنید
            tabs.forEach(function(tab) {
                tab.classList.remove('active');
                document.querySelector(tab.getAttribute('href')).classList.remove('show', 'active');
            });

            // تب کلیک شده را فعال کنید
            this.classList.add('active');
            document.querySelector(tabId).classList.add('show', 'active');
        });
    });
});


</script>


