@extends('restaurant.admin.layouts.master')

@section('title')
    search-chef
@endsection


@section('body')
<div class="p-3">
    
    @if($chefs->isEmpty()) <!----akhane ami check korechi amader $chefs variable jeita amader SearchController.php theke ashche oi $chefs variable ta jodi empty hoy ba oi variable ar moddhe jodi kono data na thake tahole amader ai if ar moddhe thaka code ta execute hobe--> 
        
        <div class="row text-center">
            <div class="col-lg-3"></div>             

            <div class="col-lg-5">
                <div class="card border-0">
                    <img src="admin/images/nodata-found.png" alt="Image" class="img-fluid">
                    <div class="card-body">
                        <h5 class="card-title font text-warning h2">No Data Found!!!</h5>
                        <a href="{{ route('show.all.chefs') }}" class="btn btn-outline-warning">Go Back</a>
                        <p class="card-text"><small class="text-muted">McDonald's</small></p>
                    </div>
                </div>  
            </div>

            <div class="col-lg-3"></div>                     
                        
        </div>

    @else
    
            <h1 class=" fw-bolder text-warning font">Chefs Info</h1>   

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
            
            <!--===== Search bar start =====-->    
            <div class="search-container">
                <div class="input-box rounded-pill">
                    <i class="mdi mdi-magnify"></i>
                    <form action="{{ route('chef.search') }}" method="get"> <!--search ar jonno amra get method ee use kori--->
                        <input type="text" class="text-warning" name="search" placeholder="Search here..." required/>
                        <button class="button border-0"><a type="submit" class="btn btn-outline-warning rounded-pill">Search</a></button>
                    </form>
                    
                </div>
            </div>  
            <!--===== Search bar End =====-->              
            

            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="card mb-3 border-0">
                        <div class="table-responsive ">

                            <table class="table">
                            <thead>
                                <tr>
                                
                                <th scope="col" class="profile-edit" style="font-size: 1.3rem">Image</th>
                                <th scope="col" class="profile-edit" style="font-size: 1.3rem">Name</th>
                                <th scope="col" class="profile-edit" style="font-size: 1.3rem">Position</th>
                                <th scope="col" class="profile-edit" style="font-size: 1.3rem">Twitter</th>                          
                                <th scope="col" class="profile-edit" style="font-size: 1.3rem">Facebook</th>                          
                                <th scope="col" class="profile-edit" style="font-size: 1.3rem">LinkedIn</th>
                                <th scope="col" class="profile-edit" style="font-size: 1.3rem">Instagram</th>
                                <th scope="col" class="profile-edit" style="font-size: 1.3rem">Action</th>
                                 
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($chefs as $chef)
                                <tr>
                                    <td>
                                        <img src="Chefs_images/{{ $chef->image }}" alt="">
                                    </td> 

                                    <td>{{ $chef->name }}</td>   
                                    <td>{{ $chef->position }}</td>                                        
                                    <td>{{ $chef->twitter }}</td>                                        
                                    <td>{{ $chef->facebook}}</td>                                        
                                    <td>{{ $chef->linkedin}}</td>                                        
                                    <td>{{ $chef->instagraam}}</td>                             
                                                                    
                                    <td>
                                        <a href="{{ route('admin.edit.chef', $chef->id) }}" class="btn btn-info">Edit</a>
                                        <button class="btn btn-danger delete-chef-button" data-chef-id="{{ $chef->id }}">Delete</button>
                                    </td>                                        
                                </tr>

                                @endforeach
                                                    
                                
                            </tbody>

                            
                            </table>
                            <!--Pagination degine-->
                            <div class="row m-2 pt-3">
                                {{ $chefs->appends(request()->query())->links('pagination::bootstrap-5')}} <!----akhane amader pagination digine ar sathe appends(request()->query()) aita add korar karon hocche amader resources/views/restaurant/admin/chef/all-chefs.blade.php ar moddhe jei search bar ta ache oi search bar ar moddhe kew jodi eemon kono kichu diye search dei ja amader all-chefs.blade.php file ar moddhe 7 barer beshi ache tahole amader oi data theke 7 ta 7 ta kore data ak ak page aa dekhabe karon amader ai search ar theke jokhon datata ashche amader searchController.php theke oikhane ami paginate(7) bole diyechi jar mane hocche amader search queary korar pore jei koita data pabe oi data guloke ak ak page ar moddhe 7 ta kore dekhabe..and niche jai pagination ar number gulo thakbe oi number gulote press korle kaj korbe and jodi amra appends(request()->query()) aita na likhi tahole amader search bar moddhe jei data diye search kora hobe oi data ta amader SearchController.php ar moddhe giye paginage hoye amader ai page ar moddhe chole ashbe and database pagination ar digine ta oo dekhabe kintu jokhon ami pagination ar number ar moddhe click korbo tokhon amader click korar por kaj hobe na jodi aita na likhi to aita lekhar r akta karon hocche amader resources/views/restaurant/admin/chef/all-chefs.blade.php ar moddhe amader pagination kora ache and oikhane akta search bar ache oi search bar ar moddhe kono value diye search korle oi value ta jodi amader oonek bar thake tahole search korar pore amader oi data ta aabar pagination ar sathe show korbe tai--->
                            </div>
                             
                        
                        </div>
                    </div>
                </div>             
            </div>             

            <!--======= Delete Confirmation Pop Up Modal ========-->

            <div class="modal" id="confirmChefDeletionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title text-warning font" style="font-size: 1.7rem" id="confirmUserDeletionModalLabel ">Delete Confirmation</h5>            
                        </div>
                        <div class="modal-body">
                        <span class="text-danger">Are you sure you want to Delete this Chef information?</span>

                            <div class="text-muted mt-4">
                                Once this chef info is Deleted, all of it's resources and data will be permanently delete. Please press on Delete button to confirm you would like to permanently Delete this Chef info from your Chefs records. 
                            </div>
                        </div>
                        
                        <div class="modal-footer">
                        <button id="cancelButton" type="button" class="btn btn-outline-light rounded-pill" data-dismiss="modal">Cancel</button>
                        <a  class="btn btn-outline-danger rounded-pill">Delete</a>
                        </div>
                    </div>
                    </div>
                </div>    
                <!--====== END Delete Confirmation Pop Up Modal ======--> 
    
    @endif      
</div> 
@endsection

@section('custom_js')
<!--===== This script is for Delete confirmation Pop Up Modal =====-->
<script>
    $(document).ready(function() {
        $('.delete-chef-button').on('click', function() {
            var chefId = $(this).data('chef-id');
            var modal = $('#confirmChefDeletionModal');
            modal.find('a.btn-outline-danger').attr('href', '/deleteChef' + chefId); ///// jokhon kew amar delete confirmation model ar moddhe jei delete button ache oi button aaa click korbe tokhon amader oi user ar id ta akhan theke pass hoye jabe amader route/web.php file ar moddhe /deleteChef{id}
            modal.modal('show');
        });

        $('#cancelButton').on('click', function() {
            $('#confirmChefDeletionModal').modal('hide');
        });
    });
</script>
  <!--======= This script is for Aleart auto close ======-->
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