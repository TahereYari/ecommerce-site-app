@extends('layout.admin')


@section('content')

<section class="middle">
    <div class="d-flex justify-content-end mb-4">
        @if ($unreadMessageCount >0)
        <span class="read">Unread Messages  </span>&nbsp; :  &nbsp;&nbsp;
        <span class="badge badge-success" id="unread-count">{{ $unreadMessageCount }}</span>
        @endif
  
    </div>

  
    <table class="table align-middle mb-0 bg-white"  id="example">
      
      <thead class="bg-light">
     
          <tr>
          
            <th id="user-name">User Name</th> 
            <th id="email">Email</th>
            <th id="message">Message</th>
            <th id="status">Status</th>
           
            
            
          </tr>
        </thead>
        <tbody id="tableBody">
          @foreach($messages as $message)
          <tr>
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
       
          
          
        </tbody>
    </table>
    
    {{-- <canvas id="chart" style="display: none;"></canvas> --}}
   
  </section>


@endsection


<script>
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
