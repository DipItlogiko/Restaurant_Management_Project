@extends('restaurant.admin.layouts.master')

@section('title')
    all-orders
@endsection

@section('body')
<div class="container my-5">   
    

        <h1 class="mb-4 fw-bolder text-warning font">Customer's Order</h1>

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
         

        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div class="card mb-3 border-0">
                    <div class="table-responsive mt-4">

                        <table class="table">
                        <thead>
                            <tr>
                            
                            <th scope="col" class="profile-edit" style="font-size: 1.3rem">Image</th>
                            <th scope="col" class="profile-edit" style="font-size: 1.3rem">Food Name</th>
                            <th scope="col" class="profile-edit" style="font-size: 1.3rem">Price</th>
                            <th scope="col" class="profile-edit" style="font-size: 1.3rem">Quantity</th>                          
                            <th scope="col" class="profile-edit" style="font-size: 1.3rem">Total Price</th>                          
                            <th scope="col" class="profile-edit" style="font-size: 1.3rem">Payment</th>
                            <th scope="col" class="profile-edit" style="font-size: 1.3rem">Status</th>
                            <th scope="col" class="profile-edit" style="font-size: 1.3rem">C.Name</th>
                            <th scope="col" class="profile-edit" style="font-size: 1.3rem">Address</th>
                            <th scope="col" class="profile-edit" style="font-size: 1.3rem">Number</th>
                            <th scope="col" class="profile-edit" style="font-size: 1.3rem">Ordered At</th>
                            <th scope="col" class="profile-edit" style="font-size: 1.3rem">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach($ordersTable as $data)
                            <tr>
                                <td>
                                    <img src="Food_images/{{ $data->food_image }}" alt="">
                                </td> 

                                <td>{{ $data->food_name }}</td>   
                                <td>${{ $data->price }}</td>                                        
                                <td>{{ $data->quantity }}</td>                                        
                                <td>${{ $data->price  *  $data->quantity }}</td>                                        
                                <td>{{ $data->payment}}</td>                                        
                                <td>{{ $data->order_status}}</td>                                        
                                <td>{{ $data->name}}</td>                                        
                                <td>{{ $data->user_address}}</td>                                        
                                <td>{{ $data->number}}</td>                                        
                                <td>{{  $data->created_at  }}</td>                                        
                                <td>
                                    <a href="#" class="btn btn-info">Edit</a>
                                    <a href="#" class="btn btn-danger">Delete</a>
                                </td>                                        
                            </tr>

                            @endforeach
                                                
                            
                        </tbody>
                        </table>
                    
                    </div>
                </div>
            </div>             
        </div>



        <div class="row mt-5">
            <div class="col-lg-12 col-sm-12">
                <div class="card text-lg-right border-0">
                    <div class="card-body mt-4">                     
                        <h5 class="card-title text-warning h3 font">Order Summary</h5>                            
                        <p class="card-text">Total Order: {{ $totalOrder }} </p>
                        <p class="card-text">Total Order in Process: {{ $TotalOrderInProcess }}  </p>
                        <p class="card-text">Total Order Placed: {{ $TotalOrderPlaced }} </span></p>
                        <p class="card-text">Order on the way: {{ $OrderOnTheWay }} </span></p>
                        <p   class="text-muted font" style="font-size: 1.2rem;">McDonald's</p>  
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

   
   
</div> 
@endsection