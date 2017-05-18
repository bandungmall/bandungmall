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
              <li class="active"><a href="{{URL::to('user/transactionHistory')}}">Riwayat pesanan</a></li>
              <hr />
              {{--<li><a href="{{URL::to('user/downline')}}">Check downline</a></li>--}}
              {{--<li><a href="{{URL::to('user/income')}}">Check penghasilan</a></li>--}}
              <li><a href="{{URL::to('user/doLogout')}}">Log out</a></li>
            </ul>
          </div>
        </div>
        <div class="col-sm-9">
              <div id="bordered">
                <h3>Riwayat</h3>
                    <hr />
                    <div id="pesanan">
                        <h6>Pesanan #12312312312</h6>
                        <div class="table-responsive">
                            <table width="200" border="0" class="table table-condensed table-bordered">
                              <tr>
                                <th scope="col" colspan="2">Barang</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Kuantitas</th>
                                <th scope="col">Subtotal</th>
                              </tr>
                              <tr>
                                <td><img class="img-responsive" src="produk/TONGSIS STONIC-07 (Hijau).jpg" width="50" height="50" /></td>
                                <td>Tongsis Hijau<br />Stonic</td>
                                <td>Rp. 110.000,-</td>
                                <td>1</td>
                                <td>Rp. 110.000,-</td>
                              </tr>
                              <tr>
                                <td><img class="img-responsive" src="produk/TONGSIS STONIC-07 (Hitam).jpg" width="50" height="50" /></td>
                                <td>Tongsis Hitam<br />Stonic</td>
                                <td>Rp. 110.000,-</td>
                                <td>2</td>
                                <td>Rp. 220.000,-</td>
                              </tr>
                                <tr>
                                    <th colspan="4">Total</th>
                                    <td>Rp. 330.000,-</td>
                                </tr>
                                <tr>
                                    <th colspan="4">Diskon</th>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <th colspan="4">Ongkir</th>
                                    <td>Rp. 9.000,-</td>
                                </tr>
                                <tr>
                                    <th colspan="4">PPN</th>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <th colspan="4">Total Akhir</th>
                                    <th>Rp. 339.000,-</th>
                                </tr>
                                <tr>
                                    <th colspan="6">Status Pesanan</th>
                                </tr>
                                <tr>
                                    <th colspan="3">Tanggal</th>
                                    <th colspan="3">Status</th>
                                </tr>
                                <tr>
                                    <td colspan="3">24/08/2015</td>
                                    <td colspan="3">Konfirmasi transfer</td>
                                </tr>
                                <tr>
                                    <td colspan="3">24/08/2015</td>
                                    <td colspan="3">Pembayaran sudah di terima, Merchant mempersiapkan barang</td>
                                </tr>
                                <tr>
                                    <td colspan="3">25/08/2015</td>
                                    <td colspan="3">Barang sudah dikirim dengan nomor resi XXX-XXXX-XXXX</td>
                                </tr>
                                <tr>
                                    <td colspan="3">27/08/2015</td>
                                    <td colspan="3">Pengiriman barang telah berhasil</td>
                                </tr>
                            </table>
                        </div>
                    </div>
              </div>
            </div>
      </div>
    </div>
@stop