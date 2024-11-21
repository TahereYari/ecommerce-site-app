
@php
    use App\Models\BasketProduct;
    use App\Models\LicenseRecords;
@endphp
@extends('layout.home')

@section('content')


<section  class="new section" id="new">
    
        <div class="container1">
            <h3 class="work__title" id="">{{  $product->name }}</h3>
            <img src="{{ asset('Images/Product/Images/' .  $product->image ) }}" alt="{{ $product->image }}" class="product-image">
        
            <div class="video-container">
                <video controls>
                    <source src="{{ asset('Images/Product/Videos/' . $product->video ) }}" type="">
                   
                </video>
            </div>
        @if (Auth::user())
                @php
                    $userId = Auth::user()->id;
                    $hasPurchased = BasketProduct::whereHas('basket', function($query) use ($userId) {
                                                    $query->where('user_id', $userId)->where('is_pay', 1);
                                                })->where('product_id', $product->id)->exists();
                @endphp
                @if ($product->free==1 || $hasPurchased)
                    <a href="{{ asset('Images/Product/Files/' . $product->file ) }}" class="download-link" download id="download">Download
                        the program file</a>
                @endif
               
        @endif
           
        @if ($product->license == 1)
        <div class="license-list">
            <h3 id="product-licence">Product Licences</h3>
            <ul>
                @foreach ($licenses as $license )
                <li class="license-item">
                    <span class="license-duration " >{{ $license->type }} 
                        <span class="month">Month</span>
                    </span>
                    {{-- <span id="month">Month</span> --}}
                    <span class="license-cost" >{{ number_format($license->cost)  }} 
                        <span class="rial">Rial</span>
                    </span>
                    <a href="{{route('cartInsert',[
                                'user_id'=>auth()->user()->id ,
                                'product_id' =>$product->id,
                                'license_id'=>$license->id
                            ]) }}">
                        <button class="button-buy add-to-cart buy" name="add-to-cart">Buy<i class="ri-shopping-basket-fill"></i></button>
                    </a>
                </li>
                
                @endforeach
            
            </ul>
        </div>
    
        @else
            @if ($product->free == 0)
            <div class="price-container">
                <span id="product-price">Product Price :</span>
                <span >{{ number_format($product->price) }} 
                    <span class="rial">Rial</span>
                </span>
            </div>
            @else
            <div class="price-container">
                <span id="product-price">Product Price :</span>
                <span > 
                    <span class="free">Free</span>
                </span>
            </div>
                
            @endif
      
        @endif
        
            
        </div>
   
</section>

@endsection