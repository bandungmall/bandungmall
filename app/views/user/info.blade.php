@extends('user.templates.layout')

@section('content')
<div class="container main-container headerOffset">

    <!-- Main component call to action -->

    <div class="row innerPage">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="row userInfo">

                <p class="lead text-center"> {{$info_data}} </p>



            </div>
            <!--/row end-->
            <div class="cartFooter w100">
                <div class="box-footer">
                    <div class="pull-left"><a href="{{URL::to('/')}}" class="btn btn-default"> <i
                            class="fa fa-arrow-left"></i> &nbsp; Continue shopping </a></div>
                    <div class="pull-right"><a href ="{{URL::to('/user/transactionHistory')}}" class="btn btn-default"> &nbsp;Lihat Pemesanan 
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/.innerPage-->
    <div style="clear:both"></div>
</div>
@endsection