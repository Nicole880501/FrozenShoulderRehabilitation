<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>病患首頁</title>
    <link href="../../static/img/desktop_icon.png" rel="icon">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link rel="stylesheet" href="{{url_for('static',filename='/css/assets/vendor/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url_for('static',filename='/css/assets/vendor/icofont/icofont.min.css')}}">
    <link rel="stylesheet" href="{{url_for('static',filename='/css/assets/vendor/boxicons/css/boxicons.min.css')}}">
    <link rel="stylesheet" href="{{url_for('static',filename='/css/assets/vendor/venobox/venobox.css')}}">
    <link rel="stylesheet" href="{{url_for('static',filename='/css/assets/vendor/owl.carousel/assets/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{url_for('static',filename='/css/assets/css/style.css')}}">

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
          <li><a href="../index.php"><i class='bx bx-log-out'></i> <span>登出</span></a></li>
        </ul>
      </nav>
    </header>

	
    <main style="margin-top:3%;">
      <section id="home_main" class="home_main">
        <div class="container" data-aos="fade-up">
		<div class="section-title" style="text-align:center">
            <h2 >病患首頁</h2>
          </div>
		<nav class="menu">
        <ul>
		  <li><a href="{{ url_for('training') }}"><i class='bx bx-dumbbell'></i> <span>開始訓練</span></a></li>
          <li><a href="historylog.php"><i class='bx bx-folder'></i> <span>歷史紀錄</span></a></li>
          <li><a href="user_account.php"><i class="bx bxs-face"></i> <span>個人資料管理</span></a></li>
        </ul>
      </nav>

      </section>
    </main>
  </body>

</html>