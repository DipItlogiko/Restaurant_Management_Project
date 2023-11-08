@extends('restaurant.admin.layouts.master')

@section('title')
    edit-order-information
@endsection

@section('body') 
    <div class="container">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-lg-12 col-xl-11">
        <div class="card text-black border-0" >
            <div class="card-body p-md-5">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1 pt-md-4">

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
                        <div class="auto-close alert alert-success d-flex align-items-center" role="alert">
                            <svg class="bi flex-shrink-0 me-2 text-success" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                            <div>
                                {{ session('status') }}
                            </div>
                            
                            <button type="button" class="btn-close" style="margin-left: auto"  data-bs-dismiss="alert" aria-label="Close"></button>
                            
                        </div>
                    @endif
                  
                  <!--==== End Flash Message ====-->

                 <h2 class="text-center fw-bold h1 mb-2 mx-1 mx-md-4 mt-2 text-light font">Edit<span style="color: #ffb03b">Order</span></h2> 

                 <form  method="POST" action="#" class=" mx-md-4" enctype="multipart/form-data">
                    @csrf
                    @method('patch')


                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                            <div class="card border-2 border-dark" style="width: auto;">
                                <img class="card-img-top" style="height: 250px;" src="/Food_images/{{$specificOrder->food_image}}" alt="Card image cap">  <!--/Food_images/ ai folder ta amader laravel application ar public directory ar moddhe create kora ache r $food->image mane hocche amader data base ar oi record ar moddhe image field ar moddhe jei image ar nam ta ache oi image ar nam ta akhane chole ashbe---->                               
                            </div> 
                        </div>
                    </div>

                    <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">                         
                        <input type="text" id="form3Example1c" name="name" value="{{ old('name', $specificOrder->food_name) }}" class="form-control bg-dark text-warning" readonly/>
                        <label class="form-label text-light" for="form3Example1c">Food Name</label>
                    </div>
                    </div>
                   


                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">                             
                            <input type="text" id="form3Example1c" name="quantity" value="{{ old('quantity', $specificOrder->quantity) }}" class="form-control bg-dark text-warning" readonly/>
                            <label class="form-label text-light" for="form3Example1c">Quantity</label>
                        </div>
                        </div>

                    <!-- Dropdown input field -->
                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-list fa-lg me-3 fa-fw "></i>
                        <div class="form-outline flex-fill mb-0">
                            <span class="text-danger">
                                @error('orderstatus')
                                    {{ $message }}
                                @enderror
                            </span>

                            
                            <select id="form3Example3c" name="orderstatus" value="{{ old('orderstatus') }}" class="form-select text-warning form-control bg-dark" required>                                         
                                
                                @if($specificOrder->order_status == 'processing')

                                    <option value="processing">Processing</option>
                                    <option value="placed">Placed</option>                                                                        
                                    <option value="on the way">On The Way</option> 

                                @elseif($specificOrder->order_status == 'on the way')

                                    <option value="on the way">On The Way</option>                                                                        
                                    <option value="placed">Placed</option>
                                    <option value="processing">Processing</option>

                                @else
                                    <option value="placed">Placed</option>  
                                    <option value="on the way">On The Way</option>                                                                       
                                    <option value="processing">Processing</option>

                                @endif

                            </select>
                            
                            <label for="orderstatus" class="form-label text-light" for="form3Example3c">Order Status</label>
                        </div>
                    </div>

                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">                             
                            <input type="text" id="form3Example3c" name="price" value="{{ old('price', $specificOrder->price) }}" class="form-control bg-dark text-warning" readonly/>
                            <label for="price" class="form-label text-light" for="form3Example3c">Price</label>
                        </div>
                    </div>

                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">                             
                            <input type="text" id="form3Example3c" name="totalprice" value="{{ old('totalprice' , $specificOrder->quantity * $specificOrder->price ) }}" class="form-control bg-dark text-warning" readonly/>
                            <label for="totalprice" class="form-label text-light" for="form3Example3c">Total Price</label>
                        </div>
                    </div>

                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">                                                       
                            <textarea id="form3Example3c" name="address" class="form-control bg-dark text-warning" readonly>{{ old('address', $specificOrder->user_address) }}</textarea>
                            <label for="address" class="form-label text-light" for="form3Example3c">Address</label>
                        </div>
                    </div>      

                   
                    

                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                        <button  type="submit" style="background-color: #ffb03b; border-radius: 40px;" class="text-light p-2 px-3 btn-danger">Update</button>
                    </div>

                </form>

                </div>
                <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                <img src="admin/images/editFood.png"
                    class="img-fluid" alt="Sample image">  

                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
    </div>    
</section>

 
@endsection