@extends('layout.home')

@section('content')


<!--==================== NEW ====================-->
<section class="new section" id="new">
    <h2 class="section__title" id="all_product">
       All Products
    </h2>
    <div class="new__container container grid">
        @foreach ($allProducts as $products)
        <div class="work__card mix web">
            <img src="{{asset('images/Product/Images/'.$products->image)  }}" alt="" class="work__img">

            <h3 class="work__title" id="">{{ $products->name }}</h3>

            <div>
            

             
                <div class="product">
                    <a href="{{ route('view_product',['id'=>$products->id]) }}" class="services__button view" id="view1">
                        View  <i class='ri-arrow-right-fill services__icon' ></i>
                    </a>
                    <h3 class="work__title" id="" >
                        <span class="free">Free</span>
                    </h3>
                  

                </div>
            

                
            </div>
            <br>
            @if (Auth::user())
            <a href=""><button class="button-buy add-to-cart buy"  name="add-to-cart">Buy<i class="ri-shopping-basket-fill"></i></button></a>
            @endif
            
        </div>
        @endforeach
        {{-- <a href=""><button class="button-buy add-to-cart" id="all_product" name="add-to-cart">All Product</button></a> --}}
       
    </div>
         
</section>





@endsection