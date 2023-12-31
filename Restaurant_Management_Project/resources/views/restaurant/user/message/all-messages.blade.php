@extends('restaurant.user.layouts.master')

@section('title')
    all-messages
@endsection


@section('body')    

   @if ($specificUserAllMessages->isEmpty())
        <div class="p-5">
            <div class="row text-center">
                <div class="col-lg-3"></div>             
    
                <div class="col-lg-5">
                    <div class="card border-0">
                        <img src="admin/images/nodata-found.png" alt="Image" class="img-fluid">
                        <div class="card-body">
                            <h5 class="card-title font text-warning h2">No Data Found!!!</h5>
                            <a href="{{ route('dashboard') }}" class="btn btn-outline-warning">Go To Dashboard</a>
                            <p class="card-text"><small class="text-muted">McDonald's</small></p>
                        </div>
                    </div>  
                </div>
    
                <div class="col-lg-3"></div>                     
                            
            </div>
        </div>
   @else    
 

<div class="container mt-3">
        <h1 class="mb-4 fw-bolder text-warning font">All Messages</h1>
        <!--===== Search bar start =====-->    
        <div class="search-container">
            <div class="input-box rounded-pill">
                <i class="mdi mdi-magnify"></i>
                <form action="{{ route('message.search') }}" method="get"> <!--search ar jonno amra get method ee use kori--->
                    <input type="text" class="text-warning" name="search" placeholder="Search here..." required/>
                    <button class="button border-0"><a type="submit" class="btn btn-outline-warning rounded-pill">Search</a></button>
                </form>
                
            </div>
        </div>  
        <!--===== Search bar End =====--> 

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
            

        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div class="card mb-3 border-0">
                    <div class="table-responsive mt-4 " style="width: 100%">

                        <table class="table"> 
                        <thead>
                            <tr>
                            
                                <th scope="col" class="profile-edit" style="font-size: 1.3rem">From</th>
                                <th scope="col" class="profile-edit" style="font-size: 1.3rem">To</th>
                                <th scope="col" class="profile-edit" style="font-size: 1.3rem">Message</th>
                                <th scope="col" class="profile-edit" style="font-size: 1.3rem">Sent</th>                          
                                <th scope="col" class="profile-edit" style="font-size: 1.3rem"></th>                        
                                <th scope="col" class="profile-edit" style="font-size: 1.3rem">Action</th>                        
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($specificUserAllMessages as $data)
                                <tr>                        

                                    <td>{{ $authUser->name }}</td>   
                                    <td>Admin</td>                                        
                                    <td>{{ $data->message }}</td>                                        
                                    <td>{{ $data->created_at }}</td>                                        
                                    <td>{{ \Carbon\Carbon::parse($data->created_at)->diffForHumans() }}</td>   <!--\Carbon\Carbon::parse($message->created_at)->diffForHumans() ai ta amader messages table ar created_at column take 10 min ago 20min ago aivabe dekhabe jar jonno ami akta package use korechi check Readme.md-------->
                                    <td>
                                        <a href="{{ route('edit.message',$data->id) }}" class="btn btn-primary">Edit</a>
                                        <button type="button" class="btn btn-danger delete-message-button" data-message-id="{{ $data->id }}">Delete</button>
                                    </td>                                                            
                                                                        
                                </tr>

                            @endforeach
                                                
                            
                        </tbody>
                        </table>
                        <!----Pagination degine--->
                        <div class="row m-2 pt-3">
                            {{ $specificUserAllMessages->links('pagination::bootstrap-5') }}
                        </div>
                    
                    </div>
                </div>
            </div>             
        </div>    


        <!--======= Remove Confirmation Pop Up Modal ========-->

        <div class="modal" id="confirmMessageDeletionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title text-warning font" style="font-size: 1.7rem" id="confirmUserDeletionModalLabel ">Delete Confirmation</h5>            
                    </div>
                    <div class="modal-body">
                    <span class="text-danger">Are you sure you want to delete this message?</span>

                        <div class="text-muted mt-4">
                            Please press on Delete button to confirm you would like to permanently delete this Message from your Message records. 
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                    <button id="cancelButton" type="button" class="btn btn-outline-light rounded-pill" data-dismiss="modal">Cancel</button>
                    <a  class="btn btn-outline-danger rounded-pill">Delete</a>
                    </div>
                </div>
                </div>
            </div>

        <!--====== END Remove Confirmation Pop Up Modal ======--> 

   @endif


</div>
@endsection


@section('custom_js')

<!--====== This script is for Confirm Deletion modal pop up ======-->
<script>
    $(document).ready(function() {
        $('.delete-message-button').on('click', function() {
            var messageId = $(this).data('message-id');
            var modal = $('#confirmMessageDeletionModal');
            modal.find('a.btn-outline-danger').attr('href', '/messageDelete' + messageId); ///// jokhon kew amar delete confirmation model ar moddhe jei delete button ache oi button aaa click korbe tokhon amader oi user ar id ta akhan theke pass hoye jabe amader route/web.php file ar moddhe /messageDelete{id}
            modal.modal('show');
        });

        $('#cancelButton').on('click', function() {
            $('#confirmMessageDeletionModal').modal('hide');
        });
    });
</script>


<!--============ This script is for Aleart auto close ==============-->
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