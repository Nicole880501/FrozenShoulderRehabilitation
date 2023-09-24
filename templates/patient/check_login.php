<?php 
/**
* 登录验证
*/
session_start();
    $dbhost = "152.70.81.246:33306";
$charset = 'utf8';
$dbname = "HBSR";	//数据库名称
$dbuser = "root";		//数据库用户名
$dbpass = "880501";	//数据库密码
$tbname = 'inv'; 	//表格名
$i_id = $_POST["i_id"];  
$i_pw = $_POST["i_pw"];  

try
{
	$conn = new PDO("mysql:host=$dbhost;dbname=$dbname;charset=$charset", $dbuser, $dbpass);
	$sql = "SELECT * FROM `INV` where I_ID='$i_id'and I_PW='$i_pw'";
	//$patient_name = "SELECT I_NAME FROM INV where I_ID='$i_id' and I_PW='$i_pw'";
	
	if ( $query = $conn->query($sql) ) 
	{
		if($query->rowCount()<1)	//如果数据库中找不到对应数据
		{
			echo"<script type='text/javascript'>alert('帳號或密碼錯誤'); location='login.php';</script>";  
		}
		else
		{	
			$_SESSION['i_id'] = $i_id;
			echo"<script type='text/javascript'>location='homepage.php';</script>";
		}
	}
	else
	{
		echo "Query failed\n";
	}
	$conn = null; // 关闭连接
}
catch(PDOException $e)
{
	echo $e->getMessage();
}

?>