@extends('restaurant.user.layouts.master')

@section('title')
    food-cart
@endsection

@section('body')
 
    <div class="container my-5">
        <h1 class="mb-4">Food Cart</h1>
        <div class="row">
            <div class="col-lg-8">
                <div class="card mb-3">
                    <img src="Food_images/1698852336.jpg" class="card-img-top img-thumbnail" alt="Product Image">
                    <div class="card-body">
                        <h5 class="card-title">Bugger</h5>
                        <p class="card-text">A cheeseburger is a hamburger with a slice of melted cheese asdf artyer atya hhrew</p>
                        <p class="card-text"><strong>Price: $30</strong></p>
                        <div class="input-group mb-3">
                            <button class="btn btn-outline-warning" type="button" id="decreaseQuantity">-</button>
                            <input type="text" class="form-control text-center bg-dark" value="1" min="1"  id="quantity" readonly>
                            <button class="btn btn-outline-warning" type="button" id="increaseQuantity">+</button>
                        </div>
                        <button class="btn btn-danger">Remove</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Cart Summary</h5>
                        <p class="card-text">Total Items: <span id="totalItems">1</span></p>
                        <p class="card-text">Total Price: <span id="totalPrice">$30</span></p>
                        <a href="#" class="btn btn-primary">Order</a>
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
        totalPrice.textContent = '$' + (currentQuantity * 30).toFixed(2); ///// ai toFixed(2) ar kaj hocche amader amader doshomik ar pore 2ta number dekhabe karon amra amader toFixed() function ar moddhe 2 bole diyechi
    }
</script>
@endsection