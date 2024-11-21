@php

    // use App\Models\Site;
    // $site =Site::orderByDesc('created_at')->first();
    use App\Models\BasketProduct;
    use App\Models\LicenseRecords;
@endphp     

@extends('layout.home')

@section('content')

  <!--==================== HOME ====================-->
  {{-- <section class="home section" id="home">
    <div class="home__container container grid">
        <div class="home__data">
            <h1 class="home__title" id="">
               
                   {{ $site->name }}
            </h1>
           
          
                <p class="home__description" id="" style="margin-right: 20px">
                    {{ $site->descirbe }}
                </p>
           
            <a href="#new" class="button__link button-c" id="button__link">
                <span id="button__link_text">Explore</span>
                <i class="ri-arrow-right-fill" id="button__link_icon"></i>
            </a>
        </div>
        <div class="home__images">
            <img src="{{ asset('Images/Site/'. $site->image)}}" alt="home image">
            <img src="images/ai-2.jpg" alt="home image">
        </div>
    </div>
</section> --}}
<section class="section-a section">
    <div class="info-box">
      <div class="section-1">
        <i class="ri-group-line ic"></i>
        <p id="user-count" data-target="{{ $totalUsers }}">0</p> <!-- replace 1000 with the actual count -->
        <h4 id="users">Users</h4>
      </div>
      <div class="section-1">
        <i class="ri-profile-line ic"></i>
        <p id="project-count" data-target="{{ $site->completed_projects }}">0</p> <!-- replace 500 with the actual count -->
        <h4 id="projects">Projects</h4>
      </div>
      <div class="section-1">
        <i class="ri-product-hunt-line ic"></i>
        <p id="purchase-count" data-target="{{ $totalProducts }}">0</p> <!-- replace 2000 with the actual count -->
        <h4 id="products">Products</h4>
      </div>
      
    </div>
</section>
 <!--=============== ABOUT ===============-->
 <section class="about section" id="about">
    
    <h2 class="section__title" id="section__title">About Me</h2>

    <div class="about__container container grid">
        <img src="images/company.jpg" alt="" class="about__img">

        <div class="about__data">
            <div class="about__info">
                <div class="about__box">
                    <i class="ri-award-fill about__icon"></i>
                    <h3 class="about__title" id="about__title">Experience</h3>
                   {{ $site->experience }} <span class="about__subtitle" id="about__subtitle"> Years Working</span>
                </div>

                <div class="about__box">
                    <i class="ri-briefcase-3-line about__icon"></i>
                    <h3 class="about__title" id="completed">Completed</h3>
                    {{ $site->completed_projects }}<span class="about__subtitle" id="project">Projects</span>
                </div>

                <div class="about__box">
                    
                    <i class="ri-customer-service-2-fill about__icon"></i>
                    <h3 class="about__title" id="support">Support</h3>
                    {{-- <span class="about__subtitle" id="online">Online 24/7</span> --}}
                </div>
            </div>

            {{-- <p class="about__description" id="about__description">
                Being updated with the latest technologies and development methods is our priority
                Our team operates in Iran and Italy with tax code 12666510016 and helps you achieve your goals by focusing on details and high quality to meet your professional needs.
            </p> --}}
            <p class="about__description" id="">
                {{ $site->descirbe }}
            </p>

            <a href="#contact" class="button-c" id="button-c">Contact Us</a>
        </div>
    </div>
 </section>
