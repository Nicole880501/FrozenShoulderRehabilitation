<?php
    session_start();
    header("Content-Type: text/html; charset= utf-8");
    include("conmysql.php");  
    
    // connect with database  
    $seldb = mysqli_select_db($link, "HBSR")  
        or die("資料庫選擇失敗！");  
    
    //SQL查詢
    // $sql = "SELECT * FROM `record` ";//其他紀錄
    $sql_2 = "SELECT * FROM `RECORD` INNER JOIN `INV` ON INV.I_ID = RECORD.I_ID"; //患者姓名

    // $vid = $_POST["VID_NUM"];
    mysqli_query($link, "SET names 'utf8'");    
    $result_2 = mysqli_query($link, $sql_2);
    // try{

    // }
?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>復健紀錄</title>
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
          <li class="active"><a href="PT_homepage.php"><i class='bx bx-store'></i> <span>首頁</span></a></li>
          <li><a href="PT_account.php"><i class="bx bx-briefcase"></i> <span>物理治療師資料管理</span></a></li>
		  <li><a href="../index.php"><i class='bx bx-log-out'></i> <span>登出</span></a></li>
        </ul>
      </nav>
    </header>
    <main id="main" style='margin-left: 10%;'>
      <section id="contact" class="contact">
        <div class="container" data-aos="fade-up">
          <div class="section-title">
            <h2>復健紀錄</h2>
          </div>
		  
		  	<table align="center">
				<!-- 表格表頭 -->
				<thead>
					 <th>日期</th>
					 <th>病患名字</th>
					 <th>動作種類</th>
					 <th>最佳角度</th>
					 <!--
					 <th>民眾心得</th>
					 -->
					 <!--
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
          if($_SESSION['pt_id'] != null){
            try{
                while ($row_result_2 = mysqli_fetch_assoc($result_2)){
                    echo "<tr>";
                    echo "<td>".$row_result_2["START_TIME"]."</td>";  //Datetime,動作種類,最佳角度,影片紀錄,物治師回饋,民眾回饋
                    echo "<td>".$row_result_2["I_NAME"]."</td>";
                    echo "<td>".$row_result_2["POSE"]."</td>"; 
                    echo "<td>".$row_result_2["MAX_ANGLE"]."度"."</td>";
					
					//echo "<td>".$row_result_2["I_FEEDBACK"]."</td>"; //患者心得
					
					
                    //echo "<td>".$row_result_2["VID_NUM"]."</td>";
					
                    if ($row_result_2["PT_FEEDBACK"] != null){ //判斷物治師是否看過
                        echo "<td style='color:#556b2f;'>"."已完成"."</td>"; 
                    }
                    else{
                        echo "<td style='font-color:#b22222;'>"."待處理"."</td>"; 
                    }
                    //echo "<td>".$row_result_2["PT_FEEDBACK"]."</td>";
                    echo "<td><button><a href='PT_feedback.php?VID_NUM=".$row_result_2["VID_NUM"]."' >查看</a></button> ";
                    echo "</tr>";
                }
            }
            catch(Exception $e){
                echo "Message:".$e->getMessage();
            }
          }
          else{
            echo "<script type='text/javascript'>alert('請登入');location='../index.php';</script>";
          }
              
        ?>
			  <!-- window.open('PT_feedback.php?id=',name='物理治療師回饋',config='height=500,width=500'); -->
        <!-- <script language="JavaScript" type="text/JavaScript"> 
            function open_window(url,winName,win_width,win_height) { 
                var PosX = (screen.width-win_width)/2; 
                var PosY = (screen.Height-win_height)/2; 
                features = "width="+(win_width/2)+",height="+(win_height/2)+",top="+PosY+",left="+PosX; 
                var newwin = window.open(url,winName,features);
            }
        </script> -->
				
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