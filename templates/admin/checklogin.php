<?php 
/**
* 登录验证
*/
session_start();
$dbhost = "152.70.81.246:33306";
$charset = 'utf8';
$dbname = "hbsr";	//数据库名称
$dbuser = "root";		//数据库用户名
$dbpass = "880501";	//数据库密码
$tbname = 'ptc'; 	//表格名
$c_id = $_POST["c_id"];  
$c_pw = $_POST["c_pw"];  

try
{
	$conn = new PDO("mysql:host=$dbhost;dbname=$dbname;charset=$charset", $dbuser, $dbpass);
	$sql = "SELECT * FROM `ptc` where C_ID='$c_id'and C_PW='$c_pw'";

	
	if ( $query = $conn->query($sql) ) 
	{
		if($query->rowCount()<1)	//如果数据库中找不到对应数据
		{
			echo"<script type='text/javascript'>alert('帳號或密碼錯誤'); location='admin_login.php';</script>";  
		}
		else
		{	
			$_SESSION['c_id'] = $c_id;
			echo"<script type='text/javascript'>alert('歡迎進入居家自主復健系統');location='admin_homepage.php';</script>";
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