<!--==================== NEW ====================-->
<section class="new section" id="new">
    <h2 class="section__title" id="section__titlee">
        New Products
    </h2>
    <div class="new__container container grid">
        @foreach ($newProducts as $new)
        <div class="work__card mix web">
            <img src="{{asset('images/Product/Images/'.$new->image)  }}" alt="" class="work__img">

            <h3 class="work__title" id="">{{ $new->name }}</h3>

            <div>


                <div class="product">
                    <a href="{{ route('view_product',['id'=>$new->id]) }}" class="services__button view" id="view1">
                        View  <i class='ri-arrow-right-fill services__icon' ></i>
                    </a>
                    @if ($new->free == 0)
                        @if ($new->price == 0)
                            <h3 class="work__title Has_license">Has license</h3>
                        @else
                            <h3 class="work__title" id="">{{ number_format($new->price) }}
                            <span class="rial">Rial</span>
                            </h3>
                         @endif
                    @else
                    <h3 class="work__title" id="free">
                        <span class="free">Free</span>
                        </h3>
                    @endif
                 
                  

                </div>
              
            
                
            </div>
            <br>
            @if (Auth::user())

                 @php
                    $userId = Auth::user()->id;
                    $hasPurchased = BasketProduct::whereHas('basket', function($query) use ($userId) {
                        $query->where('user_id', $userId)->where('is_pay', 1);
                    })->where('product_id', $new->id)->exists();
                @endphp
                  @if ($hasPurchased)
                        @if ($new->license)
                            @php
                               $licenseRecord = LicenseRecords::where('user_id', auth()->user()->id)
                                ->where('product_id', $new->id)
                                ->orderBy('id', 'desc')->first();
                               
                            @endphp
                            
                            @if ($licenseRecord)
                                @php
                                    $licenseDurationMonths = $licenseRecord->license->type; // Duration in months
                                    $expirationDate = $licenseRecord->created_at->addMonths($licenseDurationMonths);
                                @endphp

                                @if (now()->greaterThan($expirationDate))
                                <span class="work__title previously">You have previously purchased a</span>
                                <span class="work__title">{{ $licenseDurationMonths }}</span><br>
                                <span class="work__title expired">month license. Your license has expired. Please renew it.</span>
                                    {{-- <span class="work__title" >You have previously purchased a {{ $licenseDurationMonths }}-month license. Your license has expired. Please renew it.</span> --}}
                                @else
                                <span class="work__title previously">You have previously purchased a</span>
                                <span class="work__title">{{ $licenseDurationMonths }}</span><br>
                                <span class="work__title valid">month license. Your license is still valid.</span>
                                    {{-- <span class="work__title">You have previously purchased a {{ $licenseDurationMonths }}-month license. Your license is still valid.</span> --}}
                                @endif
                            @else
                                <span class="work__title purchased">You have purchased this product</span>
                                <span class="work__title No_license_record"> No license record found.</span>
                            @endif
                        @else
                            <span class="work__title purchased">You have purchased this product.</span>
                        @endif
                    @else   
                    @if ($new->license == 1)
                        <a href="{{ route('view_product',['id'=>$new->id]) }}">
                            <button class="button-buy add-to-cart buy" name="add-to-cart">Buy<i class="ri-shopping-basket-fill"></i></button>
                        </a>
                    @else
                        <a href="{{ route('cartInsert',['user_id'=>auth()->user()->id , 'product_id' =>$new->id]) }}">
                        <button class="button-buy add-to-cart buy" name="add-to-cart">Buy<i class="ri-shopping-basket-fill"></i></button>
                        </a>
                    @endif
                @endif
            @endif
            
        </div>
        @endforeach
        <a href="{{ route('all_products') }}"><button class="button-buy add-to-cart all_product"  name="add-to-cart">All Product</button></a>
       
    </div>


</section>


