@extends('restaurant.admin.layouts.master')

@section('title')
    search-user
@endsection


@section('body')
<div class="p-5">

    @if ($users->isEmpty())
        <div class="row text-center">
            <div class="col-lg-3"></div>             
            
            <div class="col-lg-5">
                <div class="card border-0">
                    <img src="admin/images/nodata-found.png" alt="Image" class="img-fluid">
                    <div class="card-body">
                        <h5 class="card-title font text-warning h2">No Data Found!!!</h5>
                        <a href="{{ route('admin.show.users') }}" class="btn btn-outline-warning">Go Back</a>
                        <p class="card-text"><small class="text-muted">McDonald's</small></p>
                    </div>
                </div>  
            </div>

            <div class="col-lg-3"></div>                     
                        
        </div>
    @else

            <h2 class="text-left fw-bold h1 mb-2 mx-1 mx-md-4 mt-2  profile-edit" style="font-size: 2.7rem">All<span style="color: #ffb03b">Users</span></h2>
            <!--===== Search bar start =====-->    
            <div class="search-container">
            <div class="input-box rounded-pill">
                <i class="mdi mdi-magnify"></i>
                <form action="{{ route('search.user') }}" method="get"> <!--search ar jonno amra get method ee use kori--->
                    <input type="text" class="text-warning" name="search" placeholder="Search here..." required/>
                    <button class="button border-0"><a type="submit" class="btn btn-outline-warning rounded-pill">Search</a></button>
                </form>
                
            </div>
            </div>  
            <!--===== Search bar End =====-->   

        <div class="table-responsive mt-4">
        
        <table class="table">
            <thead>
            <tr>
                
                <th scope="col" class="profile-edit" style="font-size: 1.3rem">Image</th>
                <th scope="col" class="profile-edit" style="font-size: 1.3rem">Name</th>
                <th scope="col" class="profile-edit" style="font-size: 1.3rem">Email</th>
                <th scope="col" class="profile-edit" style="font-size: 1.3rem">UserType</th>
                <th scope="col" class="profile-edit" style="font-size: 1.3rem">EmailVarifiedAt</th>
                <th scope="col" class="profile-edit" style="font-size: 1.3rem">CreatedAccountAt</th>
                <th scope="col" class="profile-edit" style="font-size: 1.3rem">UpdatedAccountAt</th>
                <th scope="col" class="profile-edit" style="font-size: 1.3rem">Action</th>
            </tr>
            </thead>
            <tbody>
                
                @foreach ($users as $user)
                
                <tr>          
                    
                    <td>
                        <img  src="Users_images/{{ $user->image }}"  class="rounded-circle" width="40" height="40" /> <!--akhane Users_images/ ta hocche amader akta directory jei directory ta amara public directory ar moddhe create korechi amader Users ar picture gulo rakhar jonno------->
                    </td>

                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>


                    @if ($user->user_type == '1')
                        <td>Admin</td>

                    @else
                        <td>User</td>

                    @endif  




                    @if ($user->email_verified_at == '') <!--akhane ami set kore diyechi jodi amader user ar email_verified_at column ta emty ba faka thake tahole Not Varified dekhabe and jodi amader user ar email_varified_at column ta te kono data thake tahole else aa chole jabe and user ar oi email_varified_at Column ar data ta dekhabe--->
                            <td>Not Varified</td>
                        
                    @else  
                        <td>{{  date("d-m-Y h:i A", strtotime($user->email_verified_at)) }}</td>

                    @endif     


                    
                    <td>{{ $user->created_at }}</td>
                    <td>{{ $user->updated_at }}</td>               
                    
                    <td>        
                        <a href="/user{{$user->id}}" class="btn btn-warning">Show</a><!--akhane jokhon kew amader application ar Show button a click korbe tokhon oi record ar id ta amra aikhane akta url create kore pass korediyechi /user{{--$user->id --}} jei row ar ba record ar Show button a click kora hobe oi record ar id ta amader ai url ar maddhome pass hoye jabe route ar moddehe check routes/web.php ------->
                        
                    </td>
                </tr>

            @endforeach
            
            </tbody>
        </table>  
        <!---Pagination degine-->
        <div class="row m-2 pt-3">
            {{ $users->appends(request()->query())->links('pagination::bootstrap-5') }}  <!----akhane amader pagination digine ar sathe appends(request()->query()) aita add korar karon hocche amader resources/views/restaurant/admin/show-users.blade.php ar moddhe jei search bar ta ache oi search bar ar moddhe kew jodi eemon kono kichu diye search dei ja amader show-users.blade.php file ar moddhe 7 barer beshi ache tahole amader oi data theke 7 ta 7 ta kore data ak ak page aa dekhabe karon amader ai search ar theke jokhon datata ashche amader searchController.php theke oikhane ami paginate(7) bole diyechi jar mane hocche amader search queary korar pore jei koita data pabe oi data guloke ak ak page ar moddhe 7 ta kore dekhabe..and niche jai pagination ar number gulo thakbe oi number gulote press korle kraj korbe and jodi amra appends(request()->query()) aita na likhi tahole amader search bar moddhe jei data diye search kora hobe oi data ta amader SearchController.php ar moddhe giye paginage hoye amader ai page ar moddhe chole ashbe and database pagination ar digine ta oo dekhabe kintu jokhon ami pagination ar number ar moddhe click korbo tokhon amader click korar por kaj hobe na jodi aita na likhi to aita lekhar r akta karon hocche amader resources/views/restaurant/admin/show-users.blade.php ar moddhe amader pagination kora ache and oikhane akta search bar ache oi search bar ar moddhe kono value diye search korle oi value ta jodi amader oonek bar thake tahole search korar pore amader oi data ta aabar pagination ar sathe show korbe tai--->

        </div>

    @endif

</div>
@endsection

 