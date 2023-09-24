<?php
    header("Content-Type: text/html; charset= utf-8");
    include("conmysql.php");  
    
    // connect with database  
    $seldb = mysqli_select_db($link, "HBSR")  
        or die("資料庫選擇失敗！");  
    
    //SQL查詢
    $sql = "SELECT * FROM `PT` ";
    mysqli_query($link, "SET names 'utf8'");//好像是把原本mysqli_query($link, "SET CHARACTER SET UTF8");改成現在這樣就可以run

    $result = mysqli_query($link, $sql);
    $total_records = mysqli_num_rows($result);
?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>物治師管理</title>
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
          <li class="active"><a href="admin_homepage.php"><i class='bx bx-store'></i> <span>首頁</span></a></li>
          <li><a href="admin_patient.php"><i class='bx bxs-face'></i> <span>病患管理</span></a></li>
          <li><a href="admin_PT.php"><i class="bx bx-briefcase"></i> <span>物治師管理</span></a></li>
          <li><a href="admin_account.php"><i class='bx bx-building-house'></i><span>管理者資料管理</span></a></li>
		  <li><a href="../index.php"><i class='bx bx-log-out'></i> <span>登出</span></a></li>
        </ul>
      </nav>
    </header>
    <main id="main">
      <section id="contact" class="contact">
        <div class="container" data-aos="fade-up">
          <div class="section-title">
            <h2>物治師管理</h2>

			<div class="adduser"><a href="admin_PT_add.php"><button type="submit">新增物治師</button></a></div>
          </div>
		  
		  	<table align="center">
				<!-- 表格表頭 -->
				<thead>
					<th>職編</th>
					<th>姓名</th>
					<th>連絡電話</th>
					<th>權限</th>
					<th>資料修改</th>

				</thead>
				<!-- 資料內容 -->
				<tbody>
				
				<?php
                try{
                    while ($row_result = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        //if ($row_result["C_ID"] == null){ //判斷是哪間物治所(還沒寫)
                            echo "<td>".$row_result["PT_NUM"]."</td>";
                            echo "<td>".$row_result["PT_NAME"]."</td>"; 
                            echo "<td>".$row_result["PT_TEL"]."</td>"; 
                            //echo "<td>
                            //echo "<td><a href='update.php?id=".$row_result["id"]."'>修改</a> ";
                        //}
                        echo "</tr>";
                    }
                }
                catch(Exception $e){
                    echo "Message:".$e->getMessage();
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