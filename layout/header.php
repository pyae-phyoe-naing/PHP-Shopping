<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
	<!-- Mobile Specific Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Favicon-->
	<link rel="shortcut icon" href="<?php echo BASE_URL; ?>asset/img/fav.png">
	<!-- Author Meta -->
	<meta name="author" content="CodePixar">
	<!-- Meta Description -->
	<meta name="description" content="">
	<!-- Meta Keyword -->
	<meta name="keywords" content="">
	<!-- meta character set -->
	<meta charset="UTF-8">
	<!-- Site Title -->
	<title>HK Shop</title>

	<!-- CSS ============================================= -->
	<link rel="stylesheet" href="<?php echo BASE_URL ?>asset/css/linearicons.css">
	<link rel="stylesheet" href="<?php echo BASE_URL ?>asset/css/owl.carousel.css">
	<link rel="stylesheet" href="<?php echo BASE_URL ?>asset/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo BASE_URL ?>asset/css/themify-icons.css">
	<link rel="stylesheet" href="<?php echo BASE_URL ?>asset/css/nice-select.css">
	<link rel="stylesheet" href="<?php echo BASE_URL ?>asset/css/nouislider.min.css">
	<link rel="stylesheet" href="<?php echo BASE_URL ?>asset/css/bootstrap.css">
	<link rel="stylesheet" href="<?php echo BASE_URL ?>asset/css/main.css">
	<link rel="stylesheet" href="<?php echo BASE_URL ?>asset/feather-icons/feather.css">
</head>

<body id="category">

	<!-- Start Header Area -->
	<header class="header_area sticky-header">
		<div class="main_menu">
			<nav class="navbar navbar-expand-lg navbar-light main_box">
				<div class="container">
					<!-- Brand and toggle get grouped for better mobile display -->
					<a class="navbar-brand logo_h" href="<?php echo BASE_URL; ?>index.php">
						<h4><img src="	<?php echo BASE_URL; ?>asset/img/logo.png" alt="">
							<h4>
					</a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse offset" id="navbarSupportedContent">
						<ul class="nav navbar-nav navbar-right">
							<?php
							$count = 0;
							if (isset($_SESSION['cart'])) {
								//pretty($_SESSION['cart']);
								foreach ($_SESSION['cart'] as $c) {
									$count += $c;
								}
								//echo $count;
							}
							?>
							<li class="nav-item mr-4" style="position:relative">
								<a href="<?php echo BASE_URL; ?>cart.php" class="cart">
									<span style="position: absolute;top:30;">
										<i class="feather-shopping-bag"></i>
									</span>
								</a>
								<p class="ml-3 mt-3 count d-inline">
									<?php echo $count; ?>
								</p>
							</li>
							<li class="nav-item">
								<button class="search"><span class="lnr lnr-magnifier" id="search"></span></button>
							</li>
						</ul>
					</div>
				</div>
			</nav>
		</div>
		<div class="search_input" id="search_input_box">
			<div class="container">
				<form class="d-flex justify-content-between" action="index.php" method="post">
					<input type="hidden" name="_token" class="form-control" value="<?php echo $_SESSION['_token']; ?>">
					<input type="text" name="search" class="form-control" id="search_input" placeholder="Search Here">
					<button type="submit" class="btn"></button>
					<span class="lnr lnr-cross" id="close_search" title="Close Search"></span>
				</form>
			</div>
		</div>
	</header>
	<!-- End Header Area -->

	<!-- Start Banner Area -->
	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-between">
				<div>
					<?php if (isset($_SESSION['user'])) { ?>

						<button onclick="logout()" class="primary-btn rounded-0 border-0">
							<i class="feather-log-out mr-1"></i>Logout
						</button>
					<?php } else { ?>
						<a href="<?php echo BASE_URL; ?>login.php" class="primary-btn rounded-0 border-0 text-white">
							<i class="feather-log-in mr-1"></i> Login
						</a>

					<?php } ?>

				</div>
				<div>
					<h1 class="mb-1">Welcome</h1>
					<?php if (isset($_SESSION['user'])) { ?>
						<h6 class="text-white float-right" style="letter-spacing: 1px;"><i class="feather-user"></i> " <?php echo $_SESSION['user']->name ?> "</h6>
					<?php } ?>
				</div>
			</div>
		</div>
	</section>