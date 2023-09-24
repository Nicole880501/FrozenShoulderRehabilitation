<?php
session_start();
header("Content-Type:text/html;charset=utf-8");
?>	
<html>
	<head>
		<meta  charset="utf-8">
		<meta content="width=device-width, initial-scale=1.0" name="viewport">
		<title>登入</title>
		<link href="../../../static/css/C.css" rel="stylesheet" type="text/css" />
	</head>
    <body> 																				<!----------- 補id="page1" -------------->
		<div class="box" style="text-align:center;"> 
            <h2 style="margin-top:35px;">民眾登入</h2>
            <form action='/check_login.php' method="post" enctype="multipart/form-data">
                <div class="inputBox">
                    <input type="text" name="i_id" value="" required="required" placeholder=
                        "             請輸入您的身分證字號" pattern="[A-Z]{1}[1-2]{1}[0-9]{8}" title="輸入身分證"><label>身分證字號</label></div>
                <div class="inputBox">
                    <input type="password" name="i_pw" value=""	required="required" placeholder=
                        "             請輸入您的密碼"><label>密碼</label></div>
                        
                <input type="submit" name="submit" value="登入" >
            </form>
            
		</div>
	</body>
</html>