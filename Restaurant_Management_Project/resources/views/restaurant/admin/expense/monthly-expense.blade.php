@extends('restaurant.admin.layouts.master')

@section('title')
    monthly-expense
@endsection

@section('body')
<div class="container">
    <div class="row d-flex justify-content-center align-items-center ">
        <div class="col-lg-12 col-xl-11">
        <div class="card text-light border-0 mt-lg-5" style="border-radius: 25px;">
            <div class="card-body p-md-5">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1 mt-lg-5 pt-lg-5">    
                
                 <!--==== Flash Message ====-->

                    @if (session('status'))

                    <!----(i have used bootstrap5 aleart to show our FLASH MESSAGE)---->
                    <!-----(triangle icon)----->
                    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                        <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                        </symbol>                           
                    </svg>
                        
                        <!--(aleart)-->
                        <div class="auto-close alert alert-danger d-flex align-items-center" role="alert">
                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                            <div>
                                {{ session('status') }}
                            </div>
                            <button type="button" class="btn-close" style="margin-left: auto"  data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        
                    @endif

                 <!--==== End Flash Message ====-->   

                 <h2 class="text-center fw-bold h1 mb-2 mx-1 mx-md-4 mt-2 mt-lg-3 profile-edit" style="color: #ffb03b" >Monthly Expense</h2> 
                  <p class="text-center mb-2 mx-1 mx-md-4 mt-2 text-muted">Get Monthly Expenses PDF</p>
                   
                 
                   
                 <form method="post" action="{{ route('monthly.pdf') }}" class="mx-1 mx-md-4" enctype="multipart/form-data">
                    @csrf                                         

                        <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                            <span class="text-danger">
                                @error('month')
                                    {{ $message }}
                                @enderror
                            </span>
                            <input type="text" id="form3Example3c" name="month" value="{{ old('month')}}" class="form-control text-warning" required/>
                            <label class="form-label" for="form3Example3c">Month</label>
                            
                        </div>
                        </div>

                        <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                            <span class="text-danger">
                                @error('year')
                                    {{ $message }}
                                @enderror
                            </span>
                            <input type="text" name="year" value="{{ old('year') }}" id="form3Example4c" class="form-control text-warning" required/>
                            <label class="form-label" for="form3Example4c">Year</label>
                        </div>
                        </div>                                                   

                         <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                            
                            <button type="submit" style="background-color: #ffb03b; border-radius: 40px;" class="text-light p-2">Get PDF</button>

                            
                         </div>

                </form>

               </div>
                <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                <img src="admin/images/MonthlyExpense.png"
                    class="img-fluid" alt="Sample image">
                     

                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
    </div>
@endsection

@section('custom_js')
    <!--========== This script is for Aleart auto close ==========-->

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