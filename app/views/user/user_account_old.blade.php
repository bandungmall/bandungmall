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
                  <h3>Informasi Akun</h3>                                      
                    <hr />
                      <div class="form-group">
                          <label class="control-label col-sm-2">Email:</label>
                            <div class="col-sm-10 padded">
                            <p class="form-control-static">{{$user['email']}}</p>
                            </div>
                        </div>
                      <div class="form-group">
                          <label class="control-label col-sm-2">Nama:</label>
                            <div class="col-sm-10 padded">
                            <p class="form-control-static">{{$user['first_name'].' '.$user['last_name']}}</p>
                            </div>
                        </div>
                      {{--<div class="form-group">--}}
                          {{--<label class="control-label col-sm-2">Upperline:</label>--}}
                            {{--<div class="col-sm-10 padded">--}}
                            {{--@if(empty($upline))--}}
                              {{--<p class="form-control-static">-</p>--}}
                            {{--@else--}}
                              {{--<p class="form-control-static">{{$upline['first_name'].' '.$upline['last_name']}}</p>--}}
                            {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        <hr />
                        @foreach($user_address as $addr)
                          <div class="form-group">
                            <label class="control-label col-sm-2">Alamat:</label>
                              <div class="col-sm-10 padded">
                              <p class="form-control-static">{{$addr['address']}}</p>
                              </div>
                              <div align="right">
                                <a href="{{URL::to('user/myAccount/editAddress?address_id='.$addr['id'])}}"><button class="btn btn-default"><span class="glyphicon glyphicon-edit"></span> Edit</button></a>
                              </div>
                          </div>
                        @endforeach
                    <h4>Tambah alamat</h4>
                    <hr />
                  <form method="post" action="{{URL::to('user/myAccount/doAddAddress')}}">
                    <div class="form-group">
                      <label for="infoprov">Nama :</label>
                      <input type="text" class="form-control" name="name" id="name" placeholder="Nama" required/>
                    </div>
                    <div class="form-group">
                      <label for="infoprov">Provinsi:</label>
                      <input type="text" class="form-control" name="district" id="district" placeholder="Provinsi" required/>
                    </div>
                    <div class="form-group">
                      <label for="infokota">Kota:</label>
                      <select name="city" class="form-control">
                        @foreach($areas as $area)
                          <option value="{{$area['area_name']}}">{{$area['area_name']}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="infoalamat">Alamat:</label>
                      <input type="text" name="address" class="form-control" id="infoalamat" placeholder="Alamat lengkap" required/>
                    </div>
                    <div class="form-group">
                      <label for="infopos">Kode pos:</label>
                      <input name="postal_code" type="text" class="form-control" id="infopos" placeholder="Kode pos" required/>
                    </div>
                    <div class="form-group">
                      <label for="infopos">No Telp:</label>
                      <input name="phone_number" type="text" class="form-control" id="infopos" placeholder="No Telp" required/>
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