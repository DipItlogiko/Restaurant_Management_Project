@extends('restaurant.admin.layouts.master')

@section('title')
    edit-food
@endsection

@section('body')
<section class="vh-99">
    <div class="container h-100">
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

                 <h2 class="text-center fw-bold h1 mb-2 mx-1 mx-md-4 mt-2 text-light font">Edit<span style="color: #ffb03b">Food</span></h2> 

                 <form  method="POST" action="{{ route('admin.updated.food.store',$food->id) }}" class=" mx-md-4" enctype="multipart/form-data">
                    @csrf
                    @method('patch')


                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                            <div class="card border-2 border-dark" style="width: auto;">
                                <img class="card-img-top" style="height: 250px;" src="/Food_images/{{$food->image}}" alt="Card image cap">  <!--/Food_images/ ai folder ta amader laravel application ar public directory ar moddhe create kora ache r $food->image mane hocche amader data base ar oi record ar moddhe image field ar moddhe jei image ar nam ta ache oi image ar nam ta akhane chole ashbe---->                               
                            </div> 
                        </div>
                    </div>

                    <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                        <span class="text-danger">
                            @error('name')
                                {{ $message }}
                            @enderror
                        </span>
                        <input type="text" id="form3Example1c" name="name" value="{{ old('name',$food->title) }}" class="form-control text-warning" required/>
                        <label class="form-label text-light" for="form3Example1c">Food Name</label>
                    </div>
                    </div>
                   


                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                            <span class="text-danger">
                                @error('image')
                                    {{ $message }}
                                @enderror
                            </span>
                            <input type="file" id="form3Example3c" name="image"  class="form-control text-warning"/>
                            <label for="image" class="form-label text-light" for="form3Example3c">Image</label>
                        </div>
                    </div>

                    <!-- Dropdown input field -->
                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-list fa-lg me-3 fa-fw "></i>
                        <div class="form-outline flex-fill mb-0">
                            <span class="text-danger">
                                @error('food_type')
                                    {{ $message }}
                                @enderror
                            </span>

                            
                            <select id="form3Example3c" name="food_type" value="{{ old('food_type',$food->food_type) }}" class="form-select text-warning form-control" required>                                         
                                
                                @if($food->food_type == 'salads')

                                    <option value="salads">Salads</option>
                                    <option value="fastfood">Fast Food</option>                                                                        
                                    <option value="sushi">Sushi</option> 

                                @elseif($food->food_type == 'fastfood')

                                    <option value="fastfood">Fast Food</option>                                                                        
                                    <option value="salads">Salads</option>
                                    <option value="sushi">Sushi</option>

                                @else
                                    <option value="sushi">Sushi</option>
                                    <option value="fastfood">Fast Food</option>                                                                        
                                    <option value="salads">Salads</option>

                                @endif 

                            </select>
                            
                            <label for="food_type" class="form-label text-light" for="form3Example3c">Select Food Type</label>
                        </div>
                    </div>

                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                            <span class="text-danger">
                                @error('price')
                                    {{ $message }}
                                @enderror
                            </span>
                            <input type="text" id="form3Example3c" name="price" value="{{ old('price',$food->price) }}" class="form-control text-warning" required/>
                            <label for="price" class="form-label text-light" for="form3Example3c">price</label>
                        </div>
                    </div>

                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                            <span class="text-danger">
                                @error('description')
                                    {{ $message }}
                                @enderror
                            </span>                           
                            <textarea id="form3Example3c" name="description" class="form-control text-warning" required>{{ old('description',$food->description) }}</textarea>
                            <label for="description" class="form-label text-light" for="form3Example3c">Description</label>
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
     
</section>

</div>
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