<!--==================== FREE ====================-->
<section class="new section" id="new">
    <h2 class="section__title" id="free_section__title">
        Free Products
    </h2>
    <div class="new__container container grid">
        @foreach ($freeproducts as $free)
        <div class="work__card mix web">
            <img src="{{asset('images/Product/Images/'.$free->image)  }}" alt="" class="work__img">

            <h3 class="work__title" id="">{{ $free->name }}</h3>

            <div>


                <div class="product">
                    <a href="{{ route('view_product',['id'=>$free->id]) }}" class="services__button view" id="view1">
                        View  <i class='ri-arrow-right-fill services__icon' ></i>
                    </a>
                  
                    <h3 class="work__title" id="free">
                        <span class="free">Free</span>
                    </h3>
                  
                 
                  

                </div>
              
            
                
            </div>
            <br>
             @if (Auth::user())

                 @php
                    $userId = Auth::user()->id;
                    $hasPurchased = BasketProduct::whereHas('basket', function($query) use ($userId) {
                        $query->where('user_id', $userId)->where('is_pay', 1);
                    })->where('product_id', $free->id)->exists();
                @endphp
                  @if ($hasPurchased)
                        @if ($free->license)
                            @php
                                $licenseRecord = LicenseRecords::whereHas('license', function ($query) use ($new) {
                                    $query->where('product_id', $free->id);
                                })->first();
                            @endphp
                            
                            @if ($licenseRecord)
                                @php
                                    $licenseDurationMonths = $licenseRecord->license->type; // Duration in months
                                    $expirationDate = $licenseRecord->created_at->addMonths($licenseDurationMonths);
                                @endphp

                                @if (now()->greaterThan($expirationDate))
                                    <span class="work__title previously">You have previously purchased a</span>
                                    <span class="work__title">{{ $licenseDurationMonths }}</span><br>
                                    <span class="work__title expired">month license. Your license has expired. Please renew it.</span>
                                    {{-- <span class="work__title" >You have previously purchased a {{ $licenseDurationMonths }}-month license. Your license has expired. Please renew it.</span> --}}
                                @else
                                    <span class="work__title previously">You have previously purchased a</span>
                                    <span class="work__title">{{ $licenseDurationMonths }}</span><br>
                                    <span class="work__title valid">month license. Your license is still valid.</span>
                                    {{-- <span class="work__title">You have previously purchased a {{ $licenseDurationMonths }}-month license. Your license is still valid.</span> --}}
                                @endif
                            @else
                                <span class="work__title purchased">You have purchased this product</span>
                                <span class="work__title No_license_record"> No license record found.</span>
                            @endif
                        @else
                            <span class="work__title purchased">You have purchased this product.</span>
                        @endif
                    @else   
                    @if ($free->license == 1)
                        <a href="{{ route('view_product',['id'=>$free->id]) }}">
                            <button class="button-buy add-to-cart buy" name="add-to-cart">Buy<i class="ri-shopping-basket-fill"></i></button>
                        </a>
                    @else
                        <a href="{{ route('cartInsert',['user_id'=>auth()->user()->id , 'product_id' =>$free->id]) }}">
                        <button class="button-buy add-to-cart buy" name="add-to-cart">Buy<i class="ri-shopping-basket-fill"></i></button>
                        </a>
                    @endif
                @endif
            @endif
            
            
        </div>
        @endforeach
        <a href="{{ route('all_free_products') }}"><button class="button-buy add-to-cart all_product"  name="add-to-cart">All Product</button></a>
       
    </div>
         
</section>

<!--==================== Recent Products ====================-->
<section class="work section" id="work">
    
    <h2 class="section__title" id="section__tiitle">Recent Products</h2>

    <div class="work__filters">
        <span class="work__item active-work" data-filter='all' id="all">All</span>

        @foreach ($categories as $category)
        <span class="work__item" data-filter='.{{ $category->name }}' id="">{{ $category->name }}</span>
     
        @endforeach
    </div>

    <div class="work__container container grid">
    
            @foreach ($allproducts as $product)
                <div class="work__card mix {{ $product->category()->name }}">
                    <img src="{{asset('images/Product/Images/'.$product->image)  }}" alt="{{ $product->name }}" class="work__img">

                    <h3 class="work__title" id="">{{ $product->name }}</h3>
                     
                    <div class="product">
                        <a href="{{ route('view_product',['id'=>$product->id]) }}" class="services__button view" id="view1">
                            View  <i class='ri-arrow-right-fill services__icon' ></i>
                        </a>
                        @if ($product->free == 0)
                            @if ($product->price == 0)
                                <h3 class="work__title Has_license">Has license</h3>
                            @else
                                <h3 class="work__title" id="">{{ number_format($product->price) }}
                                <span class="rial">Rial</span>
                                </h3>
                            @endif
                        @else
                        <h3 class="work__title" id="">
                            <span class="free">Free</span>
                            </h3>
                        @endif
                       
                      
    
                    </div>
                      
                    @if (Auth::user())

                            @php
                                $userId = Auth::user()->id;
                                $hasPurchased = BasketProduct::whereHas('basket', function($query) use ($userId) {
                                    $query->where('user_id', $userId)->where('is_pay', 1);
                                })->where('product_id', $product->id)->exists();
                            @endphp
                            @if ($hasPurchased)
                                    @if ($product->license)
                                        @php
                                           $licenseRecord = LicenseRecords::where('user_id', auth()->user()->id)
                                            ->where('product_id', $product->id)
                                            ->orderBy('id', 'desc')->first();
                                        @endphp
                                        
                                        @if ($licenseRecord)
                                            @php
                                                $licenseDurationMonths = $licenseRecord->license->type; // Duration in months
                                                $expirationDate = $licenseRecord->created_at->addMonths($licenseDurationMonths);
                                            @endphp

                                            @if (now()->greaterThan($expirationDate))
                                            <span class="work__title previously">You have previously purchased a</span>
                                            <span class="work__title">{{ $licenseDurationMonths }}</span><br>
                                            <span class="work__title expired">month license. Your license has expired. Please renew it.</span>
                                                {{-- <span class="work__title" >You have previously purchased a {{ $licenseDurationMonths }}-month license. Your license has expired. Please renew it.</span> --}}
                                            @else
                                            <span class="work__title previously">You have previously purchased a</span>
                                            <span class="work__title">{{ $licenseDurationMonths }}</span><br>
                                            <span class="work__title valid">month license. Your license is still valid.</span>
                                                {{-- <span class="work__title">You have previously purchased a {{ $licenseDurationMonths }}-month license. Your license is still valid.</span> --}}
                                            @endif
                                        @else
                                            <span class="work__title purchased">You have purchased this product</span>
                                            <span class="work__title No_license_record"> No license record found.</span>
                                        @endif
                                    @else
                                        <span class="work__title purchased">You have purchased this product.</span>
                                    @endif
                                @else   
                            @if ($new->license == 1)
                                <a href="{{ route('view_product',['id'=>$new->id]) }}">
                                    <button class="button-buy add-to-cart buy" name="add-to-cart">Buy<i class="ri-shopping-basket-fill"></i></button>
                                </a>
                                @else
                                    <a href="{{ route('cartInsert',['user_id'=>auth()->user()->id , 'product_id' =>$new->id]) }}">
                                    <button class="button-buy add-to-cart buy" name="add-to-cart">Buy<i class="ri-shopping-basket-fill"></i></button>
                                    </a>
                                @endif
                            @endif
                    @endif
            
                       
                </div>
            
            @endforeach   
        
    </div>
   
    
