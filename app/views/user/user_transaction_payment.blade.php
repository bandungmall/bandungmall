@extends('user.templates.layout')

@section('content')
<div class="container main-container headerOffset">
    <div class="row">
        <div class="breadcrumbDiv col-lg-12">
            <ul class="breadcrumb">
                <li><a href="{{URL::to('/')}}">Home</a></li>
                <li class="active">Payment Confirmation</li>
            </ul>
        </div>
    </div>
    <!--/.row-->


    <div class="row">
        <div class="col-lg-12 ">
            <div class="row userInfo">

                <div class="thanxContent text-center">

                   

                </div>

                <div class="col-lg-7 col-center">
                    <h4></h4>

                    <div class="cartContent table-responsive  w100">
                        <table style="width:100%" class="cartTable cartTableBorder">
                            <tbody>

                            <tr class="CartProduct  cartTableHeader">
                                <td colspan="2"> Barang yang akan dikirim</td>

                                 
                                <td style="width:15%"></td>
                            </tr>
                            
                            </tbody>
                        </table>
                        <div class="cartFooter w100">
                            <div class="box-footer">
                                
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!--/row end-->

        </div>

        <!--/rightSidebar-->

    </div>
    <!--/row-->
    <div class="gap"></div>

    <div class="row">
            <div class="col-sm-6">
                <div id="bordered">
                    <p>Total pembelian anda sebesar <strong class="text-info">Rp. {{number_format($info->total, 0, '', '.');}},- </strong>(sudah termasuk ongkos kirim)</p>
                    <ul class="padbottom">
                    <li>Silahkan di transfer ke salah satu nomor rekening yang tertera dibawah ini.<strong>(BCA)</strong></li>
                    <li>Setelah itu masukkan nomor rekening yang anda gunakan dan nominal yang di transfer pada kotak <strong>Konfirmasi Pembayaran</strong> untuk melanjutkan transaksi.</li>
                    
                    </ul>
                    <h3>Nomor rekening bandungmall.com</h3>
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
                        <form action="{{ URL::to('user/doInsertPaymentConfirmation') }}" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="norek">Upload Bukti:</label>
                                <input type="file" name="images[]" id="images" class="form-control" required/>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="transaction_id" value="{{$info->transaction_id}}" />
                                <input type="submit" class="btn btn-primary" value="UPLOAD"/>
                            </div>
                        </form>
                </div>
            </div>
        
        </div>
</div>
<!-- /.main-container -->

<div class="gap"></div>
@endsection
<script type="text/javascript">
function run(){
    var bank_id = $("#bankSelector").val();
    $.ajax({
        data: 'bank_id='+bank_id,
        url: "getAccountBank", 
        success: function(result){
            if(result.length > 0){
                $("#account_name").val(result[0]['nama_rekening']);
                $("#account_number").val(result[0]['no_rekening']);
            }else{
                $("#account_name").val('');
                $("#account_number").val('');
            }
        }
    });
    document.getElementById("bank_id").value = document.getElementById("bankSelector").value;
}
</script>