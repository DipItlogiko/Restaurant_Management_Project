@extends('restaurant.admin.layouts.master')

@section('title')
    change-password
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
                        <div class="auto-close alert alert-warning d-flex justify-content-between align-items-center auto-close" role="alert">
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

                 <h2 class="text-center fw-bold h1 mb-2 mx-1 mx-md-4 mt-2 profile-edit" style="color: #ffb03b" >Change Password</h2> 
                 <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                        
                        <div class="text-center pb-2">
                           <img class="rounded-circle border border-warning" width="120" height="120" src="Users_images/{{ $authUser->image }}" alt="admin image">
                        </div>
                    </div>
                 </div>    
                  <p class="text-center mb-2 mx-1 mx-md-4 mt-2 text-muted">Ensure your account is using a long, random password to stay secure.</p>
                 
                   
                 
                   
                 <form method="post" action="{{ route('password.update') }}" class="mx-1 mx-md-4">
                    @csrf
                    @method('put')       
                    
                       

                        <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                            <span class="text-danger">                    
                                        
                                @foreach ($errors->updatePassword->get('current_password') as $error) {{--amra ai validation error take ai vabe show koriyechi karon amra amader ai form ar input field ar value gulo validate korechi app/Http/Controllers/Auth/passwordController.php ar moddhe oi khane amara validation korar jonno akta bag use korechi jar nam ami oikhane diyechi updatePassword ai vag ar moddhe amader sob  validation error gulo ache and ai bag theke ami amader ai current_password field ar validation error take show koriyechi---}}
                                       {{ $error }}
                                @endforeach                       
                               
                            </span>
                            <input type="password" id="current_password" name="current_password" class="form-control text-warning" autocomplete="current-password"  required/>
                            <label class="form-label" for="current_password">Current Password</label>
                            
                        </div>
                        </div>

                        <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                            <span class="text-danger">
                                @foreach ($errors->updatePassword->get('password') as $error) 
                                       {{ $error }}
                                @endforeach
                            </span>
                            <input type="password" name="password" id="form3Example4c" class="form-control text-warning" autocomplete="new-password" required/>
                            <label class="form-label" for="form3Example4c">New Password</label>
                        </div>
                        </div>


                        <div class="d-flex flex-row align-items-center mb-4">
                            <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                            <div class="form-outline flex-fill mb-0">
                                <span class="text-danger">
                                    @error('password_confirmation')
                                      {{ $message }}
                                    @enderror
                                </span>
                                <input type="password" name="password_confirmation" id="form3Example4c" class="form-control text-warning" autocomplete="new-password"/>
                                <label class="form-label" for="form3Example4c">Confirm Password</label>
                            </div>
                            </div>

                       

                         

                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                            
                            <button type="submit" style="background-color: #ffb03b; border-radius: 40px;" class="text-light p-2">Update</button>

                            
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

@section('custom_js')
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