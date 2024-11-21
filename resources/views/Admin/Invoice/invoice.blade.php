@extends('layout.admin')

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
            margin-left: 20px;
            /* Adjust as needed */
        }
    
        .card-header span {
            display: inline-block;
        }
    
        .product-item {
            margin-bottom: 10px;
            /* Adds space between list items */
            list-style-type: none;
            /* Removes default list styling */
    
        }
    
        .product-name {
            font-weight: bold;
            margin-right: 20px;
            /* Adds space between name and price */
        }
    
        .product-price {
            font-weight: bold;
            /* Optional: makes the price stand out */
            margin-right: 20%;
            font-weight: bold;
    
        }
    
        .license-type {
            font-weight: bold;
            margin-left: 10px;
            /* Adds space between price and license type */
            margin-right: 20%;
        }
    </style>

<section class="middle">
    <div class="d-flex justify-content-end mb-4">

        {{-- <a href="{{ route('basket_create') }}" id="add-new-basket" class="btn btn-primary  btn-lg">
            Add New Product
        </a> --}}


    </div>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <table class="table align-middle mb-0 bg-white" id="example">
        <thead class="bg-light">
            <tr>
                <th id="t">date</th>
                <th id="invoice_number">Invoice Number</th>
                <th id="userName">UserName</th>
                <th id="email">Email</th>
                <th id="price">Price</th>
                <th id="view">View</th>



            </tr>
        </thead>
        <tbody id="tableBody">
            @foreach ($baskets as $basket)
            <tr>

                <td class="date-cell" data-timestamp="{{ $basket->created_at->toIso8601String() }}">

                    {{
                    app()->getLocale() == 'fa' ?
                    verta($basket->created_at)->format('Y/m/d') :
                    $basket->created_at->format('Y-m-d')
                    }}
                </td>
                <td>
                    <div class="ms-3">{{ $basket->invoiceNumber }}</div>
                </td>

                <td>
                    <div class="ms-3">{{ $basket->user()->name }}</div>
                </td>

                <td>
                    <div class="ms-3">{{ $basket->user()->email }}</div>
                </td>

                <td>
                    <div class="fw-normal mb-1">{{ number_format($basket->price )}}</div>
                </td>

                <td id="subs">
                    <a href="{{ route('get-basket-products',['basketId'=>$basket->id]) }}" type="button" class="btn btn-primary btn-sm  view" >
                        View
                    </a>



                </td>



            </tr>
            @endforeach

        </tbody>
    </table>

    {{-- <canvas id="chart" style="display: none;"></canvas> --}}

</section>





@endsection