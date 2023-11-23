@extends('restaurant.user.layouts.master')

@section('title')
    search-order
@endsection


@section('body')
<div class="p-5">   
    

    @if($data->isEmpty())
        <div class="row text-center">
            <div class="col-lg-3"></div>             

            <div class="col-lg-5">
                <div class="card border-0">
                    <img src="admin/images/nodata-found.png" alt="Image" class="img-fluid">
                    <div class="card-body">
                        <h5 class="card-title font text-warning h2">No Data Found!!!</h5>
                        <a href="{{ route('order.history') }}" class="btn btn-outline-warning">Go Back</a>
                        <p class="card-text"><small class="text-muted">McDonald's</small></p>
                    </div>
                </div>  
            </div>

            <div class="col-lg-3"></div>                     
                        
        </div>

    @else

        <h1 class="mb-4 fw-bolder text-warning font">Order History</h1>
        <!--===== Search bar start =====-->    
        <div class="search-container">
            <div class="input-box rounded-pill">
                <i class="mdi mdi-magnify"></i>
                <form action="{{ route('search.order') }}" method="get"> <!--search ar jonno amra get method ee use kori--->
                    <input type="text" class="text-warning" name="search" placeholder="Search here..." required/>
                    <button class="button border-0"><a type="submit" class="btn btn-outline-warning rounded-pill">Search</a></button>
                </form>
                
            </div>
        </div>  
        <!--===== Search bar End =====--> 

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
                    <div class="table-responsive mt-4" style="width: 100%">

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
                            <th scope="col" class="profile-edit" style="font-size: 1.3rem">Ordered At</th>                         
                            <th scope="col" class="profile-edit" style="font-size: 1.3rem">Delivered At</th>                         
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $d)
                            <tr>
                                <td>
                                    <img src="Food_images/{{ $d->food_image }}" alt="">
                                </td> 

                                <td>{{ $d->food_name }}</td>   
                                <td>${{ $d->price }}</td>                                        
                                <td>{{ $d->quantity }}</td>                                        
                                <td>${{ $d->price  *  $d->quantity }}</td>                                        
                                <td>{{ $d->payment}}</td> 
                                
                                @if($d->order_status == 'processing')
                                <td>Your Order Is Under Processing</td> 
                                @elseif($d->order_status == 'placed') 
                                <td>Your Food is Delivered</td>
                                @else
                                <td>Your Food Is On The Way</td>   
                                @endif 

                                <td>{{ $d->created_at }}</td>   
                                
                                @if($d->order_status == 'placed')
                                <td>{{ $d->updated_at }}</td>
                                @else
                                <td> - </td>  
                                @endif  
                                
                                                                        
                                                                    
                            </tr>

                            @endforeach
                                                
                            
                        </tbody>
                        </table>
                        <!---Pagination degine--->
                        <div class="row m-2 pt-3">
                            {{ $data->appends(request()->query())->links('pagination::bootstrap-5') }}
                        </div>
                    
                    </div>
                </div>
            </div>             
        </div>       

    @endif

</div>
@endsection