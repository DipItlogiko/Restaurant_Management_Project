<!-- ======= Chefs Section ======= -->
<section id="chefs" class="chefs">
    <div class="container">

      <div class="section-title">
        <h2>Our Proffesional <span>Chefs</span></h2>
        <p>Ut possimus qui ut temporibus culpa velit eveniet modi omnis est adipisci expedita at voluptas atque vitae autem.</p>
      </div>

      <div class="row">
      @foreach($chefs as $chef)
        <div class="col-lg-4 col-md-6">
          <div class="member mt-3">
            <div class="pic"><img src="Chefs_images/{{ $chef->image }}" class="img-fluid" alt=""></div>
            <div class="member-info">
              <h4>{{ $chef->name }}</h4>
              <span>{{ $chef->position }}</span>
              <div class="social">
                <a href="{{ $chef->twitter }}"><i class="bi bi-twitter"></i></a>
                <a href="{{ $chef->facebook }}"><i class="bi bi-facebook"></i></a>
                <a href="{{ $chef->instagraam }}"><i class="bi bi-instagram"></i></a>
                <a href="{{ $chef->linkedin }}"><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div>
        </div>         
      @endforeach 
      </div>

    </div>
  </section><!-- End Chefs Section -->