<!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      @if($authUser && $authUser->user_type == '0') <!--akhane ami akta condition diyechi je amader HomeController theke home.blade.php file ar moddhe jei authUser name variable ta ashche oi variable ar moddhe jodi data thake tahole if condition ar moddhe code gulo execute hobe mane kono user jodi Authentication complete kore mane signup and signin kore amader application ar moddhe ashe and oi authUser ba authenticated user ar user_type jodi '0' hoy mane oi user ta jodi general user hoy tahole oi user table book korte parbe kintu kono Admin aikhan theke table book korte parbe na karon amader Admin ar user_type ta hobe '1' tai ...&& aita mane hocche and jodi 2 pasher sorto mile taholei if ar moddher condition ta execute hobe ta chara hobe na && ai and ar kaj hocche or 2 pasher sorto na mille oo if ar moddher code read kore na and execute ooo kore na----->
          <div class="container">
             
            <div class="section-title">
              <h2><span>Contact</span> Us</h2>
              <p>Ut possimus qui ut temporibus culpa velit eveniet modi omnis est adipisci expedita at voluptas atque vitae autem.</p>
            </div>
          </div>

          <div class="map">
            <iframe style="border:0; width: 100%; height: 350px;" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621" frameborder="0" allowfullscreen></iframe>
          </div>

          <div class="container mt-5">

            <div class="info-wrap">
              <div class="row">
                <div class="col-lg-3 col-md-6 info">
                  <i class="bi bi-geo-alt"></i>
                  <h4>Location:</h4>
                  <p>A108 Adam Street<br>New York, NY 535022</p>
                </div>

                <div class="col-lg-3 col-md-6 info mt-4 mt-lg-0">
                  <i class="bi bi-clock"></i>
                  <h4>Open Hours:</h4>
                  <p>Monday-Saturday:<br>11:00 AM - 2300 PM</p>
                </div>

                <div class="col-lg-3 col-md-6 info mt-4 mt-lg-0">
                  <i class="bi bi-envelope"></i>
                  <h4>Email:</h4>
                  <p>info@example.com<br>contact@example.com</p>
                </div>

                <div class="col-lg-3 col-md-6 info mt-4 mt-lg-0">
                  <i class="bi bi-phone"></i>
                  <h4>Call:</h4>
                  <p>+1 5589 55488 51<br>+1 5589 22475 14</p>
                </div>
              </div>
            </div>

            <form action="{{ route('sand.message') }}" method="POST">
              @csrf
              <div class="php-email-form">
                <div class="row">
                  <div class="col-md-6 form-group">
                    <input type="text" name="name" class="form-control" value="{{ old('name',$authUser->name) }}" placeholder="Your Name" readonly>
                  </div>
                  <div class="col-md-6 form-group mt-3 mt-md-0">
                    <input type="email" class="form-control" name="email" value="{{ old('email',$authUser->email) }}"  placeholder="Your Email" readonly>
                  </div>
                </div>
                <div class="form-group mt-3"></div>
                <div class="form-group mt-3">
                  <span class="text-danger">
                    @error('message')
                        {{ $message }}
                    @enderror
                </span>
                  <textarea class="form-control" name="message" rows="5" placeholder="Message" required>{{ old('message') }}</textarea>
                </div>           
                <div class="text-center"><button type="submit">Send Message</button></div>
              </div>
              
            </form>

          </div>
      @else
          <div class="container">

            <div class="section-title">
              <h2><span>Contact</span> Us</h2>
              <p>Ut possimus qui ut temporibus culpa velit eveniet modi omnis est adipisci expedita at voluptas atque vitae autem.</p>
            </div>
          </div>

          <div class="map">
            <iframe style="border:0; width: 100%; height: 350px;" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621" frameborder="0" allowfullscreen></iframe>
          </div>

          <div class="container mt-5">

            <div class="info-wrap">
              <div class="row">
                <div class="col-lg-3 col-md-6 info">
                  <i class="bi bi-geo-alt"></i>
                  <h4>Location:</h4>
                  <p>A108 Adam Street<br>New York, NY 535022</p>
                </div>

                <div class="col-lg-3 col-md-6 info mt-4 mt-lg-0">
                  <i class="bi bi-clock"></i>
                  <h4>Open Hours:</h4>
                  <p>Monday-Saturday:<br>11:00 AM - 2300 PM</p>
                </div>

                <div class="col-lg-3 col-md-6 info mt-4 mt-lg-0">
                  <i class="bi bi-envelope"></i>
                  <h4>Email:</h4>
                  <p>info@example.com<br>contact@example.com</p>
                </div>

                <div class="col-lg-3 col-md-6 info mt-4 mt-lg-0">
                  <i class="bi bi-phone"></i>
                  <h4>Call:</h4>
                  <p>+1 5589 55488 51<br>+1 5589 22475 14</p>
                </div>
              </div>
            </div>

            <form action="{{ route('sand.message') }}" method="POST">
              @csrf
              <div class="php-email-form">
                <div class="row">
                  <div class="col-md-6 form-group">
                    <input type="text" name="name" class="form-control"   placeholder="Your Name" required>
                  </div>
                  <div class="col-md-6 form-group mt-3 mt-md-0">
                    <input type="email" class="form-control" name="email" placeholder="Your Email" required>
                  </div>
                </div>
                <div class="form-group mt-3"></div>
                <div class="form-group mt-3">
                  <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
                </div>           
                <div class="text-center"><button type="submit">Send Message</button></div>
              </div>
              
            </form>

          </div>
      @endif
    </section>
<!-- End Contact Section -->