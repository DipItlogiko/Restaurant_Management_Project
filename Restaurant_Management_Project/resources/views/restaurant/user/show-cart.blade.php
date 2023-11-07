@extends('restaurant.user.layouts.master')

@section('title')
    show-cart
@endsection

@section('body')

<div class="container my-5">
    <!--======== content will visible according condition =======-->

    @if($data == '[]')   <!------amader OrderController.php ar showCart() method theke je data variable ta ashche oi data variable take ami akhane check korechi jodi amader ai $data variable ta '[]' empty hoy tahole amader if ar moddhe jei code tuku ache oi code tuku execute hobe--->  

       <h1 class="mb-4 fw-bolder text-warning font">My Carts</h1>

        <div class="row text-center">
            <div class="col-lg-3"></div>             

            <div class="col-lg-5">
                <div class="card mt-5 border-0">
                    <img src="assets/img/cart0.png" alt="Image" class="img-fluid">
                    <div class="card-body">
                        <h5 class="card-title font text-warning h2">There Is No Item Here</h5>
                        <a href="{{ url('/') }}" class="btn btn-outline-warning">Buy Now</a>
                        <p class="card-text"><small class="text-muted">McDonald's</small></p>
                    </div>
                </div>  
            </div>

            <div class="col-lg-3"></div>                     
                        
        </div>
    
    @else  <!--jodi amader $data variable ta '[]' empty na hoy tahole oita aikhane chole ashbe else ar moddhe and else ar moddhe jei code ta ache ai code take execute korbe----->

        <h1 class="mb-4 fw-bolder text-warning font">My Carts</h1>

        <!--==== Flash Message ====-->

        @if (session('status'))

        <!----(i have used bootstrap5 aleart to show our FLASH MESSAGE)---->
        <!-----(tickmark icon)----->
        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
            </symbol>                           
        </svg>
            
            <!--(aleart)-->
            <div class="auto-close alert alert-success d-flex align-items-center" role="alert" class="mx-auto">
                <svg class="bi flex-shrink-0 me-2 text-success" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                <div>
                    {{ session('status') }}
                </div>
                
                <button type="button" class="btn-close" style="margin-left: auto"  data-bs-dismiss="alert" aria-label="Close"></button>
                
            </div>
        @endif

        <!--==== End Flash Message ====-->

        <!--====== Error Flash Message =====-->

        @if ($errors->has('address') || $errors->has('number') || $errors->has('payment_method') )   <!--akhane ami if condition diye check korechi jodi amader application ar moddhe $errors variable ar moddhe jodi address othoba number othoba payment_method ai field gulor akta te oo jodi validation error ashe tahole amader ai if ar moddher code ta kaj korbe and ai 'address' 'number' 'payment_method' hocche amar form ar field ar nam jei field guloke ami orderController.php ar moddhe validation korechi and || aita mane hocche or------>

        <!----(i have used bootstrap5 aleart to show our FLASH MESSAGE)---->
        <!-----(aleart icon)----->
        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
              </symbol>                         
        </svg>

           <!--(aleart)-->
            <div class="auto-close alert alert-danger d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2 text-danger" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#exclamation-triangle-fill"/></svg>
               
                    @if($errors->has('address'))
                      {{ $errors->first('address') }}

                    @elseif($errors->has('number'))
                        {{ $errors->first('number') }}                     

                    @else 
                       {{ $errors->first('payment_method') }}

                    @endif     
                <button type="button" class="btn-close text-right" style="margin-left: auto" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            
       @endif       
 
       
       <!--======= End Error Flash Message ======-->

        <div class="row">
            <div class="col-lg-9 col-sm-12">
                <div class="card mb-3 border-0">
                    <div class="table-responsive mt-4">

                        <table class="table">
                        <thead>
                            <tr>
                            
                            <th scope="col" class="profile-edit" style="font-size: 1.3rem">Image</th>
                            <th scope="col" class="profile-edit" style="font-size: 1.3rem">Food Name</th>
                            <th scope="col" class="profile-edit" style="font-size: 1.3rem">Price</th>
                            <th scope="col" class="profile-edit" style="font-size: 1.3rem">Quantity</th>                          
                            <th scope="col" class="profile-edit" style="font-size: 1.3rem">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!--====Form start from here ====-->
                         <form action="{{ route('order.store') }}" method="POST">
                              @csrf  

                            @foreach ($data as $cartData)
                                <tr>
                                    <td>
                                        <img src="Food_images/{{ $cartData->image }}" class="img-thumbnail d-sm-none d-md-block" alt="Product Image" style="width: 225px; height: 225px;">
                                        <input type="text" name="image[]" value="{{ $cartData->image }}" hidden> <!---akhane input name ar sathe jei [] array ta diyechi mane image[] ar mane hocche amader image[] ai array ar moddhe multiple data asthe pare tai image ar pore amra array [] diyechi --->
                                    </td>
                                    <td>{{ $cartData->title }}</td>
                                    <input type="text" name="food_name[]" value="{{ $cartData->title }}" hidden>

                                    <td>${{ $cartData->price }}</td>
                                    <input type="text" name="price[]" value="{{ $cartData->price }}" hidden>

                                    <td>{{ $cartData->quantity }}</td>
                                    <input type="text" name="quantity[]" value="{{ $cartData->quantity }}" hidden>
                                    <td>
                                        <button class="btn btn-danger remove-cart-button" data-cart-id="{{ $cartData->id }}">Remove</button>
                                    </td>
                                    
                                </tr>
                            @endforeach                        
                            
                        </tbody>
                        </table>
                    
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card text-lg-center border-0">
                    <div class="card-body mt-4">                     
                        <h5 class="card-title text-warning h3 font">Cart Summary</h5>                            
                        <p class="card-text">Total Items: {{ $sumOfItems }} </p>
                        <p class="card-text">Total Quantity: {{ $sumOfQuantity }} </p>
                        <p class="card-text">Total Price: ${{ $sumOfPrice }}</span></p>
                        <button type="button" class="order-confirm-button  btn btn-outline-warning rounded-pill p-2 px-3 font" style="font-size: 1.2rem;">Order Now</button>  
                    </div>
                </div>
            </div>
        </div>


        <!--======= Remove Confirmation Pop Up Modal ========-->

        <div class="modal" id="confirmUserDeletionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title text-warning font" style="font-size: 1.7rem" id="confirmUserDeletionModalLabel ">Remove Confirmation</h5>            
                    </div>
                    <div class="modal-body">
                    <span class="text-danger">Are you sure you want to remove this food from your cart?</span>

                        <div class="text-muted mt-4">
                            Once this food is removed, all of it's resources and data will be permanently removed. Please press on Remove button to confirm you would like to permanently remove this food from your cart. 
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                    <button id="cancelButton" type="button" class="btn btn-outline-light rounded-pill" data-dismiss="modal">Cancel</button>
                    <a  class="btn btn-outline-danger rounded-pill">Remove</a>
                    </div>
                </div>
                </div>
            </div>

        <!--====== END Remove Confirmation Pop Up Modal ======-->


        <!--======= Order Confirmation Pop Up Model========-->

        <div class="modal" id="confirmUserOrderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title text-warning font" style="font-size: 1.7rem" id="confirmUserDeletionModalLabel ">Order Confirmation</h5>            
                    </div>
                    <div class="modal-body">
                    <span class="text-muted">For confirming your order please fill belows information correctly:</span>

                        <div class="mt-4">
                                               
                                 
                            <div class="mb-2">                                 
                                <input type="text" id="form3Example1c" value="{{ old('name',$authUser->name) }}" class="form-control text-warning bg-dark" readonly/>
                                <label class="form-label text-light" for="form3Example1c">Name</label>
                            </div>

                            <div class="mb-2">
                                <span class="text-danger">
                                    @error('address')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <input type="text" id="form3Example1c" name="address" value="{{ old('address',$authUser->address) }}" class="form-control text-warning bg-dark" required/>
                                <label class="form-label text-light" for="form3Example1c">Address</label>
                            </div>

                            <div class="mb-2">
                                <span class="text-danger">
                                    @error('number')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <input type="text" id="form3Example1c" name="number" value="{{ old('number',$authUser->number) }}" class="form-control text-warning bg-dark" required/>
                                <label class="form-label text-light" for="form3Example1c">Number</label>
                            </div>

                            <div class="mb-2">
                                <span class="text-danger">
                                    @error('payment_method')
                                        {{ $message }}
                                    @enderror
                                </span>

                                <select id="form3Example3c" name="payment_method" class="form-select text-warning form-control bg-dark" required>                                         
                                    <option value="">Select</option>                                        
                                    <option value="CashOnDelevery">CashOnDelevery</option>
                                </select>
                                
                                <label for="payment_method" class="form-label text-light" for="form3Example3c">Payment Method</label>
                            </div>                                     
                            
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                        <button id="cancel" type="button" class="btn btn-outline-light rounded-pill" data-dismiss="modal">Cancel</button>
                       <button style="background-color: #000000" class="border-0 p-0"><a type="submit" class="btn btn-outline-warning rounded-pill">Confirm</a></button> 
                    </div>
                </form> 
                <!--==== Form end ====-->
                </div>
                </div>
            </div>

        <!--====== End Order Confirmation Pop Up Modal ======-->

    @endif    
   
