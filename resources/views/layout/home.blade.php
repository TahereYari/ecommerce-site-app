@php
   use App\Models\Site;
   
     $site =Site::orderByDesc('created_at')->first();
@endphp
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!--=============== FAVICON ===============-->
        <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">

        <!--=============== REMIXICONS ===============-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.min.css">

        <!--=============== SWIPER CSS ===============-->
        <link rel="stylesheet" href="{{ asset('FrontPanel/css/swiper-bundle.min.css')}}">

        <!--=============== CSS ===============-->
        <link rel="stylesheet" href="{{ asset('FrontPanel/css/styles.css')}}">
        <link href="{{ asset('AdminPanel/FilePond/filepond.css') }}" rel="stylesheet">
        <link href="{{ asset('AdminPanel/FilePond/filepond-plugin-image-preview.css') }}" rel="stylesheet">
        <link href="{{ asset('AdminPanel/FilePond/filepond-plugin-media-preview.min.css') }}" rel="stylesheet">
      

        <title>Rushsan / Home </title>
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
        <!--==================== HEADER ====================-->
        <header class="header" id="header" dir="ltr">
            <nav class="nav container">
                <a href="" class="nav__logo">
                    <img src="{{ asset('FrontPanel/images/rushsunlogoo.png') }}" class="img__logo" alt="">
                </a>
                
                <div class="nav__menu" id="nav-menu" dir="ltr">
                    
                     <ul class="nav__list">
                        <li class="nav__item">
                           <a href="#home" class="nav__link">
                             <i class="ri-home-line"></i>
                             <span id="home">Home</span>
                           </a>
                        </li>
                        @if (Auth::user())
                        <li class="nav__item">
                            <a href="" class="nav__link" 
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="ri-price-tag-3-line"></i>
                                <span id="logout">Logout</span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                         </li>
                         @else
                         <li class="nav__item">
                            <a href="{{ route('login') }}" class="nav__link">
                                <i class="ri-price-tag-3-line"></i>
                                <span id="login1">Login/Register</span>
                            </a>
                         </li>
                        @endif
                      
                       @if (Auth::user())
                         <li class="nav__item">
                            <a href="{{ route('user_dashboard') }}" class="nav__link">
                                <i class="ri-compass-line"></i>
                                <span id="profile">Profile</span>
                            </a>
                         </li>
                        
                             <li class="nav__item">
                                <a href="{{ route('cart_page') }}" class="nav__link">
                                    <i class="ri-shopping-bag-line"></i>
                                    <span id="cart_shopping">Cart Shopping</span>
                                </a>
                            </li>
                         @endif
                        
                         
                     </ul>
                </div>
                <!-- Theme change button -->
                 
                <i class="ri-moon-line change-theme" id="theme-button"></i>
                <div class="img-trans" role="button" tabindex="0" aria-haspopup="true" aria-expanded="false" aria-label="Open language selection menu" onclick="toggleMenu()" onkeypress="toggleMenu()">
                    <img src="{{ asset('FrontPanel/images/translate2496.jpg') }}" alt="Translate" />
                    <div id="languageMenu" class="dropdown-menu" aria-hidden="true">
                        <ul>
                            <li class="img-transs" tabindex="0" role="menuitem"  id="btnPersian" onclick="switchLanguage('fa')">
                                <img src="{{ asset('FrontPanel/images/iran-32.png') }}" alt="Switch to Persian" class="img-t">
                            </li>
                            <hr>
                            <li class="img-transs" tabindex="0" role="menuitem" id="btnEnglish" onclick="switchLanguage('en')">
                                <img src="{{ asset('FrontPanel/images/united kingdom-32.png') }}" alt="Switch to English" class="img-t">
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <!--==================== MAIN ====================-->
        <main class="main">
           
        @yield('content')
          

        </main>

        <!--==================== FOOTER ====================-->
        <footer class="footer section">
            <div class="footer__container container grid">
                <div>
                    <a href="#" class="footer__logo">
                        .Rushsun
                    </a>
                    <p class="footer__description" id="footer__description">
                        The most reliable programming <br>service company by your side
                        
                    </p>
                </div>
                <div class="footer__content">
                    <div>
                        <h3 class="footer__title" id="footer__title">
                            Company
                        </h3>
                        <ul class="footer__links">
                            <li>
                                <a href="{{ route('login') }}" class="footer__link" id="footer_link_login">Login</a>
                            </li>
                            <li>
                                <a href="{{ route('login') }}" class="footer__link" id="footer_link_register">Sign up</a>
                            </li>
                            <li>
                                <a href="{{ route('user_dashboard') }}" class="footer__link" id="footer_link_dashboad">Dashboard</a>
                            </li>
                            
                        </ul>
                    </div>
                    <div>
                        <h3 class="footer__title" id="footer__title_blog">
                            Blog
                        </h3>
                        <ul class="footer__links">
                            <li>
                                <a href="#" class="footer__link" id="footer_link_Events">Events</a>
                            </li>
                            <li>
                                <a href="#" class="footer__link" id="footer_link_news">Popular news</a>
                            </li>
                            <li>
                                <a href="#" class="footer__link" id="footer_link_newsRecent">Recent news</a>
                            </li>
                            
                        </ul>
                    </div>
                    {{-- <div>
                        <h3 class="footer__title" id="footer_time">
                            Office
                        </h3>
                        <p class="footer__information" id="footer__information">
                            Monday - Saturday <br>
                            9AM - 10PM
                        </p>
                    </div> --}}
                    <div>
                        <h3 class="footer__title" id="footer_title_contact">
                            Contact us
                        </h3>
                        <ul class="footer__social">
                            <a href="https://www.facebook.com/{{ $site->facebook }}" target="_blank" class="footer__social-link">
                                <i class="ri-facebook-fill"></i>
                            </a>
                            <a href="https://www.instagram.com/{{ $site->instagram }}" target="_blank" class="footer__social-link">
                                <i class="ri-instagram-line"></i>
                            </a>
                            <a href="https://web.telegram.org//{{ $site->telegram }}" target="_blank" class="footer__social-link">
                                <i class="ri-telegram-line"></i>
                            </a>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="footer__info container">
                <span class="footer__copy">
                    &#169; Rushsun. All rigths reserved
                </span>
                <a href="#" class="footer__privacy">Terms & Conditions</a>
            </div>
        </footer>
        
        <!--========== SCROLL UP ==========-->
        <a href="#" class="scrollup" id="scroll-up">
            <i class="ri-customer-service-2-line"></i>
            <div class="popup" id="popup">Contact us</div>
        </a>
        
        <!--=============== SCROLLREVEAL ===============-->
        <script src="{{ asset('FrontPanel/js/scrollreveal.min.js') }}"></script>

        <!--=============== MIXITUP FILTER ===============-->
        <script src="{{ asset('FrontPanel/js/mixitup.min.js') }}"></script>

        <!--=============== SWIPER JS ===============-->
        <script src="{{ asset('FrontPanel/js/swiper-bundle.min.js') }}"></script>

        <!--=============== MAIN JS ===============-->
        <script src="{{ asset('FrontPanel/js/script.js') }}"></script>

        {{-- <script src="{{ asset('FrontPanel/js/translate/translateindex.js') }}"></script> --}}
        <script type="module" src="{{ asset('FrontPanel/js/translate/switchLanguage.js') }}" defer></script>
      
   
        
        <script src="{{ asset('AdminPanel/FilePond/filepond.js') }}"></script>
        <script src="{{ asset('AdminPanel/FilePond/filepond-plugin-file-validate-type.js') }}"></script>
        <script src="{{ asset('AdminPanel/FilePond/filepond-plugin-image-preview.js') }}"></script>

        <script src="{{ asset('AdminPanel/FilePond/filepond-plugin-media-preview.min.js') }}"></script>
        <script src="{{ asset('AdminPanel/FilePond/filepond-plugin-file-encode.min.js') }}"></script>
    

        <script src="{{ asset('AdminPanel/FilePond/filepond-plugin-file-validate-type.min.js') }}"></script>
        <script src="{{ asset('AdminPanel/FilePond/filepond-plugin-file-validate-size.min.js') }}"></script>
        
    </body>
</html>