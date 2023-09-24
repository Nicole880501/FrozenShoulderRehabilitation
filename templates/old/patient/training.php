<?php
session_start();
header("Content-Type:text/html;charset=utf-8");
include("conmysql.php");
$i_id = $_SESSION['i_id'];
$sql_inv = "SELECT * FROM `inv`";

$invinfo = mysqli_query($link, $sql_inv);
	
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
              <li class="nav-item"><a class="nav-link " href="historylog.php">歷史紀錄</a></li>
              <li class="nav-item"><a class="nav-link " href='user_account.php?i_id ="$i_id"'>個人資料管理</a></li>
              <li class="nav-item"><a class="nav-link " href="introduction.php">系統介紹</a></li>
			  <li class="nav-item"><a class="nav-link " href="../../index.php">登出</a></li>
          </ul>
       </div>
       <p style="font-size: 25px; margin:10px 10px 0px 30px; font-weight: bolder;">開始訓練</p>
      <!-- 中間內容 -->
      <div class="center">
          <button class="button" onclick="window.location.href='{{ url_for('mountain_pose') }}'"style="background: #EFC7C7;color:RGB(101,101,101);"><img src="../../../static/image/old/mountain.png" height="140" width="140"><br>
        手臂向上山式
      </button>
      <button class="button" onclick="window.location.href='{{ url_for('extension') }}'" style="background: #FEE5E1;color:RGB(101,101,101);"><img src="../../../static/image/old/extension.png" height="140" width="140"><br>
        雙手後伸運動
     </button>
     <br>
     <button class="button" onclick="window.location.href='{{ url_for('climb_stair_l') }}'" style="background: #FEE5E1;color:RGB(101,101,101);"><img src="../../../static/image/old/L_climbing.png" height="140" width="140"><br>
        左手爬牆運動
     </button>
     <button class="button" onclick="window.location.href='{{ url_for('climb_stair_r') }}'" style="background: #EFC7C7;color:RGB(101,101,101);"><img src="../../../static/image/old/R_climbing.png" height="140" width="140"><br>
        右手爬牆運動
     </button> 
     </div>
      
      <!-- 頁尾 -->
      <footer>
        <br>
         <hr>
        <div class="small text-center text-muted fst-italic">Copyright &copy; </div>
      </footer>

    </body>
</html>