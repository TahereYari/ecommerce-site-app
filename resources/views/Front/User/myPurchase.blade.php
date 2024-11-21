@php
    use App\Models\BasketProduct;
    use App\Models\LicenseRecords;
@endphp

@extends('Front.User.user')

@section('content')
    <style>
        .card-header {
        background-color: #f8f9fa;
        padding: 10px 15px;
        cursor: pointer;
        }
        
        .card-header h4 {
        margin: 0;
        display: inline-block;
        }
        
        .card-body {
        padding: 15px;
        }
        
        ul {
        list-style-type: none;
        padding: 0;
        }
        
        li {
        padding: 10px 0;
        border-bottom: 1px solid #eee;
        }
        
        .fa-chevron-down {
        transition: transform 0.3s;
        }
        
        .collapse.show .fa-chevron-down {
        transform: rotate(180deg);
        }
        .card-header h4 {
        flex: 1;
        margin: 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
        }
        
        .card-header .btn {
        margin-left: 20px; /* Adjust as needed */
        }
        
        .card-header span {
        display: inline-block;
        }
        .product-item {
        margin-bottom: 10px; /* Adds space between list items */
        list-style-type: none; /* Removes default list styling */
        
        }
        
        .product-name {
            font-weight: bold;
            margin-right: 20px; /* Adds space between name and price */
        }
        
        .product-price {
        font-weight: bold; /* Optional: makes the price stand out */
        margin-right: 20%;
        font-weight: bold;
        
        }
        
        .license-type {
            font-weight: bold;
            margin-left: 10px; /* Adds space between price and license type */
             margin-right: 20%;
        }
        .invoice-container {
        width: 70%;
        margin: 50px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        
        h1 {
        font-size: 24px;
        margin-bottom: 20px;
        text-align: center;
        }
        
        .invoice-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
        }
        
        .invoice-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
        }
        
        .invoice-table th, .invoice-table td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: center;
        }
    </style>

<div class="container mt-5">
    <h2 id="myPurchase">My shopping list</h2>
    @foreach($baskets as $basket)
    <div class="card mt-3">
        <div class="card-header d-flex justify-content-between align-items-center" id="heading-{{ $basket->id }}">
            <h4 class="mb-0 d-flex justify-content-between w-100">
                <span>
                    <span class="mr-3 invoice_number"> InvoiceNumber : </span>&nbsp;{{ $basket->invoiceNumber }}
                </span>
                
                <span>
                    <span class="total_amount"> Total amount: </span>
                    <span>{{ number_format($basket->price) }} <span class="rial">Rial</span></span>
                </span>
                
                
            </h4>
            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#products-{{ $basket->id }}"
                aria-expanded="false" aria-controls="products-{{ $basket->id }}">
                <i class="fa fa-chevron-down"></i>
            </button>
        </div>
        <div id="products-{{ $basket->id }}" class="collapse">
        
            <div class="invoice-container">
                {{-- <h1>فاکتور خرید</h1> --}}
                <div class="invoice-header">
                    <p>
                        <span class="date">Date:</span>
                        <span class="card-subtitle mb-2 text-muted" id="" data-timestamp="{{ $basket->created_at->toIso8601String() }}">
                            {{
                            app()->getLocale() == 'fa' ?
                            verta($basket->created_at)->format('Y/m/d') :
                            $basket->created_at->format('Y-m-d')
                            }}
                        </span>
                    </p>
                    <p>
                        <span class="invoice_number"></span><span>&nbsp;{{ $basket->invoiceNumber }}</span>
                    </p>
                   
                </div>
                <table class="invoice-table">
                  
                    <thead>
                        <tr>
                            <th class="image" >Image</th>
                            <th class="product_name">Product Name</th>
                            <th class="price">Price</th>
                             <th class="lice-type">License Type</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                      @php
                     $basketProducts = BasketProduct::where('basket_id',$basket->id)->get();
                    @endphp
                    
                        @foreach($basketProducts as $basketProduct)
                    @php
                        $product = $basketProduct->product;
                        $licenseRecord = LicenseRecords::whereHas('license', function ($query) use ($product) {
                        $query->where('product_id', $product->id);
                        })->where('user_id', auth()->user()->id)
                        ->where('basket_id', $basket->id)
                        ->first();
                    @endphp
                        <tr>
                            <td>
                                @if ($basketProduct->product->image!=null)
                                    <img src="{{ asset('Images/Product/Images/'.$basketProduct->product->image) }}" style="width: 50%" alt="Not Available" class="product-img">
                                @endif
                               
                            </td>
                            <td>
                               
                                <span style="font-weight: 400 !important">{{ $basketProduct->product->name }}</span>
                            </td>
                            <td>
                                
                                <span style="font-weight: 400 !important">{{ number_format($basketProduct->price)}}&nbsp;<span
                                        class="rial">Rial</span></span>
                            </td>
                           
                                <td>
                                    @if ($licenseRecord)
                                    <span style="font-weight: 400 !important">{{$licenseRecord->license->type }}</span>
                                    @else
                                    <span style="font-weight: 400 !important">----</span>
                                    @endif
                                </td>
                           
                        </tr>
                    @endforeach   
                    </tbody>
                </table>
                <div class="total">
                    <p>
                        <span class="total_amount"> Total amount: </span>
                        <span>{{ number_format($basket->price) }} <span class="rial">Rial</span></span>
                    </p>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>


<script>



document.addEventListener('DOMContentLoaded', function() {
    var headers = document.querySelectorAll('.card-header');

    headers.forEach(function(header) {
        header.addEventListener('click', function() {
            var button = header.querySelector('button');
            var targetId = button.getAttribute('data-target');
            var target = document.querySelector(targetId);

            if (target.classList.contains('show')) {
                target.classList.remove('show');
            } else {
                target.classList.add('show');
            }
        });
    });
});



</script>
@endsection