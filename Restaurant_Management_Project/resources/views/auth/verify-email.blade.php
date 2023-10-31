@extends('restaurant.layouts.master')

@section('title')
McDonald's-VerifyEmail
@endsection



@section('body')

 
    <section class="vh-200 " style="background-image: url(assets/img/background.png)">
        <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11">
            <div class="card text-black" style="border-radius: 25px;">
                <div class="card-body p-md-5">
                <div class="row justify-content-center">
                    <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1 p-5 mt-lg-5">
                         
                        <!--======= FLASH MESSAGE =========-->

                        @if (session('status') == 'verification-link-sent')

                        <!----(i have used bootstrap5 aleart to show our FLASH MESSAGE)---->
                        <!-----(tickmark icon)----->
                        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                            <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                              <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                            </symbol>                           
                         </svg>
                            
                            <!--(aleart)-->
                            <div class="auto-close alert alert-warning d-flex align-items-center" role="alert">
                                <svg class="bi flex-shrink-0 me-2 text-success" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                                <div>
                                    A new verification link has been sent successfully to the email.
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                              </div>
                        @endif
                       <!--======= END FLASH MESSAGE =========-->

                     <h2 class="text-center fw-bold h1 mb-2 mx-1 mx-md-4 mt-2">Varify Your<span style="color: #ffb03b">Email</span></h2> 
    

                     <!--========= RESEND VARIFICATION EMAIL ==========-->

                     <form method="POST" action="{{ route('verification.send') }}" class="mx-1 mx-md-4">
                        @csrf
    
                        <p class="text-center pt-3 fst-italic text-muted">Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.</p>
    
                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                            <button type="submit" class="book-a-table-btn scrollto border-0">Resend Verification Email</a>
                        </div>
    
                    </form>

                     <!--========= END RESEND VARIFICATION EMAIL ==========-->


                     <!--======== LOGOUT =========-->

                     <form method="POST" action="{{ route('logout') }}" class="mx-1 mx-md-4">
                        @csrf

                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">   
                            <button type="submit" class="book-a-table-btn scrollto border-0">
                                Log Out
                            </button>

                        </div>    
                         

                     </form>
                     
                     <!--======== END LOGOUT =========-->
    
                    </div>
                    <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
    
                    <img src="assets/img/mail2.png"
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


<!--========== HERE I ADD A CUSTOM JS WITH MY restaurant/layouts/master.blade.php FILE(i have added this js for my aleart auto close) ======-->

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
