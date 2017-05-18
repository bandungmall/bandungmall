@extends('layout.frontend')

@section('isi')
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3">
          <div class="sidemenuwrap">
            <ul class="nav nav-pills nav-stacked">
              <li><a href="{{URL::to('user/home')}}">Akun saya</a></li>
              <li><a href="{{URL::to('user/myAccount')}}">Informasi akun saya</a></li>
              <li><a href="{{URL::to('user/order')}}">Check pesanan</a></li>
              <li><a href="{{URL::to('user/transactionHistory')}}">Riwayat pesanan</a></li>
              <hr />
              <li class="active"><a href="{{URL::to('user/downline')}}">Check downline</a></li>
              <li><a href="{{URL::to('user/income')}}">Check penghasilan</a></li>
              <li><a href="{{URL::to('user/doLogout')}}">Log out</a></li>
            </ul>
          </div>
        </div>
        <div class="col-sm-9">
              <div id="bordered">
                <h3>Downline</h3>
                    <table class="table">
                      <tr>
                        <th scope="col"></th>
                        <th scope="col">A</th>
                        <th scope="col">B</th>
                        <th scope="col">C</th>
                        <th scope="col">D</th>
                      </tr>
                      <tr>
                        <th scope="row">Persentase yang didapatkan</th>
                        @foreach($mlm_levels as $level)
                          <td>{{$level['bonus_percentage']}}%</td>
                        @endforeach
                      </tr>
                      <tr>
                        <th scope="row">Total downline</th>
                        <th>{{count($tier1)}}</th>
                        <th>{{count($tier2)}}</th>
                        <th>{{count($tier3)}}</th>
                        <th>{{count($tier4)}}</th>
                      </tr>
                    </table>

              </div>
            </div>
      </div>
    </div>
@stop