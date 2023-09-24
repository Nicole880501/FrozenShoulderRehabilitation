<!-- 註冊的頁面 -->
<?php
session_start();
// if($_SESSION["validcode"] != $_POST['codeNum'])
// {
// 	echo"<script type='text/javascript'>alert('驗證碼錯誤，註冊失敗!'); location='register.html';</script>";  
// }
// else
// {
	$user=$_POST['AAA'];
	$pass=$_POST['SSS'];
	$name=$_POST['DDD'];
	$email=$_POST['ZZZ'];
	$cellphone=$_POST['XXX'];
	$unit=$_POST['CCC'];
	$confirm=$_POST['QQQ'];
	$dbhost = "FFF.FFF.FFF.FFF";
	$charset = 'utf8';
	$dbname = "QQQ";
	$dbuser = "QQQ";
	$dbpass = "QQQ";
	$tbname = 'QQQ';
	if($pass!=$confirm)
	{    
		echo "<script>alert('兩次密碼不一致');location='register.html';</script>";
	}
	else
	{	
		try
		{
			$conn = new PDO("mysql:host=$dbhost;dbname=$dbname;charset=$charset", $dbuser, $dbpass);
			$sql = "INSERT INTO ZZZ(usernumber,password,name,email,cellphone,unit,teachernum) VALUES(?,?,?,?,?,?,?)";
			$stmt = $conn->prepare($sql);			
			$stmt->bindValue(1,$user);
			$stmt->bindValue(2,$pass);
			$stmt->bindValue(3,$name);
			$stmt->bindValue(4,$email);
			$stmt->bindValue(5,$cellphone);
			$stmt->bindValue(6,$unit);
			$count = $stmt->execute();
			if($count<>0)
			{
				echo"<script type='text/javascript'>alert('註冊成功');location='index.html';</script>";  
			}
			else
			{
				echo"<script type='text/javascript'>alert('註冊失敗'); location='register.html';</script>";  
			}
			$stmt = null;
			$conn = null;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();	
		}
	}
// }
?>
