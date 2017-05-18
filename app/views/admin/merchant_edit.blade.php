@extends('layout.admin')

@section('isi')
  <div class="col-sm-8 col-md-9 col-xs-12 contentwrap">
    <div class="row">
        <div class="col-sm-12 customercontrolwrap">
            <div class="wrap-header">
                <h4>Tambah Merchant</h4>
              </div>
              <div class="wrap-content">
                <form role="form" action="{{URL::to('admin/merchant/editMerchantLogin/doEditMerchantLogin')}}" method="post">
                  <div class="form-group">
                    <label for="meremail">Email Merchant:</label>
                    <input type="email" name="email" class="form-control" id="meremail" placeholder="Alamat email merchant" value="{{$merchant->email}}" disabled/>
                  </div>
                  <div class="form-group">
                    
                  </div>
                  <input type="hidden" name="merchant_id" value="{{$merchant->id}}" />
                  <button class="btn btn-primary" type="submit">Apply</button>
                </form>
              </div>
          </div>
      </div>
  </div>
@stop