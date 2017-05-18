@extends('layout.frontend')

@section('isi')
	<div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <div id="bordered">
                    <p>Total pembelian anda sebesar <strong class="text-info">Rp. {{number_format($transaction->total, 0, '', '.');}},- </strong>(sudah termasuk ongkir)</p>
                    <ul class="padbottom">
                    <li>Silahkan di transfer ke salah satu nomor rekening yang tertera dibawah ini.<strong>(BCA/MANDIRI)</strong></li>
                    <li>Setelah itu masukkan nomor rekening yang anda gunakan dan nominal yang di transfer pada kotak <strong>Konfirmasi Pembayaran</strong> untuk melanjutkan transaksi.</li>
                    
                    </ul>
                    <h3>Nomor rekening tokocerdas.com</h3>
                    <div class="table-responsive">
                        <table class="table">
                          <tr>
                            <th scope="row">BCA</th>
                            <td>2820105586</td>
                            <td>an. cv nusantara artifisial</td>
                          </tr>
                          <!--
                          <tr>
                            <th scope="row">Mandiri</th>
                            <td>XXXX-XXXX-XXXX</td>
                            <td>an. PT. goget.com</td>
                          </tr>
                          -->
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="col-sm-6">
                <div id="bordered">
                    <h3>Konfirmasi Pembayaran</h3>
                    <hr />
                        <form action="{{URL::to('user/doInsertPaymentConfirmation')}}" method="post" role="form">
                        <div class="form-group">
                            <label for="norek">Bank Rekening:</label>
                            <input type="text" name="account_bank" class="form-control" id="norek" placeholder="Bank rekening anda" />
                        </div>
                        <div class="form-group">
                            <label for="norek">Nama Rekening:</label>
                            <input type="text" name="account_name" class="form-control" id="norek" placeholder="Nama rekening anda" />
                        </div>
                        <div class="form-group">
                            <label for="norek">Nomor Rekening:</label>
                            <input type="text" name="account_number" class="form-control" id="norek" placeholder="Nomor rekening anda" />
                        </div>
                        <div class="form-group">
                            <label for="nominal">Nominal:</label>
                            <input type="text" name="amount" class="form-control" id="nominal" placeholder="Nominal yang anda transfer" />
                        </div>
                        <div class="form-group">
                            <label for="tiperek">Tujuan Transfer:</label>
                            <select name="account_destination" class="form-control" id="tiperek">
                                <option value="bca">BCA cv nusantara artifisial</option>
                                <!-- <option value="mandiri">Mandiri PT. goget</option> -->
                            </select>
                        </div>
                        <input type="hidden" name="transaction_id" value="{{$transaction->id}}" />
                        <button class="btn btn-primary" type="submit">Konfirmasi</button>
                    </form>
                </div>
            </div>
        
        </div>
    </div>    
@stop