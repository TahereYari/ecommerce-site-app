<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Rushsan / Dashboard User</title>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="{{ asset('AdminPanel/css/bootstrap.min.css')}}" rel="stylesheet">    
    <link rel="stylesheet" href="{{ asset('AdminPanel/css/style.css')}}">

    <link href="{{ asset('AdminPanel/FilePond/filepond.css') }}" rel="stylesheet">
    <link href="{{ asset('AdminPanel/FilePond/filepond-plugin-image-preview.css') }}" rel="stylesheet">
    <link href="{{ asset('AdminPanel/FilePond/filepond-plugin-media-preview.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<style>
    body.loading {
        visibility: hidden;
    }
    body.loaded {
        visibility: visible;
    }
</style>
<body  class="loading">
    @include('sweetalert::alert')
    <nav dir="ltr">
        <div class="container">
            <img src="{{ asset('AdminPanel/images/rushsunlogoo.png') }}" class="logo">
            {{-- <div class="search-bar">
                <span class="material-icons-sharp">search</span>
                <input type="search" placeholder="Search">
            </div> --}}
            
            <div class="profile-area">
                <div class="theme-btn">
                    <span class="material-icons-sharp active">light_mode</span>
                    <span class="material-icons-sharp">dark_mode</span>
                </div>
                
                <div class="img-trans" role="button" tabindex="0" aria-haspopup="true" aria-expanded="false" aria-label="Open language selection menu" onclick="toggleMenu()" onkeypress="toggleMenu()">
                    <img src="{{ asset('AdminPanel/images/translate2496.jpg') }}" alt="Translate" />
                    <div id="languageMenu" class="dropdown-menu" aria-hidden="true">
                        <ul>
                            <li class="img-transs" tabindex="0" role="menuitem"  id="btnPersian" onclick="switchLanguage('fa')">
                                <img src="{{ asset('AdminPanel/images/iran-32.png') }}" alt="Switch to Persian">
                            </li>
                            <hr>
                            <li class="img-transs" tabindex="0" role="menuitem" id="btnEnglish" onclick="switchLanguage('en')">
                                <img src="{{ asset('AdminPanel/images/united kingdom-32.png') }}" alt="Switch to English">
                            </li>
                        </ul>
                    </div>
                </div>
                
                <div class="profile">
                    <div class="profile-photo">
                        
                        
                    @if (auth()->user()->image !== null)
                         <img src="{{ asset('Images/User/'.auth()->user()->image)}}" alt="">
                    @else
                        <img src="{{ asset('AdminPanel/images/userImage.png') }}" alt="">
                    @endif
                    </div>
                    <h4 id="">{{ auth()->user()->name }}</h4>
                    <span class="material-icons-sharp">expand_more</span>
                    <div class="dropdown-content" id="dropdownMenu" role="menu">
                        <a href="{{ route('profile') }}" id="po-t" role="menuitem">profile</a>
                        {{-- <a href="#" id="p-s" role="menuitem">setings</a> --}}
                       

                        <a id="Log_out" role="menuitem" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="ri-price-tag-3-line"></i>
                            <span id="logout">Logout</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        
                    </div>
                </div>
                
                <button id="menu-btn">
                    <span class="material-icons-sharp">menu</span>
                </button>
            </div>
        </div>
        
    </nav>

    <main >
        <aside>
            <button id="close-btn">
                <span class="material-icons-sharp">close</span>
            </button>
            <div class="sidebar">
                <a href="{{ route('user_dashboard') }}" class="{{ request()->routeIs('user_dashboard') ? 'active': '' }}">
                    <span class="material-icons-sharp">dashboard</span>
                    <h3 id="dash">Dashboard</h3>
                </a>
                <a href="{{ route('profile') }}" class="{{ request()->routeIs('profile') ? 'active': '' }}">
                    <span class="material-icons-sharp">
                        person
                    </span>
                    <h3 id="profile-">Profile</h3>
                </a>
                <a href="{{ route('show_purchases') }}" class="{{ request()->routeIs('show_purchases') ? 'active': '' }}">
                    <span class="material-icons-sharp">currency_exchange</span>
                    <h3 id="pro">Products</h3>
                </a>
                <a href="{{ route('cart_page') }}" class="{{ request()->routeIs('cart_page') ? 'active': '' }}">
                    <span class="material-icons-sharp">
                        shopping_cart
                    </span>
                    <h3 id="cart">Cart</h3>
                </a>
                
                
                <a href="{{ asset(route('ticket_page')) }}" class="{{ request()->routeIs('ticket_page') ? 'active': '' }}" >
                    <span class="material-icons-sharp">
                        task
                        </span>
                    <h3 id="ticket-d">Ticket</h3>
                </a>
                {{-- <a href="messages.html">
                    <span class="material-icons-sharp">message</span>
                    <h3 id="msg">Messages</h3>
                </a>
                <a href="">
                    <span class="material-icons-sharp">help_center</span>
                    <h3 id="support">Support</h3>
                </a>
                <a href="">
                    <span class="material-icons-sharp">settings</span>
                    <h3 id="seti">Setings</h3>
                </a> --}}
            </div>
    
            {{-- <div class="updates">
                <span class="material-icons-sharp">update</span>
                <h4 id="up">Update </h4>
                <p id="sc">Security Update</p>
                <p id="u-o">Public Update</p>
                <a id="u-k" href="#">update</a>
            </div> --}}
        </aside>

     @yield('content')

    </main>
    
    <div class="chart-container">
        <canvas id="userStatsChart"></canvas>
    </div>
   
    
   
    <script src="{{ asset('FrontPanel/js/main.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.js" integrity="sha512-GMGzUEevhWh8Tc/njS0bDpwgxdCJLQBWG3Z2Ct+JGOpVnEmjvNx6ts4v6A2XJf1HOrtOsfhv3hBKpK9kE5z8AQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>  
    <script src=" {{ asset('AdminPanel/js/bootstrap.bundle.min.js') }}"></script>
    <script type="module" src="{{ asset('FrontPanel/js/translate/switchLanguage.js') }}" defer></script>
    <script src="{{ asset('FrontPanel/js/upload.js') }}"></script>


    
    <script src="{{ asset('AdminPanel/FilePond/filepond.js') }}"></script>
    <script src="{{ asset('AdminPanel/FilePond/filepond-plugin-file-validate-type.js') }}"></script>
    <script src="{{ asset('AdminPanel/FilePond/filepond-plugin-image-preview.js') }}"></script>

   <script src="{{ asset('AdminPanel/FilePond/filepond-plugin-media-preview.min.js') }}"></script>
    <script src="{{ asset('AdminPanel/FilePond/filepond-plugin-file-encode.min.js') }}"></script>
   

    <script src="{{ asset('AdminPanel/FilePond/filepond-plugin-file-validate-type.min.js') }}"></script>
    <script src="{{ asset('AdminPanel/FilePond/filepond-plugin-file-validate-size.min.js') }}"></script>
   

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    {{-- <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script> --}}
    <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.js"></script>
    <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    
</body>

<script>
        document.addEventListener("DOMContentLoaded", function() {
        const descriptionCells = document.querySelectorAll('.description-cell');

        descriptionCells.forEach(cell => {
        cell.addEventListener('click', function() {
            cell.classList.toggle('expanded');
        });
        });
    });
</script>
</html>