@extends('user.templates.layout')


@include('user.templates.add_bank')
@include('user.templates.edit_bank')

<script type="text/javascript">

$('#ModalEditBank').on('hidden.bs.modal', function () {
    $(this).find("input,textarea,select").val('').end();

});


$('#ModalBank').on('hidden.bs.modal', function () {
    $(this).find("input,textarea,select").val('').end();

});

</script>

@section('content')
<div class="container main-container headerOffset">
    <div class="row">
        <div class="breadcrumbDiv col-lg-12">
            <ul class="breadcrumb">
                <li><a href="{{ URL::to('home')}}">Home</a></li>
                <li><a href="{{ URL::to('user/myAccount')}}">My Account</a></li>
                <li class="active"> My Account Bank</li>
            </ul>
        </div>
    </div>
    <!--/.row-->


    <div class="row">

        <div class="col-lg-9 col-md-9 col-sm-7">
            <h1 class="section-title-inner"><span><i class="fa fa-university"></i> My Account Bank </span></h1>

            <p>Pastikan bahwa account bank yang anda masukkan sudah benar dan merupakan account bank anda</p>
            @if($errors->any())
              <h4 style="color:#ff0000">{{$errors->first()}}</h4>
            @endif

            <div class="row userInfo">

                <div class="col-lg-12">
                    <h2 class="block-title-2"> Berikut adalah account bank yang anda daftarkan </h2>
                </div>

                <div class="w100 clearfix">
                    @forelse ($user_bank as $bank)
                    <div class="col-xs-12 col-sm-6 col-md-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><strong>My Account Bank</strong></h3>
                            </div>
                            <div class="panel-body">
                                <ul>
                                    <li><span class="bank-name-acc"> <strong>{{$bank->bank_account}}</strong></span></li>
                                    <li><span class="bank-name">{{$bank->nama_bank}}</span></li>
                                    <li><span class="bank-name-rek"> {{$bank->nama_rekening}} </span></li>
                                    <li><span class="bank-no-rek"> {{$bank->no_rekening}}</span></li>
                                </ul>
                            </div>
                            <div class="panel-footer panel-footer-bank"><a href="#" data-toggle="modal" data-target="#ModalEditBank"
                                                                              class="btn btn-sm btn-success openEdit" data-toggle="modal" data-target="#ModalBank" 
                                                                              data-id="{{$bank->id_user_bank}}" data-id-bank="{{$bank->id_bank}}" data-nama-acc="{{$bank->bank_account}}" data-nama-bank="{{$bank->nama_bank}}"
                                                                              data-nama-rek="{{$bank->nama_rekening}}" data-no-rek="{{$bank->no_rekening}}"  > <i
                                    class="fa fa-edit"> </i> Edit </a> <a class="btn btn-sm btn-danger" onclick="deleteWarning({{$bank->id}})"> <i
                                    class="fa fa-minus-circle"></i> Delete </a></div>
                        </div>
                    </div>
                    @empty
                        <div class="col-lg-12">
                            <p>BELUM ADA BANK YANG DIDAFTARKAN</p>
                        </div>
                    @endforelse

                </div>
                <!--/.w100-->

                <div class="col-lg-12 clearfix">
                    <a class="btn   btn-primary" href="#" data-toggle="modal" data-target="#ModalBank"><i class="fa fa-plus-circle"></i> Add New Account
                        Bank </a>
                </div>

                <div class="col-lg-12 clearfix">
                    <ul class="pager">
                        <li class="previous pull-right"><a href="{{ URL::to('home')}}"> <i class="fa fa-home"></i> Go to Shop </a>
                        </li>
                        <li class="next pull-left"><a href="{{ URL::to('user/myAccount')}}">&larr; Back to My Account</a></li>
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
<!-- /.main-container -->

<div class="gap"></div>
@endsection

@section('javascript')
<script>
function deleteWarning(bankId) {
    var x;
    if (confirm("Apakah anda yakin untuk menghapus") == true) {
        window.location.href = 'myAccount/deleteBank?bank_id=' + bankId ;
    } 
}
</script>

<script type="text/javascript">
$(document).on("click", ".openEdit", function () {
     var id = $(this).data('id');
     var bank_id = $(this).data('id-bank');
     var nama_bank = $(this).data('nama-bank');
     var nama_acc = $(this).data('nama-acc');
     var nama_rek = $(this).data('nama-rek');
     var no_rek = $(this).data('no-rek');
     $(".modal-body #id").val( id );
     $(".modal-body #bank_id").val( bank_id );
     $(".modal-body #nama_bank").val( nama_bank );
     $(".modal-body #nama_acc").val( nama_acc );
     $(".modal-body #nama_rek").val( nama_rek );
     $(".modal-body #no_rek").val( no_rek );
});
</script>


@endsection