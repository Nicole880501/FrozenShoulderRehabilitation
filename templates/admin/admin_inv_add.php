<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>新增病患使用者</title>
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
            <h2>新增病患使用者</h2>
          </div>

          <div class="row mt-1">

            <div class="col-lg-8 mt-5 mt-lg-0">

              <form action="forms/contact.php" method="post" role="form">  <!--新增病人php-->
                <div class="row">
                  <div class="col-md-6 form-group">
                    <input type="text" name="i_name" class="form-control" id="i_name" placeholder="姓名" data-rule="minlen:1" data-msg="姓名為必填欄位" />
                    <div class="validate"></div>
                  </div>
                  <div class="col-md-6 form-group mt-3 mt-md-0">
                    <input type="text" name="i_id" class="form-control" id="i_id" placeholder="身分證字號" pattern="[A-Z]{1}[1-2]{1}[0-9]{8}" data-msg="身分證字號為必填欄位(10碼)" />
                    <div class="validate"></div>
                  </div>
                </div>
				<div class="row">
                  <div class="col-md-6 form-group">
                    <input type="date" name="i_bd" class="form-control" id="i_bd" placeholder="生日" data-rule="minlen:1" data-msg="生日為必填欄位" />
                    <div class="validate"></div>
                  </div>
                  <div class="col-md-6 form-group mt-3 mt-md-0">
                    <input type="text" name="i_num" class="form-control" id="i_num" placeholder="病歷號" data-rule="minlen:7" data-msg="病歷號為必填欄位(7碼)" />
                    <div class="validate"></div>
                  </div>
                </div>
				<div class="row">
                  <div class="col-md-6 form-group">
                    <input type="i_tel" class="form-control" name="i_tel" id="i_tel" placeholder="聯絡電話" data-rule="minlen:10" data-msg="請輸入正確的電話號碼(10碼)" />
                    <div class="validate"></div>
                  </div>
                  <div class="col-md-6 form-group mt-3 mt-md-0">
                    <input type="text" name="i_pw" class="form-control" id="i_pw" placeholder="密碼" data-rule="minlen:1" data-msg="密碼為必填欄位" />
                    <div class="validate"></div>
                  </div>
                </div>
				<div class="row">
					<div class="form-group mt-3">
					   <input type="text" name="c_id" class="form-control" id="c_id" placeholder="物治所編號" data-rule="minlen:4" data-msg="物治所編號為必填欄位(4碼)" />
					  <div class="validate"></div>
					</div>
				</div>

                <div class="text-center loginbtn"><a href="admin_inv.php"><button type="submit">建立病患資料</button></a></div>
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