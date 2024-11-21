<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.min.css">
    <link rel="stylesheet" href="{{ asset('FrontPanel/css/stylelogin.css') }}">
    <link rel="stylesheet" href="{{ asset('FrontPanel/css/styles.css') }}">

    <link href="{{ asset('AdminPanel/FilePond/filepond.css') }}" rel="stylesheet">
    <link href="{{ asset('AdminPanel/FilePond/filepond-plugin-image-preview.css') }}" rel="stylesheet">
    <link href="{{ asset('AdminPanel/FilePond/filepond-plugin-media-preview.min.css') }}" rel="stylesheet">
    
    <title>Rushsun / login</title>
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
    <div class="container-login" id="container-login" dir="ltr">
        <div class="form-container sign-up">
          
            <form  method="POST" action="{{ route('register') }}">
                @csrf
                <h1 id="account">Create Account</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <span id="register-">Use your email to register</span>
           
                <input type="text" id="text" placeholder="Name" name="name" class="form-control @error('name') is-invalid @enderror">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                <input type="email" id="email-l" placeholder="Email" name="email"  class="form-control @error('email') is-invalid @enderror">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                <input type="text" id="tel" placeholder="Phone Number" name="tel" class="form-control @error('tel') is-invalid @enderror">
                @error('tel')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <input type="password" id="password-l" placeholder="Password" name="password" class="form-control @error('password') is-invalid @enderror">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">    
                    <input type="hidden" class="filepond" id="upload-i-p" name="image"
                            aria-describedby="imageDescriptionformat,imageDescriptionSize" data-allow-reorder="true" data-max-file-size="5MB" />
                    <button id="button-">Sign Up</button>
            </form>
        </div>
        <div class="form-container sign-in">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <h1 id="sign">Sign In</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <span id="password-e"> Use your email password</span>
                <input type="email" id="email-p" placeholder="Email" class="form-control @error('email') is-invalid @enderror"  value="{{ old('email') }}"name="email">
                  @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                <input type="password" id="password-p" placeholder="Password"  class="form-control @error('password') is-invalid @enderror" name="password">
                  @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <a href="#" class="bg" id="forget">Forget Your Password?</a>
                <button id="button-s">Sign In</button>
                <div class="row mb-3">
                    <div class="col-md-6 offset-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
              <div class="toggle-panel toggle-left">
                <h1 id="welcome">Welcome Back!</h1>
                <p id="enter">Enter your personal details to use all of site features</p>
                <button class="hidden" id="login">Sign In</button>
              </div>
              <div class="toggle-panel toggle-right">
                <h1 id="khosh" >Hello, Friend!</h1>
                <p id="register-d">Register with your personal details to use all of site features</p>
                <button class="hidden" id="register" >Sign Up</button>
              </div>
            </div>
          </div>
    </div>

    <script src="{{ asset('FrontPanel/js/login.js') }}"></script>
    <script type="module" src="{{ asset('FrontPanel/js/translate/switchLanguage.js') }}" defer></script>
      
    {<script src="{{ asset('AdminPanel/FilePond/filepond.js') }}"></script>
    <script src="{{ asset('AdminPanel/FilePond/filepond-plugin-file-validate-type.js') }}"></script>
    <script src="{{ asset('AdminPanel/FilePond/filepond-plugin-image-preview.js') }}"></script>
    
    <script src="{{ asset('AdminPanel/FilePond/filepond-plugin-media-preview.min.js') }}"></script>
    <script src="{{ asset('AdminPanel/FilePond/filepond-plugin-file-encode.min.js') }}"></script>
    
    
    <script src="{{ asset('AdminPanel/FilePond/filepond-plugin-file-validate-type.min.js') }}"></script>
    <script src="{{ asset('AdminPanel/FilePond/filepond-plugin-file-validate-size.min.js') }}"></script>


</body>

</html>