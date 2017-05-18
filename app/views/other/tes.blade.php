<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
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

</style>
<body>
	<div style="margin:50px;padding:20px;border:1px solid #000">
    	<div>
   	    	<img src="{{asset('public/img/header.png')}}" width="1250" height="180" />
            <hr />
        </div>
        <div>
        	<div>
            	<p>Dear(username),<br />
					Anda telah merequest reset password. Silahkan klik <a href="{{$link}}">disini</a> untuk melanjutkan.<br /><br />
                    Jika bukan Anda yang meminta reset password, abaikan email ini.
					</p>
            
            </div>
            
       	</div>
        <div style="padding-top:30px">
        	<hr />
        	<div align="center" style="width:100%;padding-top:15px">
            	<div style="display:inline;text-align:center">
       	    		<a href="#"><img  src="{{asset('public/img/sos/facebook.png')}}" width="64" height="64" /></a>
                </div>
                <div style="display:inline;text-align:center">
       	    		<a href="#"><img  src="{{asset('public/img/sos/twitter.png')}}" width="64" height="64" /></a>
               	</div>
                <div style="display:inline;text-align:center">
       	    		<a href="#"><img  src="{{asset('public/img/sos/insta.png')}}" width="64" height="64" /></a>  
               	</div>                              
            </div>
            <div align="center">
            	<div style="padding-top:20px">
            		<p>Punya pertanyaan atau keluhan?<br />
						Silahkan hubungi kami.<br />
						Email: admin@tokocerdas.com<br />
						<!-- Telp: +62 821 808 8088</p> -->
				</div>
                <div style="padding-top:20px">
                	<p>@2015 tokocerdas.com | CV Nusantara Artifisial<br />
						Jl. Senen raya no.12 Senen, Jakarta pusat, DKI jakarta
                	</p>
                    <a href="#"> unsubscribe</a>
                </div>
            </div>

        </div>
   	</div>
</body>
</html>
