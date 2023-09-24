<?php
session_start();
header("Content-Type:text/html;charset=utf-8");
?>	
<!DOCTYPE html>
<html lang="en">
<head>
  <title>首頁</title>
  <meta charset="utf-8">
  <meta name="viewport" contrnt="width=device-width, initial-scale=1.0"><!--initial-scale=1.0 是指網頁插入圖案時的原始縮放比例-->
  <link href="../../../static/css/C.css" type="text/css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC&display=swap" type="text/css" rel="stylesheet">
  <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> -->
  <title>居家自主復健系統</title>
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
		  <li class="nav-item"><a class="nav-link " href="{{ url_for('training') }}">開始訓練</a></li>
		  <li class="nav-item"><a class="nav-link " href="historylog.php">歷史紀錄</a></li>
		  <li class="nav-item"><a class="nav-link " href="user_account.php">個人資料管理</a></li>
		  <li class="nav-item"><a class="nav-link " href="introduction.php">系統介紹</a></li>
		  <li class="nav-item"><a class="nav-link " href="../../index.php">登出</a></li>
      </ul>
   </div>
  <!-- 中間 -->
  <div class="center" style="padding:100px 50px 50px 50px; margin-bottom:20px; height: 350px;">
    <h1 class="w3-margin w3-jumbo" style="color:RGB(101,101,101); font-size: 50px; text-align: center;">歡迎進入復健追蹤系統</h1>
    <p id="show_time0" style="color:RGB(101,101,101); text-align: center; font-size: 25px;">
        <script>
          setInterval("show_time0.innerHTML=new Date().toLocaleString()+' 星期'+'日一二三四五六'.charAt(new Date().getDay());",1000);  
        </script>
    </p>
    <br>
    <button class="back" onclick="window.location.href='{{ url_for('training') }}'" style="background: RGB(250,234,211);color:RGB(101,101,101); height: 100px; width: 200px; font-size: 35px;">
      開始訓練
    </button>
  </div>

      <!-- 頁尾 -->
      <footer>
        <hr>
       <div class="small text-center text-muted fst-italic">Copyright &copy; </div>
     </footer>

    <script>
    // Used to toggle the menu on small screens when clicking on the menu button
    function myFunction() {
      var x = document.getElementById("navDemo");
      if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
      } else { 
        x.className = x.className.replace(" w3-show", "");
      }
    }
    </script>

</body>
</html>
