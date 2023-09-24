<?php
    session_start();
    header("Content-Type: text/html; charset= utf-8");
    include("conmysql.php");  
    // connect with database  
    $seldb = mysqli_select_db($link, "HBSR")  
        or die("資料庫選擇失敗！");
    
    $vid = $_GET["VID_NUM"];
    
     
    //SQL查詢
    try{
        $sql = "SELECT * FROM `RECORD` INNER JOIN `INV` ON INV.I_ID = RECORD.I_ID where VID_NUM='$vid'"; //患者姓名
        mysqli_query($link, "SET names 'utf8'");
        $result = mysqli_query($link, $sql);
        $row_result = mysqli_fetch_assoc($result);
    }
    catch(mysqli_query_exception $e) {
        var_dump($e);
        exit;
    }
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>復健記錄詳情查看</title>
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
          <li><a href="PT_historylog.php"><i class='bx bx-folder'></i> <span>復健紀錄</span></a></li>
		  <li><a href="PT_account.php"><i class="bx bx-briefcase"></i> <span>物理治療師資料管理</span></a></li>
		  <li><a href="../index.php"><i class='bx bx-log-out'></i> <span>登出</span></a></li>
        </ul>
      </nav>
    </header>
    <main id="main" style='margin-top: 0;'>
      <section id="contact" class="contact">
        <div class="container" data-aos="fade-up">
          <div class="section-title">
            <h2>復健記錄詳情查看</h2>
          </div>

          <div class="row mt-1">
            <div class="col-lg-8 mt-5 mt-lg-0">
              <form action="checkupdate.php" method="post" > 
              <?php
                if($_SESSION['pt_id'] != null){
                echo'<div class="row">';
                  echo'<div class="col-md-6 form-group">';
                  echo"姓名";
                  echo'<input type="text" name="i_name" class="form-control" value='.$row_result["I_NAME"].' readonly/>';
                  echo'<div class="validate"></div>';
                  echo'</div>';
                  
                  echo'<div class="col-md-6 form-group">';
                  echo'時間';
                  echo'<input type="text" name="start_time" class="form-control" value='.$row_result["START_TIME"].' readonly/>';
                  echo'<div class="validate"></div>';
                  echo'</div>';
                echo'</div>';
                
                echo'<div class="row">';
                  echo'<div class="col-md-6 form-group">';
                  echo'動作';
                  echo'<input type="tel" class="form-control" name="pose" value='.$row_result["POSE"].' readonly />';
                  echo'<div class="validate"></div>';
                  echo'</div>';
                  
                  echo'<div class="col-md-6 form-group">';
                  echo'最大角度';
                  echo'<input type="text" name="max_angle" class="form-control" value='.$row_result["MAX_ANGLE"].' readonly />';
                  echo'<div class="validate"></div>';
                  echo'</div>';
                echo'</div>';
                
				echo'<div class="row">';
                  echo'<div class="form-group mt-3">';
                  echo'民眾心得';
                  echo'<input type="text" name="i_feedback" class="form-control" value='.$row_result["I_FEEDBACK"].' readonly/>';
                  echo'<div class="validate"></div>';
                  echo'</div>';
                echo'</div>';
				
				echo'<div class="row">';
                  echo'<div class="form-group mt-3">';
                  echo'復健影片檔';
                  echo'<input type="text" name="vid_num" class="form-control" value='.$row_result["VID_NUM"].' readonly/>';
                  echo'<div class="validate"></div>';
                  echo'</div>';
                echo'</div>';
				
                echo'<div class="row">';
                  echo'<div class="form-group mt-3">';
                  echo'物治師回饋';
                  echo'<input type="text" name="pt_feedback" class="form-control" value='.$row_result["PT_FEEDBACK"].'/>';
                  echo'<div class="validate"></div>';
                  echo'</div>';
                echo'</div>';
                
                echo'<div class="text-center loginbtn"><button type="submit">儲存修改資料</button></a></div>';
				echo'<a href="PT_historylog.php"><div class="text-center loginbtn"><button>回到復健紀錄</button></div></a>';
              }	
              else{
                echo "<script type='text/javascript'>alert('請登入');location='../index.php';</script>";
              }
              ?>
			      </form>
			  
            </div>
          </div>
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