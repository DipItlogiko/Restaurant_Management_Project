<!-- ======= Book A Table Section ======= -->
<section id="book-a-table" class="book-a-table">
    <div class="container"> 

      @if($authUser && $authUser->user_type = '0') <!--akhane ami akta condition diyechi je amader HomeController theke home.blade.php file ar moddhe jei authUser name variable ta ashche oi variable ar moddhe jodi data thake tahole if condition ar moddhe code gulo execute hobe mane kono user jodi Authentication complete kore mane signup and signin kore amader application ar moddhe ashe and oi authUser ba authenticated user ar user_type jodi '0' hoy mane oi user ta jodi general user hoy tahole oi user table book korte parbe kintu kono Admin aikhan theke table book korte parbe na karon amader Admin ar user_type ta hobe '1' tai ...&& aita mane hocche and jodi 2 pasher sorto mile taholei if ar moddher condition ta execute hobe ta chara hobe na && ai and ar kaj hocche or 2 pasher sorto na mille oo if ar moddher code read kore na and execute ooo kore na ----->
        <div class="section-title">
          <h2>Book a <span>Table</span></h2>
          <p>Ut possimus qui ut temporibus culpa velit eveniet modi omnis est adipisci expedita at voluptas atque vitae autem.</p>
        </div>

        <form action="{{ route('book.table') }}" method="POST">
          @csrf 
          <div class="php-email-form">
            <div class="row">
              <div class="col-lg-4 col-md-6 form-group">
                <input type="text" name="name" class="form-control" value="{{ old('name',$authUser->name) }}" placeholder="Your Name" readonly>
                <label for="name">Name</label>
              </div>
              <div class="col-lg-4 col-md-6 form-group mt-3 mt-md-0">
                <input type="email" class="form-control" name="email" value="{{ old('email',$authUser->email) }}"  placeholder="Your Email" readonly>
                <label for="email">Email</label>
              </div>
              <div class="col-lg-4 col-md-6 form-group mt-3 mt-md-0">
                <input type="text" class="form-control" name="phone" value="{{ old('phone',$authUser->number) }}" placeholder="Your Phone" required>
                <label for="phone">Phon</label>
              </div>
              <div class="col-lg-4 col-md-6 form-group mt-3">
                <input type="time" name="timeFrom" class="form-control" required>
                <label for="timeFrom">Time(from)</label>
              </div>
              <div class="col-lg-4 col-md-6 form-group mt-3">
                <input type="time" class="form-control" name="timeTo" required>
                <label for="timeTo">Time(to)</label>
              </div>
              <div class="col-lg-4 col-md-6 form-group mt-3">
                <input type="text" class="form-control" name="nop" placeholder="# of people" required>
                <label for="name">Number Of People</label>
              </div>

             <div class="col-lg-4 col-md-6 form-group mt-3">
                <select name="tableName" class="form-select form-control" required>  
                  <option value="">select table...</option>  

                  @foreach($tables as $data)                                                                       
                      <option value="{{ $data->name }}">{{ $data->name }}(capacity:{{ $data->capacity }})</option>                                     
                  @endforeach                                       
               </select>              
               <label for="tableName" class="form-label">Available Table</label>
             </div>
              
            </div>
            <div class="form-group mt-3">
              <textarea class="form-control" name="message" rows="5" placeholder="Message">{{ old('message') }}</textarea>           
            </div>        
            <div class="text-center"><button type="submit">Send Message</button></div>
          </div>
        </form>
      @else <!--jodi authUser variable ar moddhe kono data na thake tahole else ar moddhe chole ashbe and else ar moddhe jei code tuku ache ai code tuku execute hobe------->
        <div class="section-title">
          <h2>Book a <span>Table</span></h2>
          <p>Ut possimus qui ut temporibus culpa velit eveniet modi omnis est adipisci expedita at voluptas atque vitae autem.</p>
        </div>

        <form action="{{ route('book.table') }}" method="POST">
          @csrf 
          <div class="php-email-form">
            <div class="row">
              <div class="col-lg-4 col-md-6 form-group">
                <input type="text" name="name" class="form-control" placeholder="Your Name">
                <label for="name">Name</label>
              </div>
              <div class="col-lg-4 col-md-6 form-group mt-3 mt-md-0">
                <input type="email" class="form-control" name="email"  placeholder="Your Email">
                <label for="email">Email</label>
              </div>
              <div class="col-lg-4 col-md-6 form-group mt-3 mt-md-0">
                <input type="text" class="form-control" name="phone" placeholder="Your Phone">
                <label for="phone">Phon</label>
              </div>
              <div class="col-lg-4 col-md-6 form-group mt-3">
                <input type="time" name="timeFrom" class="form-control">
                <label for="timeFrom">Time(from)</label>
              </div>
              <div class="col-lg-4 col-md-6 form-group mt-3">
                <input type="time" class="form-control" name="timeTo">
                <label for="timeTo">Time(to)</label>
              </div>
              <div class="col-lg-4 col-md-6 form-group mt-3">
                <input type="text" class="form-control" name="nop" placeholder="# of people">
                <label for="name">Number Of People</label>
              </div>
            </div>
            <div class="form-group mt-3">
              <textarea class="form-control" name="message" rows="5" placeholder="Message"></textarea>           
            </div>        
            <div class="text-center"><button type="submit">Send Message</button></div>
          </div>
        </form>
      @endif

      

    </div>
  </section><!-- End Book A Table Section -->


  @section('custom_js')
       <!--====== This script is for Aleart auto close ======-->
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