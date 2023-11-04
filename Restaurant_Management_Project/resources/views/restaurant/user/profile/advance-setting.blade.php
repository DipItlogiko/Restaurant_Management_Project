@extends('restaurant.user.layouts.master')

@section('title')
    User-AdvanceSettings
@endsection

@section('body')

<section style="background-color: #191c24">
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-lg-12 col-xl-11">
                <div class="card text-light border-0 mt-lg-5" style="border-radius: 25px;">
                    <div class="card-body p-md-5">
                        <div class="row justify-content-center">
                            <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
                                
                                <!--======Flash Message =====-->

                                @if ($errors->userDeletion->has('password'))

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
                                       
                                            {{ $errors->userDeletion->first('password') }}
                                         
                                        <button type="button" class="btn-close text-right" style="margin-left: auto" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>

                                    
                               @endif
                               
                               <!--=======End Flash Message ======-->

                                <h2 class="text-center fw-bold h1 mb-2 mx-1 mx-md-4 mt-2 profile-edit" style="color: #ffb03b">Delete Account</h2>
                                <div class="d-flex flex-row align-items-center mb-4">
                                    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                    <div class="form-outline flex-fill mb-0">
                                        <div class="text-center pb-2">
                                            <img class="rounded-circle border border-warning" width="120" height="120" src="Users_images/{{ $authUser->image }}" alt="admin image">
                                        </div>
                                    </div>
                                </div>
                                <p class="text-center mb-2 mx-1 mx-md-4 mt-2 text-muted">Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.</p>

                                <form method="post" action="{{ route('profile.destroy') }}" class="mx-1 mx-md-4">
                                    @csrf
                                    @method('delete')

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <input type="text" name="name" class="form-control text-warning" value="{{ old('name', $authUser->name) }}" style="background-color: #2a3038" readonly />
                                            <label class="form-label" for="name">Name</label>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <input type="email" name="email" class="form-control text-warning" value="{{ old('email',$authUser->email) }}" style="background-color: #2a3038" readonly />
                                            <label class="form-label">Email</label>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                        <button id="deleteAccountButton" data-toggle="modal" data-target="#confirmUserDeletionModal" style="background-color: #fc424a; border-radius: 40px;" class="text-light p-2 px-3 btn-danger" type="button">Delete Account</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                                <img src="admin/images/delete3.png" class="img-fluid" alt="Sample image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Delete Pop UP with password field -->
<div class="modal" id="confirmUserDeletionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="deleteAccountForm"  method="post" action="{{ route('profile.destroy') }}" class="p-6">
                @csrf
                @method('delete')

                <div class="modal-header">
                    <h3 class="modal-title text-lg font-medium text-warning">
                        Are you sure you want to delete your account?
                    </h3>
                </div>

                <div class="modal-body">
                    <p class="mt-1 text-sm text-muted">
                        Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.
                    </p>

                    <div class="mt-6">
                        <label for="password" class="sr-only">Password</label>
                        <input required name="password" type="password" class="form-control mt-1 text-warning" placeholder="Enter your password" />

                        @if ($errors->userDeletion->has('password'))
                            <div class="text-danger">
                                {{ $errors->userDeletion->first('password') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="modal-footer">
                    <button id="cancelButton" type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger bg-danger"> Delete </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('custom_js')
<script>  

    document.getElementById('deleteAccountButton').addEventListener('click', function () {
        $('#confirmUserDeletionModal').modal('show');
    });  

    document.getElementById('cancelButton').addEventListener('click', function () {
        $('#confirmUserDeletionModal').modal('hide');
    });

</script>

 
 

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
