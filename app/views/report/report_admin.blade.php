<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<style>
body{
	font-family:Arial, Helvetica, sans-serif;	
}

a{
	color:#0066FF;
	text-decoration:none;
	
}

table td,table th{
	text-align:center;	
	border:1px solid #000;
	height:40px;
	font-size:16px;
	color:#666666;
}

table th{
	color:#FFF;
	background:#000;	
}

tfoot th{
	color:#000;
	background:#FFF;
}

</style>
<body>
		<div align="center">
        	<div>
   	    		<img src="{{asset('public/img/tokcer.png')}}" />
            	<hr />
            </div>
        </div>
        <div align="center">
        	<div style="width:80%" align="left">
                <p>
                    <strong>Tanggal Laporan:</strong> {{$start_date}}  sd  {{$end_date}}<br />
                </p>
            </div>
	<div align="center">
               	<table align="center" style="border-collapse:collapse;margin-top:20px">
                	<tr>
                    	<th>Tanggal</th>
                        <th>Nama Merchant</th>
                        <th>Fee</th>
                        {{--<th>User Commision</th>--}}
                        <th>Total</th>
                	</tr>
                    <?php
                        $total_harga = 0;
                    ?>
                    @foreach($mlm_merchants as $detail)
                        <?php
                            $temp_fee = $detail->quantity*$detail->price *($detail->percentage/100);
                            //$total_harga += ($temp_fee-$user_commision[$detail->transaction_detail_id]);
                            $total_harga += $temp_fee;
                        ?>
                        <tr>
                        	<td>{{date_format(new datetime($detail->created_at), 'g:ia jS F Y')}}</td>
                            <td>{{$detail->shop_name}}</td>
                        	<td>{{$detail->percentage.'%'}}<br />RP. {{number_format($temp_fee, 0, '', '.');}}</td>
                            {{--<td>RP. {{number_format($user_commision[$detail->transaction_detail_id], 0, '', '.');}}</td>--}}
                            {{--<td>RP. {{number_format($temp_fee-$user_commision[$detail->transaction_detail_id], 0, '', '.');}}</td>--}}

                       	</tr>
                    @endforeach
                    
                    <tfoot>
                        <tr>
                            <th colspan="3">Total</th>
                            <th>RP. {{number_format($total_harga, 0, '', '.');}}</th>
                        </tr>
                        
                   	</tfoot>
                </table>
            </div>
            <!--
            <div style="width:80%" align="left">
            	<p>Total akan ditransfer pada tanggal <strong>06/12/2015</strong> atas nama <strong>PT.GOGET</strong> <br />
                Terima kasih.</p>
            </div>
        -->
       	</div>
</body>
</html>