<?php
require 'init.php';
if(isset($_SESSION['user'])){
	back('errorModal','Login ဝင်ပီးသားဖြစ်ပါသည်။','index.php');
}
if ($_POST) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    ## Check Validation
    $errors = [];
    if (empty($email)) {
        $errors['email'] = 'Email ဖြည့်ရန်လိုအပ်ပါသည်။';
    } else {
        $user = getSingle("select * from users where email=?", [$email]);
        if ($user) {
            ## check password
            if (!password_verify($password, $user->password)) {
                $errors['password'] = 'Password မှားနေပါသည်။';
            } 
        } else {
            $errors['email'] = 'Email မှားနေပါသည်။';
        }
    }
    if (empty($password)) {
        $errors['password'] = 'Password ဖြည့်ရန်လိုအပ်ပါသည်။';
    }
    ## Login
    if (empty($errors)) {
        $_SESSION['user'] = $user;
        setSession('success', 'Welcome ' . $user->name);
        redirect('index.php');
    }
}

?>
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
				<div class="container py-2">
					<!-- Brand and toggle get grouped for better mobile display -->
					<a class="navbar-brand logo_h" href="<?php echo BASE_URL; ?>index.php"><img src="	<?php echo BASE_URL; ?>asset/img/logo.png" alt=""></a>
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
						<form class="row login_form" action="" method="post" id="contactForm" novalidate="novalidate">
							<div class="col-md-12 form-group">
								<input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>">
								<input type="email" class="form-control" id="email" name="email" placeholder="Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Username'">
								<?php isset($errors) ? validate($errors, 'email', 'float-left') : '' ?>
							</div>
							<div class="col-md-12 form-group">
								<input type="password" class="form-control" id="password" name="password" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'">
								<?php isset($errors) ? validate($errors, 'password', 'float-left') : '' ?>
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
   <?php 
//    pretty($_SESSION['user']) ; 
//    unset($_SESSION['user'])
   ?>
<script src="https://code.jquery.com/jquery-3.6.0.js?fbclid=IwAR1XX1FcmyPyWTDdlKjSOf1BW7KL0TVE67-xcOXD8b-7bByqS9kVrDd053k"></script>

	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script type="text/javascript" src="<?php echo BASE_URL ?>admin/assets/scripts/admin.js"></script>
	<?php require 'admin/layout/toast.php'; ?>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>

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