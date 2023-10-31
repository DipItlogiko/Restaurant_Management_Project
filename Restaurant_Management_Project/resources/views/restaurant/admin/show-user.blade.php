@extends('restaurant.admin.layouts.master')
@section('title')
show-user
@endsection
@section('body')
<section style="background-color: #191c24">
<div class="container">
   <div class="row d-flex justify-content-center align-items-center ">
      <div class="col-lg-12 col-xl-11">
         <div class="card text-light border-0 mt-lg-5" style="border-radius: 25px;">
            <div class="card-body p-md-5">
               <div class="row justify-content-center">
                  <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
                     <h2 class="text-center fw-bold h1 mb-2 mx-1 mx-md-4 mt-2 profile-edit" style="color: #ffb03b" >User <span class="text-light">Info</span></h2>
                     <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                           <div class="text-center mt-1 ">
                              <img class="rounded-circle border border-warning" width="200" height="200" src="Users_images/{{ $user->image }}" alt="admin image">
                           </div>
                        </div>
                     </div>
                     @if ($user->user_type == '1')
                      <p class="text-center mb-2 mx-1 mx-md-4 mt-1 text-muted font" style="font-size: 1.2rem">Admin of McDonald's Restaurant</p>
                     @else
                      <p class="text-center mb-2 mx-1 mx-md-4 mt-1 text-muted font" style="font-size: 1.2rem">User of McDonald's Restaurant</p>
                     @endif 

                     <h4 class="text-bold text-center pt-2 font">Name : <span class="text-muted font">{{ $user->name }}</span></h4>

                     @if ($user->user_type == '1')
                      <h4 class="text-bold text-center font">UserType : <span class="text-muted">Admin</span></h4>
                     @else
                      <h4 class="text-bold text-center font">UserType : <span class="text-muted">User</span></h4>
                     @endif 

                     <h4 class="text-bold text-center font">Email : <span class="text-muted">{{ $user->email }}</span></h4>
                     <h4 class="text-bold text-center font">Phon No : <span class="text-muted">{{ $user->number }}</span></h4>
                     <h4 class="text-bold text-center font">Address : <span class="text-muted">{{ $user->address }}</span></h4>
                     
                      
                     @if ($user->account_creator_role == 1)                       
                      <h4 class="text-bold text-center font">AccountCreatedBy : <span class="text-muted">{{ $user->account_created_by }}</span></h4>
                      <h4 class="text-bold text-center font">AccountCreatorRole : <span class="text-muted">Admin</span></h4>
                     @else
                     <h4 class="text-bold text-center font">AccountCreatedBy : <span class="text-muted">User</span></h4>
                     @endif  
                      

                     @if ($user->email_verified_at == '')
                      <h4 class="text-bold text-center font">EmailVarifiedAt : <span class="text-muted">Not Verified</span></h4>
                     @else
                      <h4 class="text-bold text-center font">EmailVarifiedAt : <span class="text-muted">{{ $user->email_verified_at }}</span></h4>
                     @endif 

                     <h4 class="text-bold text-center font">CreatedAccountAt : <span class="text-muted">{{ $user->created_at }}</span></h4>
                     <h4 class="text-bold text-center font">UpdatedAccountAt : <span class="text-muted">{{ $user->updated_at }}</span></h4>
                  </div>
                  <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                     <img src="admin/images/showUser.png"
                        class="img-fluid" alt="Sample image">
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
</div>
@endsection