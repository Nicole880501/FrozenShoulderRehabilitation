<?php
session_start();
header("Content-Type:text/html;charset=utf-8");
?>
<!DOCTYPE html>
<html lang="zh-tw"><!--設定為繁體中文-->
    <head><!--開始訓練-->
        <meta charset="utf-8">
        <meta name="viewport" contrnt="width=device-width, initial-scale=1.0"><!--initial-scale=1.0 是指網頁插入圖案時的原始縮放比例-->
        <link href="../../../static/css/C.css" type="text/css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC&display=swap" type="text/css" rel="stylesheet">
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> -->
        <title>開始訓練</title>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="scripts.js"></script>

        $('.navbar-nav>li>a').on('click', function(){
            $('.navbar-collapse').collapse('hide');
        });

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
    </head>
    <body>
        <!-- 最上方的導覽列 -->
        <header style="margin-bottom:45px;">
            <nav class="navbar navbar-expand-lg navbar-light"  id="mainNav">
                <div class="container">
                    <a class="navbar-brand" onclick="window.location.href='../../index.php'">居家自主復健系統</a>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation" style="background-color:RGB(250,234,211);border:0;">
                        <i class="fas fa-bars fa-2x"></i>
                    </button>  
                </div>
            </nav>
        </header>
        
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto" style="position:absolute; right:1px; top:50px;border-radius: 10px; padding-bottom: 20px; padding-top: 10px;">
              <li class="nav-item"><a class="nav-link " href="{{ url_for('index') }}">回首頁</a></li>
              <li class="nav-item"><a class="nav-link " href="{{ url_for('training') }}">開始訓練</a></li>
              <li class="nav-item"><a class="nav-link " href="historylog.php">歷史紀錄</a></li>
              <li class="nav-item"><a class="nav-link " href="user_account.php">個人資料管理</a></li>
              <li class="nav-item"><a class="nav-link " href="introduction.php">系統介紹</a></li>
			  <li class="nav-item"><a class="nav-link " href="../../index.php">登出</a></li>
            </ul>
         </div>
        <!-- 示範影片與使用者畫面-->
        <p style="font-size: 25px; margin-top:10px; margin-left: 30px; font-weight: bolder;">左手爬牆運動</p>
        <table class="table">
            <!-- 第一橫排 -->
            <tr>
                <td class="pose_td" >
                    <a class="back" href="training.html" style="font-weight:bolder;">回上頁</a>
                </td>
                <td class="pose_td">
                    <button id ="but" class="back" autoplay style="font-weight:bolder">開啟相機</button>
                </td>
            </tr>

            <tr> <!-- 第二橫排 -->
                <td>
                    <img src="../../../static/image/old/giphy.gif" width="400" height="500">
                </td> 
                <td>
                    <img src="{{ url_for('climb_l') }}" width="100%">
                    <!--vid>
                        <video id="vid"></video>
                    </vid>-->
                </td> 
            </tr>
            
            <!-- 第三橫排 -->
            <tr>
                <td class="pose_td">
                    <p class='info'>身體與牆壁呈90度，並以患側手面向牆壁，將患側手放於牆上利用手指沿牆壁逐漸上移，直至可忍耐的疼痛程度，並於該位置維持10秒再放下。
                        以每回20次的方式進行。需避免身體彎曲。</p>
                </td>
                <td class="pose_td"><!-- 停止的按鈕 -->
                    <button id ="stop_but" class="back" autoplay style="font-weight:bolder">中止運動</button>
                </td>
            </tr>
        </table>

        <!-- 頁尾 -->
        <footer style="margin-bottom: 5px;">
            <hr>
            <div class="small text-center text-muted fst-italic">Copyright &copy; </div>
        </footer>
    </body>

</html>