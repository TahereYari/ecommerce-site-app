@extends('layout.admin')


@section('content')

<section class="middle">
    @if ( $ticket->status == 0)
    <div class="card card-u p-3">
        {{-- <input type="text" class="form-control" id="ticket-title" placeholder="Ticket title..."> --}}

        
        <form method="POST" enctype="multipart/form-data" action="{{ route('insert_ticket_admin') }}">
            @csrf
              <textarea class="form-control" id="ticket-text" placeholder="Ticket text:" name="message"></textarea>
            
              <input type="hidden" name="ticketId" value="{{$ticket->id}}">
             
            <button type="submit" id="submit" class="btn btn-block btn-theme btn-form">Submit</button>
  
       
          </form>
      
      
      
      </div>
      @endif
      <div class="card card-u p-3">
        <div class="card-row">
      
            <div class="card " >

              <hr>
              @foreach ($ticketMessages as $tickettMessage)
              <div class="card-body">
                <h5 class="card-title">{{ $tickettMessage->user()->name }}</h5>
                <h6  class="card-subtitle mb-2 text-muted message-cell" id=""  data-message-id="{{ $tickettMessage->id }}">{{ $tickettMessage->message }}</h6>
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

            </div>
            
            
        </div>
     </div>
</section>

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
                    fetch(`/admin/ticketMessages/read/${messageId}`, {
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
@endsection