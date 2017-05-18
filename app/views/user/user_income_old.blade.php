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
              <li><a href="{{URL::to('user/downline')}}">Check downline</a></li>
              <li class="active"><a href="{{URL::to('user/income')}}">Check penghasilan</a></li>
              <li><a href="{{URL::to('user/doLogout')}}">Log out</a></li>
            </ul>
          </div>
        </div>
        <div class="col-sm-9">
              <div id="bordered">
                <h3>Penghasilan</h3>
                    <div class="table-responsive">
                      <p>Perhitungan belum ada, karena belum sampai tanggal proses</p>
                      <!--
                        <table class="table">
                          <tr>
                            <th scope="col">Level</th>
                            <th scope="col">Total pembelian downline</th>
                            <th scope="col">Potongan</th>
                            <th scope="col">Subtotal yang didapat</th>
                          </tr>
                          <tr>
                            <td>A</td>
                            <td>Rp. 110.000,-</td>
                            <td>4%</td>
                            <td>Rp. 4.400,-</td>
                          </tr>
                          <tr>
                            <td>B</td>
                            <td>Rp. 110.000,-</td>
                            <td>4%</td>
                            <td>Rp. 4.400,-</td>
                          </tr>
                          <tr>
                            <td>C</td>
                            <td>Rp. 110.000,-</td>
                            <td>4%</td>
                            <td>Rp. 4.400,-</td>
                          </tr>
                          <tr>
                            <td>D</td>
                            <td>Rp. 110.000,-</td>
                            <td>4%</td>
                            <td>Rp. 4.400,-</td>
                          </tr>
                          <tfoot>
                            <tr>
                              <th colspan="3">Total:</th>
                              <td>Rp. 11.000,-</td>
                            </tr>
                          </tfoot>
                        </table>
                      -->
                    </div>
                <a href="{{URL::to('user/cashout')}}" class="btn btn-primary" disabled>Cashout</a> 
                <p class="detail" style="margin-bottom:50px">*minimal total Rp. 100.000,-</p>
                <h3>Riwayat Cashout</h3>
                <div class="table-responsive">
                    <table class="table">
                          <tr>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Jumlah</th>
                          </tr>
                          <tr>
                            <td>10/08/2015</td>
                            <td>Rp. 107.100,-</td>
                          </tr>
                          <tr>
                            <td>12/08/2015</td>
                            <td>Rp. 169.400,-</td>
                          </tr>
                    </table>
                </div>
            </div>
      </div>
      </div>
    </div>
@stop