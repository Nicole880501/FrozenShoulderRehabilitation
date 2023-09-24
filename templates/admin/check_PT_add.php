<?php 
/**
* 注册信息验证
*/
session_start();
if($_SESSION["validcode"] != $_POST['codeNum'])
{
	echo"<script type='text/javascript'>alert('驗證碼錯誤，註冊失敗!'); location='studentadd.php';</script>";  
}
else
{
	$pt_id=$_POST['pt_id'];
	$pt_pw=$_POST['pt_pw'];
	$pt_name=$_POST['pt_name'];
	$pt_tel=$_POST['pt_tel'];
	$c_id=$_POST['c_id'];
	$dbhost = "152.70.81.246:33306";
	$charset = 'utf8';
	$dbname = "hbsr";	//数据库名称
	$dbuser = "root";		//数据库用户名
	$dbpass = "880501";	//数据库密码
	$tbname = 'pt'; 	//表格名

	try
	{
		$conn = new PDO("mysql:host=$dbhost;dbname=$dbname;charset=$charset", $dbuser, $dbpass);
		$sql = "INSERT INTO inv(PT_ID,PT_PW,PT_NAME,PT_TEL,C_ID) VALUES(?,?,?,?,?,?,?)";
		$stmt = $conn->prepare($sql);			
		$stmt->bindValue(1,$pt_id);//绑定参数
		$stmt->bindValue(2,$pt_pw);
		$stmt->bindValue(3,$pt_name);
		$stmt->bindValue(4,$pt_tel);
		$stmt->bindValue(5,$c_id);

		$count = $stmt->execute();//执行预处理语句
		if($count<>0)
		{
			echo"<script type='text/javascript'>alert('新增成功');location='admin_PT.php';</script>";  
		}
		else
		{
			echo"<script type='text/javascript'>alert('新增失敗'); location='admin_PT_add.php';</script>";  
		}
		$stmt = null;//释放
		$conn = null; // 关闭连接
	}
	catch(PDOException $e)
	{
		echo $e->getMessage();	
	}
}
	
?>
