@extends('restaurant.admin.layouts.master')

@section('title')
    Admin-AdvanceSettings
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

                    <!--======= FLASH MESSAGE =========-->
                    @if (session('status'))

                        <!----(i have used bootstrap5 aleart to show our FLASH MESSAGE)---->
                        <!-----(tickmark icon)----->
                        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                            <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                            </symbol>                           
                        </svg>

                        <!-- (Bootstrap 5 alert) -->
                        <div class="alert alert-warning d-flex justify-content-between align-items-center auto-close" role="alert">
                            <div>
                            <!-- (Your success icon here) -->
                            <svg class="bi flex-shrink-0 me-2 text-success" width="24" height="24" role="img" aria-label="Success:">
                                <use xlink:href="#check-circle-fill"/>
                            </svg>
                            {{ session('status') }}
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                   <!--======= END FLASH MESSAGE =========-->

                 <h2 class="text-center fw-bold h1 mb-2 mx-1 mx-md-4 mt-2 profile-edit" style="color: #ffb03b" >Delete Account</h2> 
                 <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                        
                        <div class="text-center pb-2">
                           <img class="rounded-circle border border-warning" width="120" height="120" src="Users_images/{{ $authUser->image }}" alt="admin image">
                        </div>
                    </div>
                 </div>    
                  <p class="text-center mb-2 mx-1 mx-md-4 mt-2 text-muted">Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.
                </p>
                 
                   
                 
                   
                 <form  class="mx-1 mx-md-4">
                     
                                               
                       

                        <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                             
                            <input type="text" name="name" class="form-control text-warning"  value="{{ old('name', $authUser->name) }}" style="background-color: #2a3038"  readonly/>
                            <label class="form-label" for="name">Name</label>
                            
                        </div>
                        </div>

                        <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                             
                            <input type="email" name="email"  class="form-control text-warning" value="{{ old('email',$authUser->email) }}" style="background-color: #2a3038" readonly/>
                            <label class="form-label" >Email</label>
                        </div>
                        </div>                    

                         

                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">          
                            
                            <button data-bs-toggle="modal"  data-bs-target="#confirm-user-deletion-modal" style="background-color: #fc424a; border-radius: 40px;" class="text-light p-2 px-3 btn-danger">Delete Account</button>
                             
                        </div>

                        <!--========= Delete Pop UP with password field ========-->
                        <div class="modal" id="confirm-user-deletion-modal">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
                                        @csrf
                                        @method('delete')
                    
                                        <h2 class="modal-title text-lg font-medium text-gray-900 dark-text-gray-100">
                                            Are you sure you want to delete your account?
                                        </h2>
                    
                                        <p class="modal-body mt-1 text-sm text-gray-600 dark-text-gray-400">
                                            Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.
                                        </p>
                    
                                        <div class="mt-6">
                                            <label for="password" class="sr-only">Password</label>
                                            <input
                                                id="password"
                                                name="password"
                                                type="password"
                                                class="form-control mt-1 w-75"
                                                placeholder="Password"
                                            />
                    
                                            @if($errors->userDeletion->has('password'))
                                                <p class="text-danger text-sm">{{ $errors->userDeletion->first('password') }}</p>
                                            @endif
                                        </div>
                    
                                        <div class="mt-6 d-flex justify-content-end">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    
                                            <button type="submit" class="btn btn-danger ml-3">
                                                Delete Account
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                </form>

               </div>
                <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                <img src="admin/images/Reset password-pana.png"
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