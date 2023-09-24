<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>開始訓練</title>
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
          <li class="active"><a href="{{ url_for('index') }}"><i class='bx bx-store'></i> <span>首頁</span></a></li>
		  <li><a href="historylog.php"><i class='bx bx-folder'></i> <span>歷史紀錄</span></a></li>
          <li><a href="user_account.php"><i class="bx bxs-face"></i> <span>個人資料管理</span></a></li>
		  <li><a href="../index.php"><i class='bx bx-log-out'></i> <span>登出</span></a></li>
        </ul>
      </nav>
    </header>

	<section id="train" class="services" style="margin-top: 4%;">
        <div class="container" data-aos="fade-up">
          <div class="section-title">
            <h2>開始訓練</h2>
          </div>
          <div class="row">
            <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-4 mt-lg-0" data-aos="zoom-in" data-aos-delay="100">
              <div class="icon-box">
                <a href="{{ url_for('mountain_pose') }}">
                  <img src="../../static/img/mountain.png" width="50%">
                  <h4>手臂向上山式</h4>
                  </a>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0" data-aos="zoom-in" data-aos-delay="200">
              <div class="icon-box">
                <a href="{{ url_for('extension') }}">
                  <img src="../../static/img/extension.png" width="50%">
                  <h4>雙手後伸運動</h4>
				  </a>
              </div>
            </div>
			</div>
			<br>
			<div class="row">
            <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-4 mt-lg-0" data-aos="zoom-in" data-aos-delay="300">
              <div class="icon-box">
                <a href="{{ url_for('climb_stair_l') }}">
                  <img src="../../static/img/L_climbing.png" width="50%">
                  <h4>左手爬牆運動</h4>
				  </a>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0" data-aos="zoom-in" data-aos-delay="100">
              <div class="icon-box">
                <a href="{{ url_for('climb_stair_r') }}">
                  <img src="../../static/img/R_climbing.png" width="50%">
                  <h4>右手爬牆運動</h4>
				  </a>
              </div>
            </div>
          </div>
        </div>
      </section>
  </body>
</html>