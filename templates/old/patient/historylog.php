<?php
    session_start();
	header("Content-Type: text/html; charset=utf-8");
	include("conmysql.php");
	$seldb = @mysqli_select_db($link, "HBSR");
	if (!$seldb) die("資料庫選擇失敗！");
	$i_id = $_SESSION['i_id'];
	//SQL查詢
	//$sql_inv = "SELECT * FROM `inv` where I_ID=$id";
	$sql_record = "SELECT * FROM `record` where I_ID = '$i_id'";
	//$sql_record = "SELECT * FROM `record`";
	//$userinfo = mysqli_query($db_link, $sql_user);
	//$result = mysqli_query($db_link, $sql_query);  
    
    $record_info = mysqli_query($link, $sql_record); //好像是把原本mysqli_query($link, "SET CHARACTER SET UTF8");改成現在這樣就可以run
?>

<!DOCTYPE HTML>
<html lang="zh-tw"><!-- 設定為繁體中文 -->
    <head><!--歷史紀錄-->
        <meta http-equiv="Content-Type" content="text/html; charset= utf-8"/>
        <meta charset= utf-8"/>
        <meta name="viewport" contrnt="width=device-width, initial-scale=1.0"> <!--initial-scale=1.0 是指網頁插入圖案時的原始縮放比例-->
        <link href="../../../static/css/C.css" type="text/css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC&display=swap" type="text/css" rel="stylesheet">
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> -->
        <title>歷史紀錄</title>
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
         <p style="font-size: 25px; margin:10px 10px 0px 30px; font-weight: bolder;">歷史紀錄</p>
        
         <!-- 中間內容 -->
        <div class="center">
            <table class="table" style="border: #000000 solid 1px;">
                <tr style="border: #000000 solid 1px;">
                    <th>日期</th> <th>動作種類</th> <th>最佳角度</th> <th>影片紀錄</th> <th>物治師是否看過</th> <th>物治師回饋</th> <th>民眾心得</th>
                </tr>
                <?php
                if($_SESSION['i_id'] != null)
				{
                    while ($row_result = mysqli_fetch_assoc($record_info)) {
						echo "<tr>";
						echo "<td>".$row_result["START_TIME"]."</td>";  //Datetime,動作種類,最佳角度,影片紀錄,物治師回饋,民眾回饋
						echo "<td>".$row_result["POSE"]."</td>"; 
						echo "<td>".$row_result["MAX_ANGLE"]."度"."</td>";
						echo "<td>".$row_result["VID_NUM"]."</td>";
						if ($row_result["PT_FEEDBACK"] != null){ //判斷物治師是否看過
							echo "<td>"."已看過"."</td>"; 
						}
						else{
							echo "<td>"."還沒"."</td>"; 
						}    
						echo "<td>".$row_result["PT_FEEDBACK"]."</td>";
						echo "<td>".$row_result["I_FEEDBACK"]."</td>"; //患者心得


						//echo "<td>".$row_result["I_ID"]."</td>";
						//echo "<td>".$row_result["END_TIME"]."</td>";  
						//echo "<td>".$row_result["PT_ID"]."</td>"; 


						// echo "<td><a href='update.php?id=".$row_result["id"]."'>修改</a> ";
						//echo "<a href='delete.php?id=".$row_result["id"]."'>刪除</a></td>";
						echo "</tr>";
                    }
                }else
				{
					echo "<script type='text/javascript'>alert('請登入');location='../../index.php';</script>";
					//echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
				}
              ?>
            </table>
        </div>
        
        <!-- 頁尾 -->
        <footer>
            <hr>
            <div class="small text-center text-muted fst-italic"> Copyright &copy; </div>
        </footer>

    </body>
</html>