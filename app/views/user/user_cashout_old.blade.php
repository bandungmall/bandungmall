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
                <h3>Cashout</h3>
                    <hr />
                    <form role="form" action="{{URL::to('user/cashout/doCashout')}}" method="post">
                      <div class="form-group">
                        <label for="outrek">No rekening:</label>
                        <input type="text" name="account_number" class="form-control" id="outrek" placeholder="Nomor rekening" required/>
                      </div>
                      <div class="form-group">
                        <label for="outnama">Atas nama:</label>
                        <input type="text" name="account_name" class="form-control" id="outnama" placeholder="Atas nama" required/>
                      </div>
                      <div class="form-group">
                        <label for="outnama">Nama bank:</label>
                        <input type="text" name="account_bank" class="form-control" id="outnama" placeholder="Nama bank" required/>
                      </div>
                      <p class="detail">*Akan diproses dalam 1-7hari</p>
                      <button type="submit" class="btn btn-primary">Transfer</button>
                    </form>
              </div>
            </div>
      </div>
    </div>
@stop