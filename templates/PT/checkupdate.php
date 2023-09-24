<?php 
/**
* 注册信息验证
*/
session_start();
// $user_name = $_POST['username'];
// $START_TIME = $_POST['START_TIME'];
// $POSE = $_POST['POSE'];
// $MAX_ANGLE = $_POST['MAX_ANGLE'];
// $I_FEEDBACK = $_POST['I_FEEDBACK'];
$vid_num = $_POST['vid_num'];
$pt_feedback = $_POST['pt_feedback'];

$dbhost = "152.70.81.246:33306";
$charset = 'utf8';
$dbname = "HBSR";	//数据库名称
$dbuser = "root";		//数据库用户名
$dbpass = "880501";	//数据库密码
$tbname = 'RECORD'; 	//表格名

try{
	$conn = new PDO("mysql:host=$dbhost; dbname=$dbname; charset=$charset", $dbuser, $dbpass);
	$sql = "UPDATE `RECORD` SET PT_FEEDBACK=? WHERE VID_NUM='$vid_num'";
	$stmt = $conn->prepare($sql);			
	
	$stmt->bindValue(1,$pt_feedback);//绑定参数
	
	$count = $stmt->execute();//执行预处理语句
	echo"<script type='text/javascript'>alert('修改成功');location='PT_historylog.php';</script>";  

	$stmt = null;//释放
	$conn = null; // 关闭连接
}
catch(PDOException $e)
{
	echo $e->getMessage();	
}	
?>