</div> 

@endsection


@section('custom_js')
    <!--====== This script is for Remove Confirmation Pop Up ======-->
    <script>
        $(document).ready(function() {
            $('.remove-cart-button').on('click', function() {
                var cartId = $(this).data('cart-id');
                var modal = $('#confirmUserDeletionModal');
                modal.find('a.btn-outline-danger').attr('href', '/deleteCart' + cartId); ///// jokhon kew amar delete confirmation model ar moddhe jei delete button ache oi button aaa click korbe tokhon amader oi user ar id ta akhan theke pass hoye jabe amader route/web.php file ar moddhe /adminDeleteUser{id}
                modal.modal('show');
            });

            $('#cancelButton').on('click', function() {
                $('#confirmUserDeletionModal').modal('hide');
            });
        });
    </script>

    <!--======= This Script is for Order Confirmation Pop Up ========-->
    <script>
        $(document).ready(function() {
            $('.order-confirm-button').on('click', function() {                
               $('#confirmUserOrderModal').modal('show');               
            });

            $('#cancel').on('click', function() {
                $('#confirmUserOrderModal').modal('hide');
            });
        });
    </script>



  <!--====== This script is for Aleart auto close  ======-->

<script>

        // Get all elements with class "auto-close"
        const autoCloseElements = document.querySelectorAll(".auto-close");

        // Define a function to handle the fading and sliding animation
        function fadeAndSlide(element) {
        const fadeDuration = 500;
        const slideDuration = 500;
    
        // Step 1: Fade out the element
        let opacity = 1;
        const fadeInterval = setInterval(function () {
            if (opacity > 0) {
            opacity -= 0.1;
            element.style.opacity = opacity;
            } else {
            clearInterval(fadeInterval);
        // Step 2: Slide up the element
        let height = element.offsetHeight;
        const slideInterval = setInterval(function () {
            if (height > 0) {
            height -= 10;
            element.style.height = height + "px";
            } else {
            clearInterval(slideInterval);
            // Step 3: Remove the element from the DOM
            element.parentNode.removeChild(element);
            }
        }, slideDuration / 10);
        }
    }, fadeDuration / 10);
    }

    // Set a timeout to execute the animation after 5000 milliseconds (5 seconds)
    setTimeout(function () {
    autoCloseElements.forEach(function (element) {
        fadeAndSlide(element);
    });
    }, 5000);

</script>
@endsection