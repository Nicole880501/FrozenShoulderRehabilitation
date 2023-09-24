<?php
    session_start();
	header("Content-Type: text/html; charset=utf-8");
	include("conmysql.php");
	$seldb = @mysqli_select_db($link, "HBSR");
	if (!$seldb) die("資料庫選擇失敗！");
	$i_id = $_SESSION['i_id'];
	//SQL查詢
	//$sql_inv = "SELECT * FROM `inv` where I_ID=$id";
	$sql_record = "SELECT * FROM `RECORD` where I_ID = '$i_id'";
	//$userinfo = mysqli_query($db_link, $sql_user);
	//$result = mysqli_query($db_link, $sql_query);  
    
    $record_info = mysqli_query($link, $sql_record); 
?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>歷史紀錄</title>
    <link href="../../static/img/desktop_icon.png" rel="icon">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/icofont/icofont.min.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets/vendor/venobox/venobox.css" rel="stylesheet">
    <link href="../assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
  </head>
  <body>
	<button type="button" class="mobile-nav-toggle d-xl-none"><i class="icofont-navigation-menu"></i></button>
    <header id="header" class="d-flex flex-column justify-content-center">
      <nav class="nav-menu">
        <ul>
          <li class="active"><a href="homepage.php"><i class='bx bx-store'></i> <span>首頁</span></a></li>
		  <li><a href="training.php"><i class='bx bx-dumbbell'></i> <span>開始訓練</span></a></li>
          <li><a href="user_account.php"><i class="bx bxs-face"></i> <span>個人資料管理</span></a></li>
		  <li><a href="../index.php"><i class='bx bx-log-out'></i> <span>登出</span></a></li>
        </ul>
      </nav>
    </header>
    <main id="main" style="margin-left:15%;">
      <section id="contact" class="contact">
        <div class="container" data-aos="fade-up">
          <div class="section-title">
            <h2>歷史紀錄</h2>
          </div>
		  
		  	<table align="center">
				<!-- 表格表頭 -->
				<thead>
					 <th>日期</th>
					 <th>動作種類</th>
					 <th>最佳角度</th>
					 <!--
					 <th>民眾心得</th>
					 <th>影片紀錄</th>
					 -->
					 <th>物治師處理狀態</th>
					 <!--
					 <th>物治師回饋</th>
					 -->
					 <th>詳情</th>
					 

				</thead>
				<!-- 資料內容 -->
				<tbody>
				
				<?php
                if($_SESSION['i_id'] != null)
				{
                    while ($row_result = mysqli_fetch_assoc($record_info)) {
						echo "<tr>";

						echo "<td>".$row_result["START_TIME"]."</td>";  //Datetime,動作種類,最佳角度,影片紀錄,物治師回饋,民眾回饋
						echo "<td>".$row_result["POSE"]."</td>"; 
						echo "<td>".$row_result["MAX_ANGLE"]."度"."</td>";
						//echo "<td>".$row_result["I_FEEDBACK"]."</td>"; //患者心得
						//echo "<td>".$row_result["VID_NUM"]."</td>";
						if ($row_result["PT_FEEDBACK"] != null){ //判斷物治師是否看過
							echo "<td style='color:#556b2f;'>"."已完成"."</td>"; 
						}
						else{
							echo "<td style='font-color:#b22222;'>"."待處理"."</td>"; 
						}    
						//echo "<td>".$row_result["PT_FEEDBACK"]."</td>";
						echo "<td><button><a href='feedback.php?VID_NUM=".$row_result["VID_NUM"]."' >查看</a></button> ";
						echo "</tr>";
                    }
                }else
				{
					echo "<script type='text/javascript'>alert('請登入');location='../index.php';</script>";
					//echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
				}
              ?>				
				</tbody>
				</table>
		  
        </div>
      </section>
    </main>

    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/jquery.easing/jquery.easing.min.js"></script>
    <script src="../assets/vendor/php-email-form/validate.js"></script>
    <script src="../assets/vendor/waypoints/jquery.waypoints.min.js"></script>
    <script src="../assets/vendor/counterup/counterup.min.js"></script>
    <script src="../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="../assets/vendor/venobox/venobox.min.js"></script>
    <script src="../assets/vendor/owl.carousel/owl.carousel.min.js"></script>
    <script src="../assets/vendor/typed.js/typed.min.js"></script>
    <script src="../assets/vendor/aos/aos.js"></script>
    <script src="../assets/js/main.js"></script>

  </body>

</html>