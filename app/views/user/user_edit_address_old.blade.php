@extends('layout.frontend')

@section('isi')
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3">
          <div class="sidemenuwrap">
            <ul class="nav nav-pills nav-stacked">
              <li><a href="{{URL::to('user/home')}}">Akun saya</a></li>
              <li class="active"><a href="{{URL::to('user/myAccount')}}">Informasi akun saya</a></li>
              <li><a href="{{URL::to('user/order')}}">Check pesanan</a></li>
              <li><a href="{{URL::to('user/transactionHistory')}}">Riwayat pesanan</a></li>
              <hr />
              {{--<li><a href="{{URL::to('user/downline')}}">Check downline</a></li>--}}
              {{--<li><a href="{{URL::to('user/income')}}">Check penghasilan</a></li>--}}
              <li><a href="{{URL::to('user/doLogout')}}">Log out</a></li>
            </ul>
          </div>
        </div>
        <div class="col-sm-9">
              <div id="bordered">
                <h4>Edit Alamat</h4>
                <hr />
                <form method="post" action="{{URL::to('user/myAccount/editAddress/doEditAddress')}}">
                  <input type="hidden" value="{{$user_address['id']}}" name="address_id" />
                  <div class="form-group">
                    <label for="infoprov">Nama :</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Nama" value="{{$user_address['name']}}" required/>
                  </div>
                  <div class="form-group">
                    <label for="infoprov">Provinsi:</label>
                    <input type="text" class="form-control" name="district" id="district" placeholder="Provinsi" value="{{$user_address['district']}}" required/>
                  </div>
                  <div class="form-group">
                    <label for="infokota">Kota:</label>
                    <select name="city" class="form-control">
                      @foreach($areas as $area)
                        @if($area->area_name ==$user_address->city)
                          <option value="{{$area['area_name']}}" selected>{{$area['area_name']}}</option>
                        @else
                          <option value="{{$area['area_name']}}">{{$area['area_name']}}</option>
                        @endif
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="infoalamat">Alamat:</label>
                    <input type="text" name="address" class="form-control" id="infoalamat" placeholder="Alamat lengkap" value="{{$user_address['address']}}" required/>
                  </div>
                  <div class="form-group">
                    <label for="infopos">Kode pos:</label>
                    <input name="postal_code" type="text" class="form-control" id="infopos" placeholder="Kode pos" value="{{$user_address['postal_code']}}" required/>
                  </div>
                  <div class="form-group">
                    <label for="infopos">No Telp:</label>
                    <input name="phone_number" type="text" class="form-control" id="infopos" placeholder="No Telp" value="{{$user_address['phone_number']}}" required/>
                  </div>
                  <div align="right">
                    <a href="#"><button class="btn btn-default">Confirm</button></a>
                  </div>
                </form>
              </div>
            </div>
      </div>
    </div>
@stop