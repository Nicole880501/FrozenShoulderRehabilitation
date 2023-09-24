<?php
session_start();
header("Content-Type:text/html;charset=utf-8");
include("conmysql.php");
$id = $_SESSION['id'];
$sql_inv = "SELECT * FROM `inv`";
//$sql_query = "SELECT * FROM `log`";
$invinfo = mysqli_query($link, $sql_inv);
//$result = mysqli_query($db_link, $sql_query);
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>雙手後伸運動</title>
    <link href="../../static/img/favicon.png" rel="icon">
    <link href="../../static/img/apple-touch-icon.png" rel="apple-touch-icon">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link rel="stylesheet" href="{{url_for('static',filename='/css/assets/vendor/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url_for('static',filename='/css/assets/vendor/icofont/icofont.min.css')}}">
    <link rel="stylesheet" href="{{url_for('static',filename='/css/assets/vendor/boxicons/css/boxicons.min.css')}}">
    <link rel="stylesheet" href="{{url_for('static',filename='/css/assets/vendor/venobox/venobox.css')}}">
    <link rel="stylesheet" href="{{url_for('static',filename='/css/assets/vendor/owl.carousel/assets/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{url_for('static',filename='/css/assets/vendor/aos/aos.css')}}">
    <link rel="stylesheet" href="{{url_for('static',filename='/css/assets/css/style.css')}}">
	
	<script src="scripts.js"></script>
											
<script>
            document.addEventListener("DOMContentLoaded", () => {
                var but = document.getElementById("but");//開始錄影
                var stop_but = document.getElementById("stop_but");//終止運動(關鏡頭)
                var video = document.getElementById("vid");
                var mediaDevices = navigator.mediaDevices;
                vid.muted = true; //靜音

                //開鏡頭
                but.addEventListener("click", () => {
                    // Accessing the user camera and video.
                    mediaDevices
                        .getUserMedia({
                            video: true,
                            audio: false,
                        })
                        .then((stream) => {
            
                        // Changing the source of video to current stream.
                        video.srcObject = stream;
                        video.addEventListener("loadedmetadata", () => {
                            video.play();
                        });
                        })
                        .catch(alert);
                });

                //關鏡頭
                stop_but.addEventListener("click", () => {
					//video.stop();
					
                    // Accessing the user camera and video.
                    mediaDevices
                        .getUserMedia({
                            video: true,
                            audio: false,
                        })
                        .then((stream) => {
                            // Changing the source of video to current stream.
                            // video.srcObject = stream;
                            // video.addEventListener("loadedmetadata", () => {
                            //     video.play();
                            // });
                            stream.getTracks().forEach(function (track) {
                                video.pause()
                            })
                        })
                        .catch(alert);
                });

            });
        </script>

      <script type = "text/javascript" src="{{url_for('static', filename='/js/assets/vendor/jquery/jquery.min.js')}}"></script>
      <script type = "text/javascript" src="{{url_for('static', filename='/js/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
      <script type = "text/javascript" src="{{url_for('static', filename='/js/assets/vendor/jquery.easing/jquery.easing.min.js')}}"></script>
      <script type = "text/javascript" src="{{url_for('static', filename='/js/assets/vendor/php-email-form/validate.js')}}"></script>
      <script type = "text/javascript" src="{{url_for('static', filename='/js/assets/vendor/waypoints/jquery.waypoints.min.js')}}"></script>
      <script type = "text/javascript" src="{{url_for('static', filename='/js/assets/vendor/counterup/counterup.min.js')}}"></script>
      <script type = "text/javascript" src="{{url_for('static', filename='/js/assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
      <script type = "text/javascript" src="{{url_for('static', filename='/js/assets/vendor/venobox/venobox.min.js')}}"></script>
      <script type = "text/javascript" src="{{url_for('static', filename='/js/assets/vendor/owl.carousel/owl.carousel.min.js')}}"></script>
      <script type = "text/javascript" src="{{url_for('static', filename='/js/assets/vendor/typed.js/typed.min.js')}}"></script>
      <script type = "text/javascript" src="{{url_for('static', filename='/js/assets/vendor/aos/aos.js')}}"></script>
      <script type = "text/javascript" src="{{url_for('static', filename='/js/assets/js/main.js')}}"></script>
  </head>
  <body>
    <button type="button" class="mobile-nav-toggle d-xl-none"><i class="icofont-navigation-menu"></i></button>
    <header id="header" class="d-flex flex-column justify-content-center">
      <nav class="nav-menu">
        <ul>
          <li class="active"><a href="homepage.php"><i class='bx bx-store'></i> <span>首頁</span></a></li>
		  <li><a href="training.php"><i class='bx bx-dumbbell'></i> <span>開始訓練</span></a></li>
          <li><a href="historylog.php"><i class='bx bx-folder'></i> <span>歷史紀錄</span></a></li>
          <li><a href="user_account.php"><i class="bx bxs-face"></i> <span>個人資料管理</span></a></li>	
		  <li><a href="../index.php"><i class='bx bx-log-out'></i> <span>登出</span></a></li>
        </ul>
      </nav>
    </header>

	<main id="main" style="margin: -70px 0 0 10%;">
      <section id="contact" class="contact">
        <div class="container" data-aos="fade-up">
			<div class="section-title style='margin-bottom:0;'">
				<h2>雙手後伸運動</h2>
			</div>
			
			<div class="camwindow">
				<div class="left">

				<video src="./image/10seconds.mp4" width="100%" controls loop></video>
				
				<table align="center" style="margin: 5px 0 20px 0px;">
				<!-- 表格表頭 -->
				<thead>
					 <th style="border-radius: 5px 5px 0 0;">動作指引</th>
				</thead>
				<!-- 資料內容 -->
                    <tbody>
                    <tr>
                        <td style="border-radius: 0 0 5px 5px; padding:5px;">
                            身體直立，將雙臂向後伸展，直至可忍耐的疼痛程度，並於該位置維持10秒再放下。
                            <br>以每回10次的方式進行。需避免身體彎曲。
                        </td>
                    </tr>
                    </tbody>
                </table>
                    <div class="adduser text-center"><a href="training.php"><button>返回前頁</button></a></div>
                </div>
                <div class="right">
                    <img src="{{ url_for('BW_E') }}">
                    <a href=""><div class="text-center loginbtn"><button>終止運動</button></div></a>
                </div>
            </div>


        </div>
      </section>
    </main>
</html>