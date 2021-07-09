<?php require 'init.php'; ?>
<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
	<!-- Mobile Specific Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Favicon-->
	<link rel="shortcut icon" href="img/fav.png">
	<!-- Author Meta -->
	<meta name="author" content="CodePixar">
	<!-- Meta Description -->
	<meta name="description" content="">
	<!-- Meta Keyword -->
	<meta name="keywords" content="">
	<!-- meta character set -->
	<meta charset="UTF-8">
	<!-- Site Title -->
	<title>Login</title>

	<!-- CSS ============================================= -->
	<link rel="stylesheet" href="<?php echo BASE_URL ?>asset/css/linearicons.css">
	<link rel="stylesheet" href="<?php echo BASE_URL ?>asset/css/owl.carousel.css">
	<link rel="stylesheet" href="<?php echo BASE_URL ?>asset/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo BASE_URL ?>asset/css/themify-icons.css">
	<link rel="stylesheet" href="<?php echo BASE_URL ?>asset/css/nice-select.css">
	<link rel="stylesheet" href="<?php echo BASE_URL ?>asset/css/nouislider.min.css">
	<link rel="stylesheet" href="<?php echo BASE_URL ?>asset/css/bootstrap.css">
	<link rel="stylesheet" href="<?php echo BASE_URL ?>asset/css/main.css">
</head>

<body>

	<!-- Start Header Area -->
	<header class="header_area sticky-header ">
		<div class="main_menu">
			<nav class="navbar navbar-expand-lg navbar-light main_box">
				<div class="container py-3">
					<!-- Brand and toggle get grouped for better mobile display -->
					<a class="navbar-brand logo_h" href="index.html"><img src="img/logo.png" alt="">HK Shopping</a>
				</div>
			</nav>
		</div>

	</header>
	<!-- End Header Area -->

	<!--================Login Box Area =================-->
	<section class="login_box_area section_gap mt-5">
		<div class="container mt-5">
			<div class="row">
				<div class="col-lg-6">
					<div class="login_box_img">
						<img class="img-fluid" src="asset/img/lg.png" alt="">
						<div class="hover">
							<h4>Login to our website?</h4>
							<p>There are advances being made in science and technology everyday, and a good example of this is the</p>
							<a class="primary-btn" href="<?php echo BASE_URL; ?>register.php">Create an Account</a>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="login_form_inner">
						<h3>Log in to enter</h3>
						<form class="row login_form" action="contact_process.php" method="post" id="contactForm" novalidate="novalidate">
							<div class="col-md-12 form-group">
								<input type="text" class="form-control" id="name" name="name" placeholder="Username" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Username'">
							</div>
							<div class="col-md-12 form-group">
								<input type="text" class="form-control" id="name" name="name" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'">
							</div>
							<div class="col-md-12 form-group">
								<div class="creat_account">
									<input type="checkbox" id="f-option2" name="selector">
									<label for="f-option2">Keep me logged in</label>
								</div>
							</div>
							<div class="col-md-12 form-group">
								<button type="submit" value="submit" class="primary-btn">Log In</button>

							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="js/vendor/jquery-2.2.4.min.js"></script>
	<script type="text/javascript" src="<?php echo BASE_URL ?>admin/assets/scripts/admin.js"></script>
	<?php require'admin/layout/toast.php'; ?>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
	<script src="<?php echo BASE_URL ?>asset/js/vendor/jquery-2.2.4.min.js"></script>
	<script src="<?php echo BASE_URL ?>asset/js/vendor/bootstrap.min.js"></script>
	<script src="<?php echo BASE_URL ?>asset/js/jquery.ajaxchimp.min.js"></script>
	<script src="<?php echo BASE_URL ?>asset/js/jquery.sticky.js"></script>
	<script src="<?php echo BASE_URL ?>asset/js/nouislider.min.js"></script>
	<script src="<?php echo BASE_URL ?>asset/js/jquery.magnific-popup.min.js"></script>
	<script src="<?php echo BASE_URL ?>asset/js/owl.carousel.min.js"></script>
	<!--gmaps Js-->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
	<script src="<?php echo BASE_URL ?>asset/js/gmaps.min.js"></script>
	<script src="<?php echo BASE_URL ?>asset/js/main.js"></script>

	<!-- // Check Auth -->

	<?php
	if (isset($_SESSION['errorModal'])) {
	?>
		<script>
			alertModal('error', 'Error !', "<?php getSession('errorModal', 'errorModal'); ?>");
		</script>
	<?php
		unset($_SESSION['errorModal']);
	}
	?>
		<?php
	if (isset($_SESSION['successModal'])) {
	?>
		<script>
			alertModal('success', 'Success !', "<?php getSession('successModal', 'successModal'); ?>");
		</script>
	<?php
		unset($_SESSION['successModal']);
	}
	?>
	</script>
</body>

</html>