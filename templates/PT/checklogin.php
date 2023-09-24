<?php 
session_start();
$dbhost = "152.70.81.246:33306";
$charset = 'utf8';
$dbname = "HBSR";
$dbuser = "root";
$dbpass = "880501";
$tbname = 'pt';
$pt_id = addslashes($_POST["pt_id"]);  
$pt_pw = addslashes($_POST["pt_pw"]);  

try
{
	$conn = new PDO("mysql:host=$dbhost; dbname=$dbname; charset=$charset", $dbuser, $dbpass);
	$sql = "SELECT * FROM PT where PT_ID='$pt_id'and PT_PW='$pt_pw'";
	
	if ( $query = $conn->query($sql) ) 
	{
		if($query->rowCount()<1)
		{
			echo"<script type='text/javascript'>alert('帳號或密碼錯誤'); location='PT_login.php';</script>";  
		}
		else
		{	
			$_SESSION['pt_id'] = $pt_id;
			echo"<script type='text/javascript'>location='PT_homepage.php';</script>";
		}
	}
	else
	{
		echo "Query failed\n";
	}
	$conn = null;
}
catch(PDOException $e)
{
	echo $e->getMessage();
}

?>