@extends('user.templates.layout')


@section('content')

<div class="container main-container headerOffset">
    <div class="row">
        <div class="breadcrumbDiv col-lg-12">
            <ul class="breadcrumb">
                <li><a href="{{ URL::to('home')}}">Home</a></li>
                <li><a href="{{ URL::to('user/myAccount')}}">My Account</a></li>
                <li class="active"> My information</li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-7">
            <h3 class="section-title-inner"><span><i
                    class="fa fa-user"></i> My personal information </span></h3>

            <div class="row userInfo">
                <div class="col-lg-12">
                    <h5 class="block-title-2"> Pastikan untuk memasukkan informasi yang benar </h5>

                    <p class="required"><sup>*</sup> Required field</p>
                </div>
                <form action="{{URL::to('user/editInfo')}}" method="post">
                    <div class="col-xs-12 col-sm-6">
                        <div class="form-group required">
                            <label for="InputName">Nama Depan <sup>*</sup> </label>
                            <input required type="text" class="form-control" id="InputName" name="InputName" placeholder="Nama Depan" value="{{{$user->first_name}}}">
                        </div>
                        <div class="form-group required">
                            <label for="InputLastName">Nama Belakang <sup>*</sup> </label>
                            <input required type="text" class="form-control" id="InputLastName" name="InputLastName" placeholder="Nama Belakang" value="{{{$user->last_name}}}">
                        </div>
                        <div class="form-group">
                            <label for="InputEmail"> Email </label>
                            <input type="email" class="form-control" id="InputEmail" name="InputEmail" placeholder="example@example.com" value="{{{$user->email}}}">
                        </div>
                            <input type="hidden" name="idUser" value="{{{$user->id}}}">
                    <div class="col-lg-12">
                        <button type="submit" class="btn   btn-primary"><i class="fa fa-save"></i> &nbsp; Save</button>
                    </div>
                </form>
                <div class="col-lg-12 clearfix">
                    <ul class="pager">
                        <li class="previous pull-right"><a href="{{ URL::to('home')}}"> <i class="fa fa-home"></i> Go to Shop </a>
                        </li>
                        <li class="next pull-left"><a href="{{ URL::to('user/myAccount')}}"> &larr; Back to My Account</a></li>
                    </ul>
                </div>
            </div>
            <!--/row end-->

        </div>
        <div class="col-lg-3 col-md-3 col-sm-5"></div>
    </div>
    <!--/row-->

    <div style="clear:both"></div>
</div>
<!-- /main-container -->

<div class="gap"></div>
@endsection