</section>

<!--==================== Categories ====================-->
<section class="categories-section">
    <h2 class="section__title" id="category__title">Categories</h2>
    
    <div class="categories__container container grid">
        @foreach ($categories as $category)
            <div class="category__card">
                <a href="{{ route('category.products', $category->id) }}">
                    @if ($category->image != null)
                    <img src="{{ asset('images/Category/' . $category->image) }}" alt="{{ $category->name }}" class="category__img">
                    @else
                    <img src=" {{ asset('AdminPanel/images/category.png')   }}" alt="{{ $category->name }}" class="category__img">
                    @endif
                 
                    <h3 class="category__title">{{ $category->name }}</h3>
                </a>
            </div>
        @endforeach
    </div>
</section>

<!--======================= quiz =======================-->
<section class="quiz-section ">

    
        <h2 class="quiz-title" id="quiz-title"> Today question </h2>
        <div class="quiz-question-container">
            <span class="quiz-question" id="quiz-number">Contest Number :</span>
            <span class="quiz-number-value" id="quiz-number-value">{{ $competiotion->number }}</span>
        </div>
        <p class="quiz-question" id="quiz-question">Contest question text: </p>
       
        <br>
       <p class="quiz-description" > {{ $competiotion->description }}</p>
       <br> <br>
       @if (Auth::user())
        @if (!$competiotion->competiotionsAnswers()->where('user_id', auth()->user()->id)->exists())
         <p class="quiz-question" id="quiz-answer"> Please enter your answer in the box below.</p>
             <form class="quiz-form" method="POST" action="{{ route('competetion_answer',['id'=>$competiotion->id]) }}"
                enctype="multipart/form-data" id="quiz-form">
            
                @csrf
                <label for="answer" id="quiz-label-answer">Your answer:</label>
                <textarea id="answer" name="answer" rows="10" cols="50" class="quiz-textarea"
                    placeholder="Enter your answer here..."></textarea>
            
                <label for="file-upload" id="quiz-label-file"> Related file (optional):</label>
                {{-- <input type="file" id="file-upload" name="file" class="quiz-file-input" accept="image/*"> --}}
                <div class="form-group mt-5">
                    <label for="formFileMultiple" id="upload-file" class="form-label lab">Upload File </label>
                    <input type="file" class="filepond" id="upload-f-p" name="file" multiple
                        aria-describedby="fileDescriptionSize,fileDescriptionformat"  data-allow-reorder="true"
                        data-max-file-size="500MB" />
            
                    <small id="fileDescriptionSize" class="form-text text-muted hidden text-muted-u"
                        style="color: rgb(249 3 3) !important">The maximum file size is 500 MB.</small>
                    <br>
                    <small id="" class="form-text text-muted hidden text-muted-u"
                        style="color: rgb(249 3 3) !important">
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                     </small>
                    <input type="hidden" name="file_name" id="file_path">
                </div>
                <button type="submit" class="quiz-submit-btn" id="quiz-submit-btn"> Send reply</button>
            </form>
            @else
             <p  class="quiz-question" id="already-participated" style="color: green">
                You have already participated in this contest </p>
            @endif
               
      
         @else
       <a href="{{ route('login') }}"  class="button-c" id="quiz-Not-Auth">
        To participate in the contest, please log in to your account. </a>
       @endif
      

       
