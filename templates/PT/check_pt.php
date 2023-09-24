<?php 

session_start();
$pt_id = $_POST['pt_id'];
$pt_pw = $_POST['pt_pw'];
$pt_tel = $_POST['pt_tel'];

$dbhost = "152.70.81.246:33306";
$charset = 'utf8';
$dbname = "HBSR";	//数据库名称
$dbuser = "root";		//数据库用户名
$dbpass = "880501";	//数据库密码
$tbname = 'PT'; 	//表格名
try
{
	if($pt_pw!="")
	{
		$conn = new PDO("mysql:host=$dbhost; dbname=$dbname; charset=$charset", $dbuser, $dbpass);
		$sql = "UPDATE `pt` SET PT_PW=?, PT_TEL=? WHERE PT_ID = '$pt_id'";
		$stmt = $conn->prepare($sql);

		// $stmt->bindValue(1,$pt_id);
		$stmt->bindValue(1,$pt_pw);//绑定参数
		$stmt->bindValue(2,$pt_tel);//绑定参数

		$count = $stmt->execute();//执行预处理语句
		echo"<script type='text/javascript'>alert('修改成功');location='PT_homepage.php';</script>";  
	}
	else
	{
		echo"<script type='text/javascript'>alert('修改資料失敗!'); location='PT_account.php';</script>";  
	}
	$stmt = null;//释放
	$conn = null; // 关闭连接
}
catch(PDOException $e)
{
	echo $e->getMessage();	
}

?>
