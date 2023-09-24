<?php 
/**
* 注册信息验证
*/
session_start();

$c_name = $_POST['c_name'];
$c_id = $_POST['c_id'];
$c_tel = $_POST['c_tel'];
$c_pw = $_POST['c_pw']; 

$dbhost = "152.70.81.246:33306";
$charset = 'utf8';
$dbname = "hbsr";	//数据库名称
$dbuser = "root";		//数据库用户名
$dbpass = "880501";	//数据库密码
$tbname = 'ptc'; 	//表格名
try
{
	if($c_pw!=$c_id)
	{
		$conn = new PDO("mysql:host=$dbhost;dbname=$dbname;charset=$charset", $dbuser, $dbpass);
		$sql = "update ptc set C_ID=?,C_PW=?,C_NAME=?,C_TEL=?where C_ID = $c_id";
		$stmt = $conn->prepare($sql);			
		$stmt->bindValue(1,$c_id);//绑定参数
		$stmt->bindValue(2,$c_pw);//绑定参数
		$stmt->bindValue(3,$c_name);//绑定参数
		$stmt->bindValue(3,$c_tel);//绑定参数
		$count = $stmt->execute();//执行预处理语句
		echo"<script type='text/javascript'>alert('修改成功');location='admin_homepage.php';</script>";  
	}
	else
	{
		echo"<script type='text/javascript'>alert('修改密碼失敗，請不要與帳號相同!'); location='admin_account.php';</script>";  
	}
	$stmt = null;//释放
	$conn = null; // 关闭连接
}
catch(PDOException $e)
{
	echo $e->getMessage();	
}
	
?>
