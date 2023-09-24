<?php 
/**
* 注册信息验证
*/
session_start();
$i_id = $_POST['i_id'];
$c_id = $_POST['c_id'];
$i_num = $_POST['i_num'];
$i_name = $_POST['i_name'];
$i_pw = $_POST['i_pw'];
$i_bd = $_POST['i_bd'];
$i_tel = $_POST['i_tel'];

$dbhost = "152.70.81.246:33306";
$charset = 'utf8';
$dbname = "HBSR";	//数据库名称
$dbuser = "root";		//数据库用户名
$dbpass = "880501";	//数据库密码
$tbname = 'INV'; 	//表格名
try
{
	if($i_pw!=$i_id)
	{
		$conn = new PDO("mysql:host=$dbhost;dbname=$dbname;charset=$charset", $dbuser, $dbpass);
		$sql = "update INV set I_ID=?,C_ID=?,I_NUM=?,I_NAME=?,I_PW=?,I_BD=?,I_TEL=? where I_ID = '$i_id'";
		$stmt = $conn->prepare($sql);			
		$stmt->bindValue(1,$i_id);//绑定参数
		$stmt->bindValue(2,$c_id);//绑定参数
		$stmt->bindValue(3,$i_num);//绑定参数
		$stmt->bindValue(4,$i_name);//绑定参数
		$stmt->bindValue(5,$i_pw);//绑定参数
		$stmt->bindValue(6,$i_bd);//绑定参数
		$stmt->bindValue(7,$i_tel);//绑定参数
		$count = $stmt->execute();//执行预处理语句
		echo"<script type='text/javascript'>alert('修改成功');location='homepage.php';</script>";  
	}
	else
	{
		echo"<script type='text/javascript'>alert('修改密碼失敗，請不要與帳號相同!'); location='student.php';</script>";  
	}
	$stmt = null;//释放
	$conn = null; // 关闭连接
}
catch(PDOException $e)
{
	echo $e->getMessage();	
}

?>