</section>







<!--==================== COLLECTION ====================-->
<section class="collection section" id="collection" dir="ltr" >
    <div class="collection__container container">
        <div class="collection__explore">
            <div class="collection__data-men">
                <h2 class="collection__title" id="">
                    {{ $lastProducts->name }}
                    {{-- Types of  <br>
                    artificial intelligence --}}
                </h2>
                {{-- <a href="#" class="button__link" id="button__link_1">
                    More<i class="ri-arrow-right-fill"></i>
                </a> --}}

                <a href="{{ route('view_product',['id'=>$lastProducts->id]) }}" class="button__link view" >
                    <span class="view">
                        View<i class="ri-arrow-right-fill"></i>
                    </span>
                   
                </a>
            </div>
            <img src="{{ asset('Images/Product/Images/'.$lastProducts->image ) }}" alt="collection image" >
        </div>
        <div class="collection__explore">
            <img src="{{ asset('Images/Product/Images/'.$twoLastProducts->image ) }}" alt="collection image">
            <div class="collection__data-women">
                <h2 class="collection__title" id="">
                    {{ $twoLastProducts->name }}
                </h2>
              
                <a href="{{ route('view_product',['id'=>$twoLastProducts->id]) }}" class="button__link">
                    <span class="view">
                        View<i class="ri-arrow-right-fill"></i>
                    </span>
                </a>
              
            </div>
            
        </div>
    </div>
</section>

<!--=============== TESTIMONIALS ===============-->
<section class="testimonial section" dir="ltr">
    <h2 class="section__title" id="section__title_">Our programmers</h2>

    <div class="testimonial__container container swiper">
        <div class="swiper-wrapper">
            <div class="testimonial__card swiper-slide">
                <img src="images/testimonial2.png" alt="" class="testimonial__img">

                <h3 class="testimonial__name" id="testimonial__name_1">zahra azizi</h3>
                <p class="testimonial__description" id="testimonial__description_1">
                    A programmer with more than 10 years <br> of experience in the field of various applications,<br>
                     as well as a business startup <br> consultant in the fields of programming.
                </p>
            </div>
            <div class="testimonial__card swiper-slide">
                <img src="images/testimonial3.png" alt="" class="testimonial__img">
                
                <h3 class="testimonial__name" id="testimonial__name_2">tahere yari</h3>
                <p class="testimonial__description" id="testimonial__description_2">
                    Web programmer in the back-end part  with php language and also a lot  of experience working  in freelance
                </p>
            </div>
            
            <div class="testimonial__card swiper-slide">
                <img src="images/testimonial1.png" alt="" class="testimonial__img">
                
                <h3 class="testimonial__name" id="testimonial__name_3">javid shams</h3>
                <p class="testimonial__description" id="testimonial__description_3">
                    A programmer with more than 10 years of experience in the field of various applications and also has a brilliant work experience at Microsoft.
                </p>
            </div>
           

            
        </div>

        <div class="swiper-pagination"></div>
    </div>
</section>


<!--==================== BRANDS ====================-->
<section class="brand section">
    <h2 class="section__title" id="brands">
        Brands that trusted us
    </h2>
    <div class="brand__container container grid">
        <img src="images/logo1.png" alt="logo image" class="brand__img">
        <img src="images/logo2.png" alt="logo image" class="brand__img">
        <img src="images/logo3.png" alt="logo image" class="brand__img">
        <img src="images/logo4.png" alt="logo image" class="brand__img">  
    </div>
</section>

