<html>
	<head>
	    <meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<!-- The above 2 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<meta name="description" content="">
		<meta name="author" content="">
		<title>Refobi</title>
		<!-- 합쳐지고 최소화된 최신 CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

		<!-- 부가적인 테마 -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<!-- 합쳐지고 최소화된 최신 자바스크립트 -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
		<!-- Custom styles for this template -->
		<link href="../../assets/css/sticky-footer-navbar.css" rel="stylesheet">
	</head>
	<body>

	<!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Manage Shop</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li <?=$main?>><a href="/main/main_info">Home</a></li>
			
            <li class="dropdown <?=$stock?> ">
                <a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-expanded="false">
                        재고관리<span class="caret"></span>
                </a>
                <ul class="dropdown-menu" role="menu">
                        <li <?=$stock_list?>><a href="/Stock/stock_list">재고리스트관리</a></li>
                        <li <?=$stock_category?>><a href="/StockCategory/category_list">재고타입관리</a></li>
                        <li <?=$stock_seller?>><a href="/StockSeller/seller_list">재고업체관리</a></li>
                </ul>
            </li>
            <li><a href="#contact">Contact</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="#">Separated link</a></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li>
          </ul>
          <form class="navbar-form navbar-left" role="search">
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Search">
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
          </form>
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?=$this->session->userdata("user_name")?> <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#">내정보</a></li>
                  <li><a href="#">메시지확인</a></li>
                  <li><a href="/main/logout">로그아웃</a></li>
                </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>