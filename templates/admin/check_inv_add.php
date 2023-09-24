<?php 
/**
* 注册信息验证
*/
session_start();

$i_id=$_POST['i_id'];
$i_pw=$_POST['i_pw'];
$i_name=$_POST['i_name'];
$i_bd=$_POST['i_bd'];
$i_num=$_POST['i_num'];
$i_tel=$_POST['i_tel'];
$c_id=$_POST['c_id'];
$dbhost = "152.70.81.246:33306";
$charset = 'utf8';
$dbname = "hbsr";	//数据库名称
$dbuser = "root";		//数据库用户名
$dbpass = "880501";	//数据库密码
$tbname = 'inv'; 	//表格名

try
{
	$conn = new PDO("mysql:host=$dbhost;dbname=$dbname;charset=$charset", $dbuser, $dbpass);
	$sql = "INSERT INTO inv(I_ID,I_PW,I_NAME,I_BD,I_NUM,I_TEL,C_ID) VALUES(?,?,?,?,?,?,?)";
	$stmt = $conn->prepare($sql);			
	$stmt->bindValue(1,$i_id);//绑定参数
	$stmt->bindValue(2,$i_pw);
	$stmt->bindValue(3,$i_name);
	$stmt->bindValue(4,$i_bd);
	$stmt->bindValue(5,$i_num);
	$stmt->bindValue(6,$i_tel);
	$stmt->bindValue(7,$c_id);

	$count = $stmt->execute();//执行预处理语句
	if($count<>0)
	{
		echo"<script type='text/javascript'>alert('新增成功');location='admin_patient.php';</script>";  
	}
	else
	{
		echo"<script type='text/javascript'>alert('新增失敗'); location='admin_inv_add.php';</script>";  
	}
	$stmt = null;//释放
	$conn = null; // 关闭连接
}
catch(PDOException $e)
{
	echo $e->getMessage();	
}


?>
