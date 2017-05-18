@extends('user.templates.layout')

@section('content')
<div class="container main-container headerOffset">
  <h1 class="title-big text-center section-title-style2">
    <span> Pendaftaran Merchant </span>
  </h1>
  <div class="container">
    <div class="row">
      <div class=" col-lg-12">
        <form class="form-horizontal" action="{{ URL::to('merchant/doRegister') }}" method="POST">
          <div class="panel panel-default ">
            <div class="panel-heading">
              <h4 class="panel-title">
                Informasi Toko
              </h4>
            </div>
            <div class="panel-body">
              <fieldset>
                <div class="form-group">
                  <label class="col-md-3 control-label" for="seller_name">Nama Seller</label>
                  <div class="col-md-9">
                    <input id="seller_name" name="seller_name" class="form-control input-md" type="text" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label" for="shop_name">Nama Toko</label>
                  <div class="col-md-9">
                    <input id="shop_name" name="shop_name" class="form-control input-md" type="text" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label" for="company_name">Nama Perusahaan</label>
                  <div class="col-md-9">
                    <input id="company_name" name="company_name" class="form-control input-md" type="text" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label" for="pic_name">Nama Penanggung Jawab</label>
                  <div class="col-md-9">
                    <input id="pic_name" name="pic_name" class="form-control input-md" type="text" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label" for="ic_number">Nomor KTP</label>
                  <div class="col-md-9">
                    <input id="ic_number" name="ic_number" class="form-control input-md" type="text" required>
                  </div>
                </div>
              </fieldset>
            </div>
          </div>
          <div class="panel panel-default ">
            <div class="panel-heading">
              <h4 class="panel-title">
                Informasi Kontak dan Alamat
              </h4>
            </div>
            <div class="panel-body">
              <fieldset>
                <div class="form-group">
                  <label class="col-md-3 control-label" for="phone_number">Nomor Telepon</label>
                  <div class="col-md-9">
                    <input id="phone_number" name="phone_number" class="form-control input-md" type="text" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label" for="email">Alamat Email</label>
                  <div class="col-md-9">
                    <input id="email" name="email" class="form-control input-md" type="email" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label" for="confirm_email">Konfirmasi Alamat Email</label>
                  <div class="col-md-9">
                    <input id="confirm_email" name="confirm_email" class="form-control input-md" type="email required">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label" for="address">Alamat</label>
                  <div class="col-md-9">
                    <input id="address" name="address" class="form-control input-md" type="text" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label" for="province">Provinsi</label>
                  <div class="col-md-9">
                    <select name="province" class="form-control" required>
                      <option value="jakarta">DKI Jakarta</option>
                      <option value="bali">Bali</option>
                      <option value="bangka belitung">Bangka Belitung</option>
                      <option value="banten">Banten</option>
                      <option value="bengkulu">Bengkulu</option>
                      <option value="yogyakarta">DI Yogyakrta</option>
                      <option value="gorontalo">Gorontalo</option>
                      <option value="jambi">Jambi</option>
                      <option value="jawa barat">Jawa Barat</option>
                      <option value="jawa tengah">Jawa Tengah</option>
                      <option value="jawa timur">Jawa Timur</option>
                      <option value="kalimantan barat">Kalimatan Barat</option>
                      <option value="kalimantan selatan">Kalimatan Selatan</option>
                      <option value="kalimantan tengah">Kalimatan Tengah</option>
                      <option value="kalimantan timur">Kalimatan Timur</option>
                      <option value="kepulauan riau">Kepulauan Riau</option>
                      <option value="lampung">Lampung</option>
                      <option value="maluku">Maluku</option>
                      <option value="maluku utara">Maluku Utara</option>
                      <option value="aceh">Nanggroe Aceh Darussalam</option>
                      <option value="nusa tenggara barat">Nusa Tenggara Barat</option>
                      <option value="nusa tenggara timur">Nusa Tenggara Timur</option>
                      <option value="papua">Papua</option>
                      <option value="papua barat">Papua Barat</option>
                      <option value="riau">Riau</option>
                      <option value="sulawesi barat">Sulawesi Barat</option>
                      <option value="sulawesi selatan">Sulawesi Selatan</option>
                      <option value="sulawesi tengah">Sulawesi Tengah</option>
                      <option value="sulawesi tenggara">Sulawesi Tenggara</option>
                      <option value="sulawesi utara">Sulawesi Utara</option>
                      <option value="sumatra barat">Sumatra Barat</option>
                      <option value="sumatra selatan">Sumatra Selatan</option>
                      <option value="sumatra utara">Sumatra Utara</option>      
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label" for="city">Kota/Kabupaten</label>
                  <div class="col-md-9">
                    <input id="city" name="city" class="form-control input-md" type="text" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label" for="district">Kecamatan</label>
                  <div class="col-md-9">
                    <input id="district" name="district" class="form-control input-md" type="text" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label" for="postal_code">Kode Pos</label>
                  <div class="col-md-9">
                    <input id="postal_code" name="postal_code" class="form-control input-md" type="text" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label" for="city_from">Produk dikirim dari:</label>
                  <div class="col-md-9">
                    <select name="city_from" class="form-control" required>
                      @foreach($areas as $area)
                        <option value="{{$area['area_name']}}">{{$area['area_name']}}</option>
                      @endforeach
                    </select>
                    <span class="help-block">*Untuk menghitung perkiraan biaya kirim</span>
                  </div>
                </div>
              </fieldset>
            </div>
          </div>
          <div class="panel panel-default ">
            <div class="panel-heading">
              <h4 class="panel-title">
                Informasi Rekening
              </h4>
            </div>
            <div class="panel-body">
              <fieldset>
                <div class="form-group">
                  <label class="col-md-3 control-label" for="account_number">Nomor Rekening</label>
                  <div class="col-md-9">
                    <input id="account_number" name="account_number" class="form-control input-md" type="text" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label" for="account_name">Atas Nama</label>
                  <div class="col-md-9">
                    <input id="account_name" name="account_name" class="form-control input-md" type="text" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label" for="account_bank">Nama Bank</label>
                  <div class="col-md-9">
                    <input id="account_bank" name="account_bank" class="form-control input-md" type="text" required>
                  </div>
                </div>
              </fieldset>
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-12">
              <!-- <div class="checkbox">
                <label><input type="checkbox" id="mercheck" required/>Saya telah membaca dan memahami <a href="{{ URL::to('public/documents/BANDUNGMALL-agreement.pdf') }}">perjanjian bandungmall.co.id dengan merchant</a></label>
              </div> -->
            </div>
          </div>
          <button class="btn btn-primary" type="submit">Daftar</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('javascript')
    <script type="text/javascript">
      var email = document.getElementsById("email")[0];
      var confirm_email = document.getElementsById("confirm_email")[0];

      function validateEmail(){
        if(email.value != confirm_email.value) {
          confirm_email.setCustomValidity("Email Don't Match");
        } else {
          confirm_email.setCustomValidity('');
        }
      }
      email.onchange = validateEmail;
      confirm_email.onkeyup = validateEmail;
      
      @if($msg !='' || $msg !=null)
        alert('{{$msg}}');
      @endif
    </script>
@endsection
