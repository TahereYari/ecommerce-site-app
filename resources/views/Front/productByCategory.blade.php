@php
    // use App\Models\Site;
    // $site =Site::orderByDesc('created_at')->first();
    use App\Models\BasketProduct;
    use App\Models\LicenseRecords;
@endphp
@extends('layout.home')

@section('content')


<!--==================== NEW ====================-->
<section class="new section" id="new">
    <h2 class="section__title" id="">
        {{ $category->name }}
    </h2>
    <div class="new__container container grid">
        {{-- @if ($products != null) --}}
            @foreach ($products as $product)
                <div class="work__card mix web">
                    <img src="{{asset('images/Product/Images/'.$product->image)  }}" alt="" class="work__img">
                     <h3 class="work__title" id="">{{ $product->name }}</h3>
                    <div>                   
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
                    </div>
                    <br>
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
                @if ($product->license == 1)
                    <a href="{{ route('view_product',['id'=>$product->id]) }}">
                        <button class="button-buy add-to-cart buy" name="add-to-cart">Buy<i class="ri-shopping-basket-fill"></i></button>
                    </a>
                    @else
                        <a href="{{ route('cartInsert',['user_id'=>auth()->user()->id , 'product_id' =>$product->id]) }}">
                        <button class="button-buy add-to-cart buy" name="add-to-cart">Buy<i class="ri-shopping-basket-fill"></i></button>
                        </a>
                    @endif
                @endif
            @endif
            
                    
                </div>
            @endforeach
        {{-- @else
       
        <div class="work__card mix web">
            <div>
                <div class="product">
                    <h3 class="work__title" id="message-for-category">
                        There is no product for this category.
                     </h3>
                </div>        
            </div>
        </div>
      
        @endif --}}
  
    
    </div>
         
</section>





@endsection