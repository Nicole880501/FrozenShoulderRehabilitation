<?php
session_start();
header("Content-Type:text/html;charset=utf-8");
include("conmysql.php");
$seldb = @mysqli_select_db($link, "HBSR");
	if (!$seldb) die("資料庫選擇失敗！");
$i_id = $_SESSION['i_id'];
$sql_inv = "SELECT * FROM `inv` where I_ID = '$i_id'";

$invinfo = mysqli_query($link, $sql_inv);

?>
<!DOCTYPE html>
<html lang="zh-tw"><!--設定為繁體中文-->
    <head><!--個人資料管理-->
        <meta charset="utf-8">
        <meta name="viewport" contrnt="width=device-width, initial-scale=1.0"><!--initial-scale=1.0 是指網頁插入圖案時的原始縮放比例-->
        <link href="../../../static/css/C.css" type="text/css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC&display=swap" type="text/css" rel="stylesheet">
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> -->
        <title>個人資料管理</title>
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
        <p style="font-size: 25px; margin:10px 10px 0px 30px; font-weight: bolder;">個人資料管理</p>
        
        <!-- 中間內容 -->
        <div class="center" style="font-size:20px;" >
            <form method="post" action="check_user.php" >
                <div class="inputBox" style="height:300px;">
                    <?php
						if($_SESSION['i_id'] != null)
						{
							while($row_result=mysqli_fetch_assoc($invinfo)){
								echo "<div style= 'width:50% float:right'> <label>身分證字號:</label>";
								echo "<input type='text' name='i_id' value=".$row_result["I_ID"]." required='required' placeholder='' readonly>";
								echo "</div>";
								
								echo "<div style='width:50%'> <label style='margin-left:-20px'>姓名:</label>";
								echo "<input type='text' name='i_name' value=".$row_result["I_NAME"]." required='required' placeholder='' readonly>";
								echo "</div>";
								
								echo "<div style='width:50% float:right'> <label style='margin-left:-20px'>病歷號:</label>";
								echo "<input type='text' name='i_num' value=".$row_result["I_NUM"]." required='required' placeholder='' readonly>";
								echo "</div>";
								
								echo "<div style= 'width:50%'> <label>生日:</label>";
								echo "<input type='text' name='i_bd' value=".$row_result["I_BD"]." required='required' placeholder='' readonly>";
								echo "</div>";
								
								echo "<div style= 'width:50% float:right'> <label style = 'margin-left:-20px'>密碼:</label>";
								echo "<input type='text' name='i_pw' value=".$row_result["I_PW"]." required='required' placeholder='請輸入密碼'>";
								echo "</div>";
								
								echo "<div style= 'width:50%'> <label>電話:</label>";
								echo "<input type='text' name='i_tel' value=".$row_result["I_TEL"]." required='required' placeholder='請輸入您的電話'>";
								echo "</div>";

								echo "<div style='width:50%; margin-left:20px'> <label>物治所編號:</label>";
								echo "<input type='text' name='c_id' value=".$row_result["C_ID"]." required='required' placeholder='' readonly>";
								echo "</div>";
								
								echo "<input type='submit' name='submit' value='儲存' style=''>";
								
							}
						}
						else
						{
							echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
						}
					?>
					
                </div>
            </form>
        </div>

        <!-- 頁尾 -->
        <footer>
            <hr>
            <div class="small text-center text-muted fst-italic"> Copyright &copy; </div>
        </footer>
       
    </body>
</html>