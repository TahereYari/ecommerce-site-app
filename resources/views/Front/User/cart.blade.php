@extends('Front.User.user')

@section('content')

<section class="h-100 h-custom">
    <div class="container h-100 py-5">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col">
          @if ($basket)
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col" class="h5" id="product_name">Product Name</th>
                      <th scope="col" id="category">Category</th>
                      {{-- <th scope="col" id="quantity">Quantity</th> --}}
                      <th scope="col" id="price">Price</th>
                      <th scope="col" id=""></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($basketProducts as $basketProduct)
                    <tr>
                        <th scope="row">
                          <div class="d-flex align-items-center">
                            <img src="{{ asset('Images/Product/Images/'.$basketProduct->product->image) }}" class="img-fluid rounded-3" style="width: 120px;" alt="">
                            <div class="flex-column ms-4" style="margin-right: 25px;">
                              <p class="mb-2" id="">{{ $basketProduct->product->name }}</p>
                              {{-- <p class="mb-0" id="made">Custom made</p> --}}
                            </div>
                          </div>
                        </th>
                        <td class="align-middle">
                          <p class="mb-0" style="font-weight: 500;" id="">{{ $basketProduct->product->category()->name }}</p>
                        </td>
                    
                        <td class="align-middle">
                          <p class="mb-0" style="font-weight: 500;">{{ number_format($basketProduct->price) }}</p>
                        </td>
                        
                        <td class="align-middle">
                         
                         <a href="{{ route('cartDelete',['basket_id'=>$basket->id , 'basketproduct_id'=>$basketProduct->id]) }}"><i class="fa fa-trash" style="color: rgb(209, 8, 8)"></i></a>
                        </td>

                      </tr>
                    @endforeach
                  
                  
                  </tbody>
                </table>
              </div>
           </div>
            <div class="card-body">
              <div class="form-container">
                <div class="form-c">
                  <div class="product">
                    <label class="work__title" id="total_sum">Total Sum :</label>
                    <span>{{ number_format($basket->price) }} </span>
                    <span class="rial">Rial</span>
                    <hr>
            
                    <a href="{{ route('Checkout',['basket_id'=>$basket->id]) }}" class="btn btn-primary" id="pay" style="width: 100%">Pay</a>
                    {{-- <input type="submit" value="Apply" id="submit-c" class="input-submit"> --}}
                  </div>
            
                </div>
              </div>
            </div>
          @else
          <span style="font-size: 50px; text-align:center" id="empty_shopping" >Your shopping cart is empty.</span>
          @endif      
      </div>
    </div>
</section>
  


 


@endsection