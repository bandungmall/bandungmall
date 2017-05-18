  <!--======= Footer =========-->
  <footer>
    <div class="container">
      <!--  Footer Links -->
      <div class="footer-link row">
        <div class="col-md-12">
          <ul>
            
            <!--  MY ACCOUNT -->
            <li class="col-sm-3">
              <h5 style="letter-spacing:0px">MY ACCOUNT</h5>
              <ul class="f-links">
                <li><a href="#" data-toggle="modal" data-target="#ModalLogin"> <span>Sign In</span></a></li>
                <li><a href="#" data-toggle="modal" data-target="#ModalSignup"> Register </a></li>
              </ul>
            </li>
            
            <!-- ABOUT -->
            <li class="col-sm-3">
              <h5 style="letter-spacing:0px">ABOUT</h5>
              <ul class="f-links">
                <li><a href="{{ URL::to('/help') }}">About Bandungmall</a></li>
                <li><a href="{{ URL::to('/help#2') }}">Press</a></li>
                <li><a href="{{ URL::to('/help#4') }}">Policy</a></li>
                <li><a href="{{ URL::to('/help#3') }}">Terms and Conditions</a></li>
                <li><a href="{{ URL::to('/merchant/register') }}">Join as Merchant</a></li>
                <li><a href="{{ URL::to('/merchant/login') }}">Merchant Area</a></li>
              </ul>
            </li>

            <!-- CUSTOMER SERVICE -->
            <li class="col-sm-3">
              <h5 style="letter-spacing:0px">CUSTOMER SERVICE</h5>
              <ul class="f-links">
                <li><a href="tel:+6285624222399"><i class="fa fa-phone"></i> +6285624222399 </a></li>
                <li><a href="mailto:support@bandungmall.co.id"><i class="fa fa-envelope"></i> support@bandungmall.co.id</a></li>
              </ul>
            </li>
            
            <!-- HELP -->
            <li class="col-sm-3">
              <h5 style="letter-spacing:0px">HELP</h5>
              <ul class="f-links">
                <li><a href="{{ URL::to('/help#help5') }}">Shopping Guide</a></li>
                <li><a href="{{ URL::to('/help#help3') }}">Private Shopping</a></li>
                <li><a href="{{ URL::to('/help#help1') }}">Payment Guide</a></li>
                <li><a href="{{ URL::to('/help') }}">FAQ</a></li>
              </ul>
            </li>

          </ul>
        </div>
      </div>
      
      <!-- Rights -->
      <div class="rights">
        <p><p class="pull-left"> &copy; <a href="{{ URL::to('/') }}">Bandungmall.co.id</a> 2016. All right reserved. </p></p>
      </div>
    </div>
  </footer>
  