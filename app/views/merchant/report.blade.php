@extends('layout.merchant')

@section('isi')
    <div class="container-fluid">
          <div class="row">
                    <div class="col-sm-12">
                      <div id="bordered">
                          <h3>Perhitungan Hasil</h3>
                          <div style="margin-bottom:10px;">
                            <form action="{{URL::to('merchant/generateReport')}}" method="get" target="_blank">
                              <div class="col-lg-6">
                                <div class="input-group">
                                  <span class="input-group-addon">
                                    Tanggal Approved Mulai :
                                  </span>
                                  <input type="date" class="form-control" name="start_date" value="{{Input::get('start_date')}}" required/>
                                </div><!-- /input-group -->
                              </div><!-- /.col-lg-6 -->
                              <div class="col-lg-6">
                                <div class="input-group">
                                  <span class="input-group-addon">
                                    Sampai Approved Tanggal :
                                  </span>
                                  <input type="date" class="form-control" name="end_date" value="{{Input::get('end_date')}}" required/>
                                </div><!-- /input-group -->
                              </div><!-- /.col-lg-6 -->
                              <button style="margin-top:5px;" class="btn btn-primary" type="submit">Apply</button>
                            </form>
                          </div>
                        </div>
                        <div id="bordered">
                          <h3>Laporan Hasil</h3>
                              <div class="table-responsive">
                                    <table class="table table-striped">
                                      <tr>
                                        <th scope="col">Order ID</th>
                                        <th scope="col">Nama Customer</th>
                                        <th scope="col">Alamat</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Kurir/Paket</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Opsi</th>
                                      </tr>
                                      @foreach($transactions as $transaction)
                                        <tr>
                                          <td>{{$transaction->id}}
                                          <!-- <div class="alert-danger" align="center">4 Hari lagi</div></td> -->
                                          <td>{{$transaction->user_name}}</td>
                                          <td>{{$transaction->user_address}}</td>
                                          <!--
                                          <td>Tongsis Pink Stonic</td>
                                          <td>2</td>
                                          -->
                                          <td>Rp. {{$transaction->total}},-</td>
                                          <td>.{{$transaction->shipping_choice}}/{{$transaction->shipping_type}}</td>
                                          <!--
                                          <td class="nols">
                                              <a href="#"><li><span class="glyphicon glyphicon-ok"></span> Terima</li></a>
                                              <a href="#"><li><span class="glyphicon glyphicon-remove"></span> Tolak</li></a>
                                          </td>
                                          -->
                                          @if(isset($transaction->resi))
                                            <td class="alert-success">Dikirim</td>
                                          @else
                                            <td class="alert-danger">Belum dikirim</td>
                                          @endif
                                          <td class="nols">
                                              <a href="{{URL::to('merchant/reportDetail?id='.$transaction->id)}}"><li><span class="glyphicon glyphicon-file"></span> Detail</li></a>
                                          </td>
                                        </tr>
                                        
                                    @endforeach
                                    </table>
                               </div> 

                        </div>

                  </div>
               
            </div>
    </div>
@stop