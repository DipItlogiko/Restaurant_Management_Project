<!-- ======= Menu Section ======= -->
<section id="menu" class="menu">
  <div class="container">

    <div class="section-title">
      <h2>Check our tasty <span>Menu</span></h2>      
    </div>    

    <div class="row">
      <div class="col-lg-12 d-flex justify-content-center">
        <ul id="menu-flters">
          <li data-filter="*" class="filter-active">Show All</li>
          <li data-filter=".filter-fastfood">Fast Food</li> <!--amader resources/view/restaurant/admin/create-food.blade.php file ar moddhe drop down menu ar valu gulote ami fastfood, salads , sushi aigulo likhe diyechi jokhon kono admin kono food create korar somoy food_type ta select korbe tokhon amader ai fastfood ,  salads ,  sushi  ar moddhe je kono akta text amader database ar table ar food_type ar moddhe set hobe--->
          <li data-filter=".filter-salads">Salads</li>
          <li data-filter=".filter-sushi">Sushi</li>
        </ul>
      </div>
    </div>

    <div class="row row-cols-1 row-cols-md-3 g-4 pt-5 menu-container"> <!--Akhane g-4 hocche bootstrap ar akta class ai g-4 amader card ar moddhe space add korbe ami g- ar pore joto number likhbo 5 ar moddhe amader card ar ashe pashe toto tuku space add hoy jabe---->


      @foreach($allFood as $food)
        <div class="col menu-item filter-{{ $food->food_type }}">
            
            <div class="card">
              <img src="Food_images/{{ $food->image }}" class="card-img-top" alt="..." style="height: 250px;">
              <div class="card-body">
                  <h5 class="card-title fw-bold">{{ $food->title }}</h5>
                  <p class="card-text menu-ingredients">{{ $food->description }}</p>
              </div>
              <div class="mb-5 d-flex justify-content-around">
                  <h3 style="color:#5f5950">$ {{ $food->price }}</h3>
                  <a href="{{ route('food.cart',$food->id) }}" class="book-a-table-btn">Buy Now</a> <!--jokhon kew amader application ar moddhe Buy Now button a click korbe tokhon amader route/web.php ar moddhe food.cart name route ar moddhe jabe tar sathe $food->id take oo niye jabe-------->
              </div>
          </div>                  
        </div>

      @endforeach   

    </div>

  </div>
</section><!-- End Menu Section -->