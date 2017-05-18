@extends('user.templates.layout')


@include('user.templates.add_address')
@include('user.templates.edit_address')

@section('content')
<div class="container main-container headerOffset">
    <div class="row">
        <div class="breadcrumbDiv col-lg-12">
            <ul class="breadcrumb">
                <li><a href="{{ URL::to('home')}}">Home</a></li>
                <li><a href="{{ URL::to('user/myAccount')}}">My Account</a></li>
                <li class="active"> My Address</li>
            </ul>
        </div>
    </div>
    <!--/.row-->


    <div class="row">

        <div class="col-lg-9 col-md-9 col-sm-7">
            <h3 class="section-title-inner"><span><i class="fa fa-map-marker"></i> My addresses </span></h3>

            <p>Pastikan bahwa alamat yang anda masukkan sudah benar</p>

            <div class="row userInfo">

                <div class="col-lg-12">
                    <h5 class="block-title-2"> Berikut adalah alamat yang anda daftarkan </h5>

                    <p> Silahkan merubah data alamat terakhir anda</p>
                </div>

                <div class="w100 clearfix">
                    @forelse ($user_address as $address)
                    <?php
                      $kota = DB::table('area_provinsi as ap')
                              ->leftJoin('area_kota as ak','ak.id_provinsi','=','ap.id')
                              ->where('ap.name', '=', $address->provinsi)
                              ->where('ak.name', '=', $address->kota)
                              ->first();
                      
                    ?>
                    <div class="col-xs-12 col-sm-6 col-md-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><strong>Alamat Saya
                                @if($address->is_selected == "yes")
                                  (Dipilih) 
                                @else
                                  <a data-toggle="tooltip" title="Jadikan Alamat Utama?" href="user/address/setAddress/{{$address->id}}"><i class="fa fa-check"></i></a>
                                @endif
                                </strong></h3>
                            </div>
                            <div class="panel-body">
                                <ul>
                                    <li><span class="address-name"> <strong>{{$address->name}}</strong></span></li>
                                    <li><span> <strong>Provinsi</strong> :{{$address->provinsi}} </span></li>
                                    <li><span> <strong style="text-transform: capitalize;">{{$kota->tipe}}</strong> : {{$address->kota}}</span></li>
                                    <li><span> {{$address->alamat}} </span></li>
                                    <li><span> <strong>Telepon</strong> : {{$address->nomer_hp}}</span></li>
                                    <li><span> <strong>Kode Pos</strong> : {{$address->kode_pos}} </span></li>
                                </ul>
                            </div>
                            <div class="panel-footer panel-footer-address"><a href="#" data-toggle="modal" data-target="#ModalEditAddress"
                                                                              class="btn btn-sm btn-success openEdit" data-toggle="modal" data-target="#ModalAddress" 
                                                                              data-id="{{$address->id}}" data-name="{{$address->name}}" data-address="{{$address->alamat}}"
                                                                              data-district="{{$address->provinsi}}" data-phone="{{$address->nomer_hp}}" data-postal="{{$address->kode_pos}}"
                                                                              data-city="{{$address->kota}}"> <i
                                    class="fa fa-edit"> </i> Edit </a> <a class="btn btn-sm btn-danger" onclick="deleteWarning({{$address->id}})"> <i
                                    class="fa fa-minus-circle"></i> Delete </a></div>

                        </div>
                    </div>
                    @empty
                        <span class="price">Belum ada alamat yang didaftarkan</span>
                    @endforelse

                </div>
                <!--/.w100-->

                <div class="col-lg-12 clearfix">
                    <a class="btn   btn-primary" href="#" data-toggle="modal" data-target="#ModalAddress"><i class="fa fa-plus-circle"></i> Add New
                        Address </a>
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
function deleteWarning(addressId) {
    var x;
    if (confirm("Apakah anda yakin untuk menghapus") == true) {
        window.location.href = 'myAccount/deleteAddress?address_id=' + addressId ;
    } 
}
</script>

<script type="text/javascript">
$(document).on("click", ".openEdit", function () {
     var addressId = $(this).data('id');
     var name = $(this).data('name');
     var address = $(this).data('address');
     var district = $(this).data('district');
     var city = $(this).data('city');
     var phone = $(this).data('phone');
     var postal = $(this).data('postal');
     $(".modal-body #address_id").val( addressId );
     $(".modal-body #name").val( name );
     $(".modal-body #district").val( district );
     $(".modal-body #address").val( address );
     $(".modal-body #city").val( city );
     $(".modal-body #phone_number").val( phone );
     $(".modal-body #postal_code").val( postal );
});

$('[data-toggle="tooltip"]').tooltip(); 

$('#ModalEditAddress').on('hidden.bs.modal', function () {
    $(this).find("input,textarea,select").val('').end();

});


$('#ModalAddress').on('hidden.bs.modal', function () {
    $(this).find("input,textarea,select").val('').end();

});

$("#provinsi").change(function(){
  var id = $(this).children('option:selected').data('id');
  
  $.ajax({
    data: 'id='+id,
    url: "user/address/getKota", 
    success: function(result){  
      var x = 0;
      var html = "<option value='0'>Pilih Kota</option>";
      var length = result['areas_kota'].length;

      $("#kota").empty();

      if(length > 0){
        for(x; x < length-1; x++){

          html += "<option style='text-transform: capitalize;' data-id='"+result.areas_kota[x]['id']+"' value='"+result.areas_kota[x]['name']+"'>"+result.areas_kota[x]['tipe']+" "+result.areas_kota[x]['name']+"</option>";

        }
      }else{
        html += "<option value='0'>Kota Belum Tersedia</option>";
      }

      $("#kota").append(html);    
    }
  });
});
</script>


@endsection