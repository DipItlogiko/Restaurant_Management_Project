@extends('restaurant.user.layouts.master')

@section('title')
    food-cart
@endsection

@section('body')
 
    <div class="container my-5">
        <h1 class="mb-4 fw-bolder text-warning font">Food Cart</h1>
        <div class="row">
            <div class="col-lg-4">
                <div class="card mb-3 border-0">
                    <img src="Food_images/{{ $specificFood->image }}" class="card-img-top img-thumbnail" alt="Product Image" style="width: auto; height:225px; ">
                    <div class="card-body">
                        <h5 class="card-title fw-bold text-warning">{{ $specificFood->title }}</h5>
                        <p class="card-text text-muted font" style="font-size: 1.2rem;">{{ $specificFood->description }}</p>
                        <p class="card-text"><strong class="font h1">${{ $specificFood->price }}</strong></p>

                      <form action="{{ route('store.cart',$specificFood->id) }}" method="POST"> <!-----akhane ami amar form ar value gulo amader store.cart name route ar moddhe pathiye diyechi ai route ta amra route/web.php ar moddhe likhechi..and oi route ar moddhe amra aikhan theke amader food ar id ta pass korchi.---> 
                        @csrf
                        <div class="input-group mb-3">
                            <button class="btn btn-outline-warning" type="button" id="decreaseQuantity">-</button>                         
                            <input type="text"  name="quantity" class="form-control text-center bg-dark" value="1" min="1"  id="quantity" readonly>
                            <button class="btn btn-outline-warning" type="button" id="increaseQuantity">+</button>
                        </div>
                        <div class="mt-5">
                            <a href="{{ url('/') }}" class="btn btn-danger rounded-pill p-2 px-3 font" style="font-size: 1.2rem;">Remove</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card text-lg-center border-0">
                    <div class="card-body">                     
                        <h5 class="card-title text-warning h3 font">Cart Summary</h5>                            
                            <p class="card-text">Total Items: <span id="totalItems">1</span></p>
                            <p class="card-text">Total Price: <span id="totalPrice">${{ $specificFood->price }}</span></p>
                            <button type="submit" class="btn btn-warning bg-warning rounded-pill p-2 px-3 font" style="font-size: 1.2rem;">Add To Cart</button>  
                      </form>  
                        
                    </div>
                </div>
            </div>
        </div>
    </div> 
 

@endsection

@section('custom_js')
<script>
    // Quantity adjustment buttons
    const decreaseQuantityBtn = document.getElementById('decreaseQuantity');
    const increaseQuantityBtn = document.getElementById('increaseQuantity');
    const quantityInput = document.getElementById('quantity');
    const totalItems = document.getElementById('totalItems');
    const totalPrice = document.getElementById('totalPrice');

    let currentQuantity = 1;

    decreaseQuantityBtn.addEventListener('click', () => {
        if (currentQuantity > 1) {
            currentQuantity--;
            updateQuantityAndPrice();
        }
    });

    increaseQuantityBtn.addEventListener('click', () => {
        currentQuantity++;
        updateQuantityAndPrice();
    });

    function updateQuantityAndPrice() {
        quantityInput.value = currentQuantity;
        totalItems.textContent = currentQuantity;
        totalPrice.textContent = '$' + (currentQuantity * {{ $specificFood->price }}).toFixed(2); ///// ai toFixed(2) ar kaj hocche amader amader doshomik ar pore 2ta number dekhabe karon amra amader toFixed() function ar moddhe 2 bole diyechi
    }
</script>
@endsection