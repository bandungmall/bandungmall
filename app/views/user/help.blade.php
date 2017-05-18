@extends('user.templates.layout')

@section('content')
<!-- CONTENT START -->
  <div class="content"> 
    
    <!--======= SUB BANNER =========-->
    <section class="sub-banner">
      <div class="container">
        <h4>BANTUAN</h4>
        <!-- Breadcrumb -->
        <ol class="breadcrumb">
          <li><a href="#">Home</a></li>
          <li class="active">BANTUAN</li>
        </ol>
      </div>
    </section>

     <!--  FAQS -->
    <section class="section-p-30px">
      <div class="container">
        <p style="margin-top:50px;" class="lead text-center">
          Bandungmall adalah sebuah toko online yang didirikan untuk membantu masyarakat Indonesia berjualan secara Online.
          Untuk mendukung hal tersebut berikut adalah beberapa pertanyaan umum yang sering diajukan
        </p>
        <div class="row animate fadeInUp" data-wow-delay="0.4s">
          <div class="col-md-3">
            <div class="side-bar"> 
              
              <!-- FAQS NAV -->
              <ul class="cate faq-cate" style="margin-top:0">
                <li><a href="#help1">Pembayaran</a></li>
                <li><a href="#help2">Pengiriman</a></li>
                <li><a href="#help3">Check Pesanan</a></li>
                <li><a href="#help4">Permasalahan Produk</a></li>
                <li><a href="#help5">Cara Berbelanja</a></li>
                <li><a href="#help6">Hubungi Kami</a></li>
              </ul>
            </div>
          </div>

          <!--======= FAQS =========-->
          <div class="col-md-9">
            <div class="faqs"> 
              
              <!-- FAQS NAV -->
              <div class="panel-group" id="accordion">

                <!-- FAQS 1 -->
                <div class="panel panel-default" id="help1">
                  <div class="panel-heading">
                    <h4 class="panel-title" style="padding:15px">Pembayaran</h4>
                  </div>
                  <div id="collapseOne" class="panel-collapse collapse in">
                    <div class="panel-body"> 
                      Pembayaran dalam bertransaksi di tokocerdas.com dilakukan dengan cara transfer ke rekening BCA  CV Nusantara Artifisial.<br />
                      Berikut merupakan rekening milik CV Nusantara Artifisial.

                      <br>
                      <strong>
                          BCA
                      </strong>
                      : no. rek : 2820105586
                      <br>
                      <strong>
                          an. CV Nusantara Artifisial
                      </strong>
                    </div>
                  </div>
                </div>

                <!-- FAQS 2 -->
                <div class="panel panel-default" id="help2">
                  <div class="panel-heading">
                    <h4 class="panel-title" style="padding:15px">Pengiriman</h4>
                  </div>
                  <div id="collapseOne" class="panel-collapse collapse in">
                    <div class="panel-body"> 
                      Pengiriman barang dilakukan dengan jasa pengiriman JNE/Tiki.<br />
                      Paket yang tersedia:
                      <ul>
                        <li>JNE Reguler</li>
                        <li>JNE Express</li>
                        <li>TIKI Reguler</li>
                        <li>TIKI Express</li>
                      </ul>
                    </div>
                  </div>
                </div>

                <!-- FAQS 3 -->
                <div class="panel panel-default" id="help3">
                  <div class="panel-heading">
                    <h4 class="panel-title" style="padding:15px">Check Pesanan</h4>
                  </div>
                  <div id="collapseOne" class="panel-collapse collapse in">
                    <div class="panel-body"> 
                      Cara mengecek status pesanan:<br />
                      Setelah login, masuk ke <span class="text-info">Akun</span> > <span class="text-info">Check Pesanan</span> > Masukkan nomor pesanan yang didapatkan melalui email setelah melakukan konfirmasi transfer atau <a href="customer-check.html">klik disni.</a><br /><br />Ada 3 macam status yaitu:</p>
                      <ul class="nols">
                       <li>PENDING: barang masih disiapkan oleh seller.</li>
                       <li>SENT: barang sudah dikirim.</li>
                       <li>NOT AVAILABLE: nomor pesanan yang dimasukkan tidak cocok.</li>   
                      </ul>
                    </div>
                  </div>
                </div>

                <!-- FAQS 4 -->
                <div class="panel panel-default" id="help4">
                  <div class="panel-heading">
                    <h4 class="panel-title" style="padding:15px">Permasalahan Produk</h4>
                  </div>
                  <div id="collapseOne" class="panel-collapse collapse in">
                    <div class="panel-body"> 
                      Bandungmall tidak melayani pengembalian produk ataupun refund atas kerusakan barang bagi customer, Namun kami menyediakan fasilitas untuk mengkontak merchant melalui menu message. Customer dan merchant bisa mendiskusikan jalan keluar bersama (seperti pengembalian barang/refund).
                      <br />Cara memasuki menu message:
                      <br />Setelah login, masuk ke <span class="text-info">Akun</span> > <span class="text-info">Riwayat Pesanan</span> > Pilih produk yang mau ditanya dengan merchant atau <a href="customer-riwayat.html">klik disni.</a><br />
                    </div>
                  </div>
                </div>

                <!-- FAQS 5 -->
                <div class="panel panel-default" id="help5">
                  <div class="panel-heading">
                    <h4 class="panel-title" style="padding:15px">Cara Berbelanja</h4>
                  </div>
                  <div id="collapseOne" class="panel-collapse collapse in">
                    <div class="panel-body"> 
                      <ul>
                        <li>Pilih barang yang mau dibeli</li>
                        <li>Masukkan kuantitas kemudian tekan tombol <span class="text-info">Beli</span></li>
                        <li>Setelah masuk ke menu shopping cart, tekan tombol <span class="text-info">Bayar</span>, jika masih ingin membeli barang yang lain, tekan <span class="text-info">Kembali belanja</span></li>
                        <li>Masukkan data customer untuk menentukan tujuan pengiriman barang dan pilih paket kurir yang diinginkan, kemudian lakukan pengecekkan barang. Jika sudah, tekan tombol <span class="text-info">Lanjut ke menu konfirmasi</span></li>
                        <li>Cek jumlah yang harus ditransfer, setelah itu transfer ke salah satu rekening CV Nusantara Artifisial</li>
                        <li>Masukkan nomor rekening,nominal dan rekening CV Nusantara Artifisial yang ditransfer(BCA). CV Nusantara Artifisial akan mencocokkan transaksi dengan mutasi rekening CV Nusantara Artifisial sesuai dengan input dari customer, CV Nusantara Artifisial akan memberi tahu kepada merchant untuk mengirimkan barang yang dipesan customer apabila transfer dana dari customer sesuai dengan harga yang ditetapkan.</li>
                      </ul>
                    </div>
                  </div>
                </div>

                <!-- FAQS 6 -->
                <div class="panel panel-default" id="help6">
                  <div class="panel-heading">
                    <h4 class="panel-title" style="padding:15px">Hubungi Kami</h4>
                  </div>
                  <div id="collapseOne" class="panel-collapse collapse in">
                    <div class="panel-body"> 
                      <form class="form-horizontal">
                        <div class="form-group row" align="right">
                          <div class="padded col-sm-10 col-xs-8" align="left">
                              <p class="form-control-static">support@bandungmall.com</p>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>

        </div>
      </div>
    </section>

  </div>

        <div style="clear:both"></div>
                        <!--div class="w100 map">
                            <iframe width="100%" height="350" frameborder="0" scrolling="no" marginheight="0"
                                    marginwidth="0"
                                    src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=+&amp;q=london&amp;ie=UTF8&amp;hq=&amp;hnear=London,+United+Kingdom&amp;ll=51.511214,-0.119824&amp;spn=0.007264,0.021136&amp;t=m&amp;z=14&amp;output=embed">
                            </iframe>
                            <br/>
                            <small>
                                <a href="https://maps.google.com/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=+&amp;q=london&amp;ie=UTF8&amp;hq=&amp;hnear=London,+United+Kingdom&amp;ll=51.511214,-0.119824&amp;spn=0.007264,0.021136&amp;t=m&amp;z=14"
                                   style="color:#0000FF;text-align:left">
                                    View Larger Map
                                </a>
                            </small>

                        </div-->

    <!-- ./main-container -->
    <div class="gap"></div>
</div>
</div>
@endsection