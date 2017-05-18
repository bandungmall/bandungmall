@extends('user.templates.layout')

@section('content')

<div class="container main-container headerOffset">

    <div class="row innerPage">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="row userInfo">

                <p class="lead text-center"> {{ $message }} </p>

                <h1 class="h1error text-center">ERROR <span class="err404"> {{ $code }}</span></h1>

                <h1 class="h1error text-center"><span class="err404"> <i class="fa fa-frown-o"></i></span></h1>


            </div>
            <!--/row end-->
        </div>
    </div>
    <!--/.innerPage-->
    <div style="clear:both"></div>
</div>
<!-- /.main-container -->
@stop