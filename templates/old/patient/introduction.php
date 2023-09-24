<?php
session_start();
header("Content-Type:text/html;charset=utf-8");
?>
<!DOCTYPE html>
<html lang="zh-tw"><!--設定為繁體中文-->
    <head><!--系統介紹-->
        <meta charset="utf-8">
        <meta name="viewport" contrnt="width=device-width, initial-scale=1.0"><!--initial-scale=1.0 是指網頁插入圖案時的原始縮放比例-->
        <link href="../../../static/css/C.css" type="text/css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC&display=swap" type="text/css" rel="stylesheet">
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> -->
        <title>系統介紹</title>
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
              <li class="nav-item"><a class="nav-link " href="index.php">回首頁</a></li>
              <li class="nav-item"><a class="nav-link " href="training.php">開始訓練</a></li>
              <li class="nav-item"><a class="nav-link " href="historylog.php">歷史紀錄</a></li>
              <li class="nav-item"><a class="nav-link " href="user_account.php">個人資料管理</a></li>
              <li class="nav-item"><a class="nav-link " href="introduction.php">系統介紹</a></li>
			  <li class="nav-item"><a class="nav-link " href="../../index.php">登出</a></li>
            </ul>
         </div>
         <p style="font-size: 25px; margin:10px 10px 0px 30px; font-weight: bolder;">系統介紹</p>
        <!-- 中間內容 -->
        <div style="padding:80px 50px 50px 330px; margin-bottom:20px; height: 350px;">
            <p style="font-size: 20px;"><br>
            本系統為針對五十肩病患設計出一套復健系統，病患透過三種常見的五十肩復健動作，<br><br>
            於系統內進行復健動作後，即記錄當下執行動作影片及關節活動角度記錄。<br><br>
            此外，治療師可於復健記錄內給予病患建議回復，提供病患進行更完善的復健療程。<br><br>
            藉由居家自主復健系統，在疫情當下可減少病患於復健場所復健的風險，<br><br>
            並提供病患能以簡便設備於非固定場所下執行復健運動，提高病患自主復健的意願即對於醫囑的遵從性。<br><br>
            </p>
        </div>

        <!-- 頁尾 -->
        <footer>
            <p style="font-size: 15px; color: gray; text-align: center;" >
            此系統由高雄醫學大學 醫務管理暨醫療資訊學系學生<br>
            許名鵑、李唯爾、伍倖儀、張庭瑜、林沅、陳煒廂製作<br></p>
            <hr>
            <div class="small text-center text-muted fst-italic"> Copyright &copy; </div>
        </footer>
        
    </body>
</html>