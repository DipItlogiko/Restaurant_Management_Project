@extends('restaurant.admin.layouts.master')

@section('title')
    show-foods
@endsection

@section('body')
<div class="container">

    <h2 class="text-left fw-bold h1 mb-2 mx-1 mx-md-4 mt-2  profile-edit" style="font-size: 2.7rem; color: #ffb03b">All<span class="text-light">Foods</span></h2>

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

<div class="table-responsive mt-4">
  
  <table class="table">
    <thead>
      <tr>         
        <th scope="col" class="profile-edit" style="font-size: 1.3rem">Image</th>
        <th scope="col" class="profile-edit" style="font-size: 1.3rem">Food Name</th>
        <th scope="col" class="profile-edit" style="font-size: 1.3rem">Food Type</th>
        <th scope="col" class="profile-edit" style="font-size: 1.3rem">Price</th>
        <th scope="col" class="profile-edit" style="font-size: 1.3rem">Description</th>         
        <th scope="col" class="profile-edit" style="font-size: 1.3rem">Created_at</th>         
        <th scope="col" class="profile-edit" style="font-size: 1.3rem">Updated_at</th>         
        <th scope="col" class="profile-edit" style="font-size: 1.3rem">Action</th>         
      </tr>
    </thead>
    <tbody>
        
        @foreach ($Foods as $food) <!--Array [] ar value print korar jonno amra foreach ba forelse loop use kori...ai 2tar moddhe patthokkoo hocche jodi amra forelse loop use kori tahobe amra amader Array [] ar value print korar sathe sathe jodi amader Array [] ta emty thake tahole amra akta message set kore dite pari..kintu jodi amra foreach loop use kori tahole amader Array [] ta jodi emty ooo thake tahole amra kono message show korate parbo na kintu jodi amra forelse loop use kori tahole ai kajta korte parbo.. r ai foreach and forelse loop 2tai use hoy Array [] ar value print korar jonno------>
        
        <tr>          
            
              <td>
                <img  src="Food_images/{{ $food->image }}"  class="rounded-circle" width="40" height="40" /> <!--akhane Food_images/ ta hocche amader akta directory jei directory ta amara public directory ar moddhe create korechi amader Foods ar picture gulo rakhar jonno------->
              </td>

              <td>{{ $food->title }}</td>
              <td>{{ $food->food_type }}</td>               
              <td>{{ $food->price }}$</td>
              <td>{{ $food->description }}</td> 
              <td>{{ $food->created_at }}</td> 
              <td>{{ $food->updated_at }}</td> 

              
              <td>        
                <a href="{{ route('admin.food.edit', $food->id) }}" class="btn btn-info">Edit</a><!--akhane jokhon kew amader application ar Edit button a click korbe tokhon oi record ar id ta amra aikhane amader name route ar moddhe pass kore diyechi route('admin.food.edit', $food->id) ai vabe, amra chaile name route create na kore sorasori amader route ar url ar moddhe amader ai food id ta pass kore dite pari /foodEdit{{--$food->id --}} jei row ar ba record ar Edit button a click kora hobe oi record ar id ta amader ai url ar maddhome pass hoye jabe route ar moddehe ------->
                <button class="btn btn-danger delete-account-button" data-food-id="{{ $food->id }}" >Delete</button><!--akhane jokhon kew amader application ar Delete button a click korbe tokhon oi record ar id ta amra aikhane akta url create kore pass korediyechi /permanentDeleteUser{{--$user->id --}} jei row ar ba record ar Delete button a click kora hobe oi record ar id ta amader ai url ar maddhome pass hoye jabe route ar moddehe check routes/web.php ------->
                
              </td>
          </tr>

      @endforeach
       
    </tbody>
  </table>

</div>
<!--======= Delete Confirmation Pop Up Model========-->

<div class="modal" id="confirmUserDeletionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title text-warning font" style="font-size: 1.7rem" id="confirmUserDeletionModalLabel ">Confirm Deletion</h5>            
            </div>
            <div class="modal-body">
               <span class="text-danger">Are you sure you want to delete this Food from your Food Menu?</span>

                <div class="text-muted mt-4">
                    Once this Food is deleted, all of it's resources and data will be permanently deleted. Please press on Delete button to confirm you would like to permanently delete this Food from your Food Menu.
                </div>
            </div>
            
            <div class="modal-footer">
            <button id="cancelButton" type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <a  class="btn btn-danger">Delete</a><!--akhane jokhon kew amader application ar Delete button a click korbe tokhon oi record ar id ta amra aikhane akta url create kore pass korediyechi /permanentDeleteUser{{--$user->id --}} jei row ar ba record ar Delete button a click kora hobe oi record ar id ta amader ai url ar maddhome pass hoye jabe route ar moddehe check routes/web.php ------->


            </div>
        </div>
        </div>
    </div>

<!--====== END Delete Confirmation Modal ======-->
</div>
@endsection



@section('custom_js')  


<!--====== This script is for Confirm Deletion modal pop up ======-->
    <script>
        $(document).ready(function() {
            $('.delete-account-button').on('click', function() {
                var foodId = $(this).data('food-id');
                var modal = $('#confirmUserDeletionModal');
                modal.find('a.btn-danger').attr('href', '/deleteFood' + foodId); ///// jokhon kew amar delete confirmation model ar moddhe jei delete button ache oi button aaa click korbe tokhon amader oi user ar id ta akhan theke pass hoye jabe amader route/web.php file ar moddhe /adminDeleteUser{id}
                modal.modal('show');
            });

            $('#cancelButton').on('click', function() {
                $('#confirmUserDeletionModal').modal('hide');
            });
        });
    </script>


 <!--====== This script is for Aleart auto close  ======--> 
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
