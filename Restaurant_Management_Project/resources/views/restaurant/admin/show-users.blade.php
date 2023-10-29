@extends('restaurant.admin.layouts.master')
 
@section('title')
    show-users
@endsection

@section('body')
     
<div class="container">

    <h2 class="text-left fw-bold h1 mb-2 mx-1 mx-md-4 mt-2  profile-edit" style="font-size: 2.7rem">All<span style="color: #ffb03b">Users</span></h2>


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
                   <td>{{ $user->email_verified_at }}</td>  

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

</div>
</div>

@endsection
