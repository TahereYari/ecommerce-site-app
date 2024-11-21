<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title id="titleOfSite">Rushsun Company</title>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="{{ asset('AdminPanel/css/bootstrap.min.css') }}" rel="stylesheet">    
    {{-- <link href="{{ asset('AdminPanel/css/persian-datepicker.css') }}" rel="stylesheet">     --}}
    <link rel="stylesheet" href="{{ asset('AdminPanel/css/style.css') }}">

 

    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">

     <!-- Persian Datepicker -->
     {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/persian-datepicker@1.2.0/dist/css/persian-datepicker.min.css"> --}}
    
      <!-- jQuery UI Datepicker -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    
    <link href="{{ asset('AdminPanel/FilePond/filepond.css') }}" rel="stylesheet">
    <link href="{{ asset('AdminPanel/FilePond/filepond-plugin-image-preview.css') }}" rel="stylesheet">
    <link href="{{ asset('AdminPanel/FilePond/filepond-plugin-media-preview.min.css') }}" rel="stylesheet">
   
  
</head>
    
</head>
<style>
    body.loading {
        visibility: hidden;
    }
    body.loaded {
        visibility: visible;
    }
</style>
<body class="loading">
    @include('sweetalert::alert')
    <nav dir="ltr">
        <div class="container">
            <img src=" {{ asset('AdminPanel/images/rushsunlogoo.png') }} " class="logo">
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
                    
                        <h4 id=> {{ Auth::user()->name }}</h4>
                    
                    
                    <span class="material-icons-sharp">expand_more</span>
                    <div class="dropdown-content" id="dropdownMenu" role="menu">
                        <a href="{{ route('user_profile') }}" id="po-t" role="menuitem">profile</a>
                        <a href="{{ route('change_password') }}" id="change-pass" role="menuitem" >Change Password</a>
                        {{-- <a href="{{ route('logout') }}" id="Log_out" role="menuitem" >Log Out</a> --}}
                        
                       <a href="" id="Log_out" role="menuitem" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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
                @can('dashboard')
                <a href="{{ route('admin') }}"   class=" {{ request()->routeIs ('admin') ? 'active' : '' }}">
                    <span class="material-icons-sharp">dashboard</span>
                    <h3 data-translate="dashboard" id="dash">Dashboard</h3>
                </a>
                @endcan
                {{-- @can('site') --}}
                <a href="{{ route('site_create') }}"   class=" {{ request()->routeIs ('site_create') ? 'active' : '' }}">
                    <span class="material-icons-sharp">web</span>
                    <h3  id="site">Site</h3>
                </a>
                {{-- @endcan --}}
                @can('products')
                <a href="{{ route('category_list') }}"  class=" {{ request()-> routeIs ('category_list') || request()-> routeIs ('category_create') ? 'active' : '' }}">
                  
                    <span class="material-icons-sharp">category</span>
                    <h3 id="categories">Categories</h3>
                </a>
                @endcan

                @can('products')
                <a href="{{ route('product_list') }}"  class=" {{ request()-> routeIs ('product_list') || request()-> routeIs ('product_create') ? 'active' : '' }}">
                    <span class="material-icons-sharp">currency_exchange</span>
                    <h3 id="pro">Products</h3>
                </a>
                @endcan

              
                
                
                @can('users')
                <a href="{{ route('user_list') }}" class=" {{ request()-> routeIs ('user_list') || request()-> routeIs ('user_create')  ? 'active' : '' }}">
                    <span class="material-icons-sharp">person</span>
                    <h3  id="user-list">Users</h3>
                </a>
                @endcan

                @can('competitions')
                <a href="{{ route('competition_list') }}" class=" {{ request()-> routeIs ('competition_list')||
                                                                     request()-> routeIs ('competition_answers')||
                                                                     request()-> routeIs ('competition_create')||
                                                                     request()-> routeIs ('competition_winers')
                                                                    ? 'active' : '' }}">
                    <span class="material-icons-sharp">quiz</span>
                    <h3 id="m">Competitions</h3>
                </a>  
                @endcan
               
                @can('roles')
                <a href="{{ route('role_list') }}"  class=" {{ request()->routeIs ('role_list') || request()-> routeIs ('role_create')? 'active' : '' }}">
                    <span class="material-icons-sharp">account_circle</span>
                    <h3 id="mf">Management Of Role</h3>
                </a>
                @endcan

                @can('messages')
                <a href="{{ route('message_list') }}" class=" {{ request()->routeIs ('message_list') ? 'active' : '' }}">
                    <span class="material-icons-sharp">message</span>
                    <h3 id="msg">Messages</h3>
                </a>
                @endcan
               
               
                @can('support')
                <a href="{{ route('ticket_list') }}" class=" {{ 
                                                            request()->routeIs ('ticket_list')  ||
                                                            request()->routeIs ('ticket_messages')
                                                            ? 'active' : '' }}">
                    <span class="material-icons-sharp">contact_support</span>
                    <h3 id="support">Support</h3>
                </a>
                @endcan

                {{-- @can('request_product') --}}
                <a href="{{ route('request_list') }}" class=" {{ request()->routeIs ('request_list') ? 'active' : '' }}">
                    <span class="material-icons-sharp">request_quote</span>
                    <h3 id="request_product">Request Product</h3>
                </a>
                {{-- @endcan --}}

                {{-- @can('request_product') --}}
                <a href="{{ route('invoice_list') }}" class=" {{ request()->routeIs ('invoice_list') ? 'active' : '' }}">
                    <span class="material-icons-sharp">sell</span>
                    <h3 id="invoice">Invoice</h3>
                </a>
                {{-- @endcan --}}

                {{-- @can('setting')
                <a href="">
                    <span class="material-icons-sharp">settings</span>
                    <h3 id="seti">Setings</h3>
                </a>
                @endcan
                
            </div>

            <div class="updates">
                <span class="material-icons-sharp">update</span>
                <h4 id="up">Update </h4>
                <p id="sc">Security Update</p>
                <p id="u-o">Public Update</p>
                <a id="u-k" href="#">update</a>
            </div> --}}
        </aside>




        @yield('content')

    </main>
    

    
    
   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.js" integrity="sha512-GMGzUEevhWh8Tc/njS0bDpwgxdCJLQBWG3Z2Ct+JGOpVnEmjvNx6ts4v6A2XJf1HOrtOsfhv3hBKpK9kE5z8AQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script   src="{{ asset('AdminPanel/js/main.js') }}"></script>
    {{-- <script   src="{{ asset('AdminPanel/js/persian-date.js') }}"></script>
    <script   src="{{ asset('AdminPanel/js/persian-datepicker.js') }}"></script> --}}
    <script   src="{{ asset('AdminPanel/js/chart.js') }}"></script>
    {{-- <script   src="{{ asset('AdminPanel/js/FilePond/filepond-config.js') }}"></script> --}}
   

    <script src="{{ asset('AdminPanel/FilePond/filepond.js') }}"></script>
    <script src="{{ asset('AdminPanel/FilePond/filepond-plugin-file-validate-type.js') }}"></script>
    <script src="{{ asset('AdminPanel/FilePond/filepond-plugin-image-preview.js') }}"></script>

   <script src="{{ asset('AdminPanel/FilePond/filepond-plugin-media-preview.min.js') }}"></script>
    <script src="{{ asset('AdminPanel/FilePond/filepond-plugin-file-encode.min.js') }}"></script>
   

    <script src="{{ asset('AdminPanel/FilePond/filepond-plugin-file-validate-type.min.js') }}"></script>
    <script src="{{ asset('AdminPanel/FilePond/filepond-plugin-file-validate-size.min.js') }}"></script>
   
    <script src="{{ asset('AdminPanel/js/bootstrap.bundle.min.js') }}"></script>
    {{-- <script src="{{ asset('AdminPanel/js/translate/translate.js') }}"></script> --}}
    {{-- <script src="{{ asset('AdminPanel/js/translate/translateadmin.js') }}"></script> --}}
    <script type="module" src="{{ asset('AdminPanel/js/translate/switchLanguage.js') }}" defer></script>
    {{-- <script src="{{ asset('AdminPanel/js/translate/translatedashboard.js') }}"></script> --}}
  
    {{-- <script src="{{ asset('AdminPanel/js/translate/translatec.js') }}"></script> --}}
    {{-- <script src="{{ asset('AdminPanel/js/translate/translatefP.js') }}"></script> --}}
    {{-- <script src="{{ asset('AdminPanel/js/translate/translatemf.js') }}"></script> --}}
    {{-- <script src="{{ asset('AdminPanel/js/translate/translatep.js') }}"></script> --}}
    {{-- <script src="{{ asset('AdminPanel/js/translate/translateuf.js') }}"></script> --}}
  
   
      
    <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.js"></script>
    <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- Persian Datepicker -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/persian-datepicker@1.2.0/dist/js/persian-datepicker.min.js"></script> --}}

    <!-- jQuery UI Datepicker -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    
    <script src="{{ asset('AdminPanel/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('AdminPanel/tinymce/plugins/advlist/plugin.min.js') }}"></script>
    <script src="{{ asset('AdminPanel/tinymce/plugins/autolink/plugin.min.js') }}"></script>
    <script src="{{ asset('AdminPanel/tinymce/plugins/link/plugin.min.js') }}"></script>
    <script src="{{ asset('AdminPanel/tinymce/plugins/lists/plugin.min.js') }}"></script>
    <script src="{{ asset('AdminPanel/tinymce/plugins/preview/plugin.min.js') }}"></script>
    <script src="{{ asset('AdminPanel/tinymce/plugins/table/plugin.min.js') }}"></script>
    <script src="{{ asset('AdminPanel/tinymce/plugins/code/plugin.min.js') }}"></script>
    <script src="{{ asset('AdminPanel/tinymce/plugins/pagebreak/plugin.min.js') }}"></script>

   <script>
        const baseUrl = "{{ asset('') }}";
    </script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const descriptionCells = document.querySelectorAll('.description-cell');

        descriptionCells.forEach(cell => {
        cell.addEventListener('click', function() {
            cell.classList.toggle('expanded');
        });
        });
    });

      document.addEventListener("DOMContentLoaded", function() {
        const descriptionCells = document.querySelectorAll('.answer-cell');

        descriptionCells.forEach(cell => {
        cell.addEventListener('click', function() {
            cell.classList.toggle('expanded');
        });
        });
    });


    

// tinymce.init({
//         selector: 'textarea#description-of-product',
//         plugins : 'advlist autolink link lists preview table code pagebreak',
//         menubar: false,
//         language: 'fa',
//         height: 300,
//         relative_urls: false,
//         toolbar: 'undo redo | removeformat preview code | fontsizeselect bullist numlist | alignleft aligncenter alignright alignjustify | bold italic | pagebreak table link',
//     });





</script>
 

</body>

</html>