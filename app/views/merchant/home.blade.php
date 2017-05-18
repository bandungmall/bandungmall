@extends('layout.frontend_without')

@section('isi')
    <div id="bordered" style="margin: 20px;">
          <h3>Area Merchant</h3>
            <hr />
            <div class="">
              <div class="col-sm-12">
                <h6>Apa itu merchant?</h6>
                  <p>Merchant dalam goget.com adalah seller yang menjual dagangannya melalui goget.com</p>
                </div>
            </div>
            <hr />
          <div class="row" align="center">
              <div class="col-sm-6">
                    <p>Jadilah merchant di goget.com</p>
                    <a href="{{URL::to('merchant/register')}}"><button class="btn btn-primary"s type="button">Daftar Merchant</button></a>
                </div>
                <div class="col-sm-6">
                  <p>Sudah terdaftar sebagai merchant</p>
                    <a href="{{URL::to('merchant/login')}}"><button class="btn btn-primary"s type="button">Login Merchant</button></a>
                
                </div>
            </div>
        </div>
@stop