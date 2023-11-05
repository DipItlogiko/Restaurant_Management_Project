@extends('restaurant.user.layouts.master')

@section('title')
    show-cart
@endsection

@section('body')
<div class="container my-5">
    <h1 class="mb-4 fw-bolder text-warning font">All Carts</h1>
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
                          
                        @foreach($data as $data)                         
                          <tr>          
                              
                                <td>
                                    <img src="Food_images/{{ $data->image }}" class="img-thumbnail d-sm-none d-md-block" alt="Product Image" style="width: 225px; height: 225px;"> 
                                </td>
                  
                                <td>{{ $data->title }}</td>
                                <td>${{ $data->price }}</td>
                                <td id="quantity">{{ $data->quantity }}</td>
                  
                  
                                <td>                                    
                                   <button class="btn btn-danger remove-cart-button" data-food-id="{{ $data->user_id }}">Remove</button> 
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
                        <button type="submit" class="btn btn-warning bg-warning rounded-pill p-2 px-3 font" style="font-size: 1.2rem;">Order Now</button>  
                  </form>  
                    
                </div>
            </div>
        </div>
    </div>


    <!--======= Remove Confirmation Pop Up ========-->

<div class="modal" id="confirmUserDeletionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title text-warning font" style="font-size: 1.7rem" id="confirmUserDeletionModalLabel ">Confirm Removing</h5>            
            </div>
            <div class="modal-body">
               <span class="text-danger">Are you sure you want to remove this food from your cart?</span>

                <div class="text-muted mt-4">
                    Once this food is removed, all of it's resources and data will be permanently removed. Please press on Remove button to confirm you would like to permanently remove this food from your cart. 
                </div>
            </div>
            
            <div class="modal-footer">
            <button id="cancelButton" type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <a  class="btn btn-danger">Remove</a>
            </div>
        </div>
        </div>
    </div>

<!--====== END Remove Confirmation Modal ======-->
</div> 
@endsection


@section('custom_js')
      <!--====== This script is for Confirm Deletion modal pop up ======-->
    <script>
        $(document).ready(function() {
            $('.remove-cart-button').on('click', function() {
                var foodId = $(this).data('food-id');
                var modal = $('#confirmUserDeletionModal');
                modal.find('a.btn-danger').attr('href', '/deleteCart' + foodId); ///// jokhon kew amar delete confirmation model ar moddhe jei delete button ache oi button aaa click korbe tokhon amader oi user ar id ta akhan theke pass hoye jabe amader route/web.php file ar moddhe /adminDeleteUser{id}
                modal.modal('show');
            });

            $('#cancelButton').on('click', function() {
                $('#confirmUserDeletionModal').modal('hide');
            });
        });
    </script>
@endsection