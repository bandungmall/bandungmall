@extends('user.templates.layout')

@section('content')
  
  <!-- CONTENT START -->
  <div class="content"> 
    
    <!--======= SUB BANNER =========-->
    <section class="sub-banner">
      <div class="container">
        <h4>MY ACCOUNT</h4>
        <!-- Breadcrumb -->
        <ol class="breadcrumb">
          <li><a href="{{ URL::to('/') }}">Home</a></li>
          <li class="active">MY ACCOUNT</li>
        </ol>
      </div>
    </section>

    <!--======= PAGES INNER =========-->
    <section class="section-p-30px pages-in chart-page">
      <div class="container"> 
        <p class="text-center lead">Welcome to your account. Here you can manage all of your personal information and orders.</p>
      

        <ul class="myAccountList row">
          <!-- <li class="col-lg-2 col-md-2 col-sm-3 col-xs-4  text-center ">
            <div class="thumbnail equalheight"><a title="Orders" href="{{ URL::to('user/transactionHistory')}}"><i style="display:block;text-align:center;padding:40px"
                      class="fa fa-calendar fa-4x"></i> Order history </a></div>
          </li> -->
          <li class="col-lg-2 col-md-2 col-sm-3 col-xs-4  text-center ">
            <div class="thumbnail equalheight"><a title="My addresses" href="{{ URL::to('user/address')}}"><i style="display:block;text-align:center;padding:40px"
                      class="fa fa-map-marker fa-4x"></i> My addresses</a></div>
          </li>
          <!-- <li class="col-lg-2 col-md-2 col-sm-3 col-xs-4  text-center ">
              <div class="thumbnail equalheight"><a title="My addresses" href="{{ URL::to('user/bank')}}"><i
                      class="fa fa-university"></i> My account bank</a></div>
          </li> -->
          <li class="col-lg-2 col-md-2 col-sm-3 col-xs-4  text-center ">
            <div class="thumbnail equalheight"><a title="Personal information"
                                                    href="{{ URL::to('user/info')}}"><i style="display:block;text-align:center;padding:40px" class="fa fa-cog fa-4x"></i>
                  Personal info</a></div>
          </li>
        </ul>
      </div>
    </section>

  </div>
@endsection