<!--=============== CONTACT ===============-->
<section class="contact section" id="contact">
    
    <h2 class="section__title" id="contact-me">Contact Us</h2>
    <div class="contact__container container grid">
        <div class="contact__content">
            <h3 class="contact__title" id="contact__title">Talk to us</h3>

            <div class="contact__info">
                <div class="contact__card">
                    <i class='bx bx-mail-send contact__card-icon'></i>
                    <h3 class="contact__card-title" id="email">Email</h3>
                    <a href=""><span class="contact__card-data">{{ $site->email }}</span>
                    </a>
                    {{-- <a href="mailto:examplemail@correo.com" target="_blank" class="contact__button" id="contact__button">
                        Write me <i class='ri-arrow-right-fill contact__button-icon' ></i>
                    </a> --}}
                </div>

                <div class="contact__card">
                    <i class='bx bxl-whatsapp contact__card-icon' ></i>
                    <h3 class="contact__card-title" id="instagram">Instagram</h3>
                  <a href="https://www.instagram.com/{{ $site->instagram }}">  <span class="contact__card-data">{{ $site->instagram }}</span></a>

                    {{-- <a href="" target="_blank" class="contact__button" id="contact__button_">
                        Write me <i class='bx bx-right-arrow-alt contact__button-icon' ></i>
                    </a> --}}
                </div>

                <div class="contact__card">
                    <i class='bx bxl-whatsapp contact__card-icon' ></i>
                    <h3 class="contact__card-title" id="tweeter">Tweeter</h3>
                    <a href=""><span class="contact__card-data">{{ $site->tweeter }}</span></a>

                    {{-- <a href="" target="_blank" class="contact__button" id="contact__button_">
                        Write me <i class='bx bx-right-arrow-alt contact__button-icon' ></i>
                    </a> --}}
                </div>

                <div class="contact__card">
                    <i class='bx bxl-messenger contact__card-icon'></i>
                    <h3 class="contact__card-title" id="telegram">Telegram</h3>
                    <a href="https://web.telegram.org//{{ $site->telegram }}"><span class="contact__card-data">{{ $site->telegram }}</span></a>

                    {{-- <a href="https://m.me/bedimcode" target="_blank" class="contact__button" id="contact__button_1">
                        Write me <i class='bx bx-right-arrow-alt contact__button-icon' ></i>
                    </a> --}}
                </div>
            </div>
        </div>
        <div class="contact__content">
            <h3 class="contact__title" id="contact__titlee">Write me your comments</h3>

            <form action="{{ route('contact_us') }}" method="POST" enctype="multipart/form-data"  class="contact__form">
                @csrf
                <div class="contact__form-div">
                    <label for="" class="contact__form-tag" id="names">Names</label>
                    <input type="text" name="name" placeholder="Insert your name" id="names-p" class="contact__form-input" required>
                </div>

                <div class="contact__form-div">
                    <label for="" class="contact__form-tag" id="mail">Mail</label>
                    <input type="email" name="email" placeholder="Insert your email" id="mail-1" class="contact__form-input" required>
                </div>

                <div class="contact__form-div contact__form-area">
                    <label for="" class="contact__form-tag" id="comment">Comments</label>
                    <input type="text"  class="contact__form-input" >
                    <textarea name="comment"  cols="30" rows="10" id="nazar" placeholder="Write your Comment" class="contact__form-input" required></textarea>
                </div>

                <button class="button" id="send">Send Message</button>
            </form>
        </div>
    </div>
</section>



<script>
      document.addEventListener('DOMContentLoaded', function() {

        const fileInputElement = document.querySelector('input[id="upload-f-p"]');
        FilePond.registerPlugin(
            FilePondPluginFileValidateType,
            FilePondPluginFileValidateType,
            FilePondPluginImagePreview,
            FilePondPluginFileEncode,
            FilePondPluginMediaPreview,
            FilePondPluginFileValidateSize
            );
        filePond  = FilePond.create(fileInputElement);

        filePond.setOptions({
        // acceptedFileTypes: ['application/zip', 'application/x-rar-compressed'], 
            maxFileSize: '500MB', 
            instantUpload: false,
            // fileValidateTypeLabelExpectedTypesMap: {
            //     'application/zip': '.zip',
            //     'application/x-rar-compressed': '.rar',
                
            // },
            fileValidateTypeLabelExpectedTypes: 'فقط فایل‌های با فرمت‌های مجاز (rar, zip) پذیرفته می‌شوند.',
            labelFileTypeNotAllowed: 'فرمت فایل معتبر نیست.',
            labelMaxFileSizeExceeded: 'اندازه فایل بیش از حد مجاز است.',
            labelMaxFileSize: 'حداکثر اندازه فایل: {filesize}',
            server: {
            
                process: {
                    url: 'upload-file-answer',
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
                    url: 'delete-filePond-answer',
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
                fetch('delete-filePond-answer', {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ file_name: fileName,directory: 'Files/CompetetionAnswers/' })
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