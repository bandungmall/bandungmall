@extends('layout.frontend')

@section('isi')

<div class="row">   
            <div class="col-sm-3 col-xs-12">
              <nav class="sidemenuwrap" id="scroller" align="left">
                  <ul class="nav nav-pills nav-stacked">
                      <li><a href="#help1">Pembayaran</a></li>
                      <li><a href="#help2">Pengiriman</a></li>
                      <li><a href="#help3">Check Pesanan</a></li>
                      <li><a href="#help4">Permasalahan Produk</a></li>
                      <li><a href="#help5">Cara Berbelanja</a></li>
                      <li><a href="#help6">Hubungi Kami</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-sm-9 col-xs-12">
              <div id="bordered" style="border:none;background:#FFF">
                    <div id="help1">
                        <h3>Pembayaran</h3>
                        <hr />
                      <p>Pembayaran dalam bertransaksi di tokocerdas.com dilakukan dengan cara transfer ke rekening BCA  CV Nusantara Artifisial.<br />Berikut merupakan rekening milik CV Nusantara Artifisial.</p>
                        <div class="table-responsive">
                        <table class="table">
                          <tr>
                            <th scope="row">BCA</th>
                            <td>2820105586</td>
                            <td>an. CV Nusantara Artifisial</td>
                          </tr>
                          <!-- <tr>
                            <th scope="row">Mandiri</th>
                            <td>XXXX-XXXX-XXXX</td>
                            <td>an. PT. tokocerdas.com</td>
                          </tr> -->
                        </table>
          </div>
                    </div>
                    <div id="help2">
                        <h3>Pengiriman</h3>
                        <hr />
                        <p>Pengiriman barang dilakukan dengan jasa pengiriman JNE/Tiki.<br />
                        Paket yang tersedia:</p>
                        <li>JNE Reguler</li>
                        <li>JNE Express</li>
                        <li>TIKI Reguler</li>
                        <li>TIKI Express</li>
                    
                    </div>
                    <div id="help3">
                        <h3>Check Pesanan</h3>
                        <hr />
                        <p>Cara mengecek status pesanan:<br />
                        
                          Setelah login, masuk ke <span class="text-info">Akun</span> > <span class="text-info">Check Pesanan</span> > Masukkan nomor pesanan yang didapatkan melalui email setelah melakukan konfirmasi transfer atau <a href="customer-check.html">klik disni.</a><br /><br />Ada 3 macam status yaitu:</p>
                        <ul class="nols">
                          <li>PENDING: barang masih disiapkan oleh seller.</li>
                            <li>SENT: barang sudah dikirim.</li>
                            <li>NOT AVAILABLE: nomor pesanan yang dimasukkan tidak cocok.</li>   
                      </ul>
                    </div>
                    <div id="help4">
                        <h3>Permasalahan Produk</h3>
                        <hr />
                        <p>tokocerdas.com tidak melayani pengembalian produk ataupun refund atas kerusakan barang bagi customer, Namun kami menyediakan fasilitas untuk mengkontak merchant melalui menu message. Customer dan merchant bisa mendiskusikan jalan keluar bersama (seperti pengembalian barang/refund).
                        <br />Cara memasuki menu message:
                        <br />Setelah login, masuk ke <span class="text-info">Akun</span> > <span class="text-info">Riwayat Pesanan</span> > Pilih produk yang mau ditanya dengan merchant atau <a href="customer-riwayat.html">klik disni.</a><br /></p>
                      
                    </div>
                    <div id="help5">
                        <h3>Cara Berbelanja</h3>
                        <hr />
                        <ul>
                          <li>Pilih barang yang mau dibeli</li>
                          <li>Masukkan kuantitas kemudian tekan tombol <span class="text-info">Beli</span></li>
                            <li>Setelah masuk ke menu shopping cart, tekan tombol <span class="text-info">Bayar</span>, jika masih ingin membeli barang yang lain, tekan <span class="text-info">Kembali belanja</span></li>
                            <li>Masukkan data customer untuk menentukan tujuan pengiriman barang dan pilih paket kurir yang diinginkan, kemudian lakukan pengecekkan barang. Jika sudah, tekan tombol <span class="text-info">Lanjut ke menu konfirmasi</span></li>
                            <li>Cek jumlah yang harus ditransfer, setelah itu transfer ke salah satu rekening CV Nusantara Artifisial</li>
                            <li>Masukkan nomor rekening,nominal dan rekening CV Nusantara Artifisial yang ditransfer(BCA). CV Nusantara Artifisial akan mencocokkan transaksi dengan mutasi rekening CV Nusantara Artifisial sesuai dengan input dari customer, CV Nusantara Artifisial akan memberi tahu kepada merchant untuk mengirimkan barang yang dipesan customer apabila transfer dana dari customer sesuai dengan harga yang ditetapkan.</li>
                        </ul>
                    </div>
                    <div id="help6">
                        <h3>Hubungi Kami</h3>
                        <hr />
                        <form class="form-horizontal">
                            <div class="form-group row" align="right">
                                <label class="control-label col-sm-2 col-xs-4"><span class="glyphicon glyphicon-envelope"></span> :</label>
                                <div class="padded col-sm-10 col-xs-8" align="left">
                                    <p class="form-control-static">admin@tokocerdas.co.id</p>
                                </div>
                            </div>
                           <!--  <div class="form-group row" align="right">
                                <label class="control-label col-sm-2 col-xs-4"><span class="glyphicon glyphicon-phone"></span> :</label>
                                <div class="padded col-sm-10 col-xs-8" align="left">
                                    <p class="form-control-static">+62 812 1234 123</p>
                                </div>
                            </div> -->
                            <!--
                            <div class="col-sm-3" align="right">
                                <button class="btn btn-default">Live chat</button>
                            </div>
                            -->
                        </form>   
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop