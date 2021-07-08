<?php
require '../init.php';
$title = 'Login';
if (isset($_SESSION['user'])) {
    back('error', 'Already Login', 'index.php');
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
            }else{
                if($user->role != 1){
                    back('errorModal', 'Admin Account မဟုတ်ရင်ဝင်ခွင့်မရှိပါ','login.php');           
                }
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
        setSession('success','Welcome '.$user->name);
        redirect('index.php');
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?></title>
    <link href="<?php echo BASE_URL ?>admin/main.css" rel="stylesheet">

</head>

<body>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-12">
                <div class="card shadow">
                    <div class="card-header">
                        <h5> Login</h5>
                    </div>
                    <div class="card-body p-5">
                        <form action="" method="POST">
                        <input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>">
                            <div class="form-group">
                                <label for="email">Enter Email</label>
                                <input value="htetaung@gmail.com" type="email" name="email" class="form-control">
                                <?php isset($errors) ? validate($errors, 'email') : '' ?>

                            </div>
                            <div class="form-group">
                                <label for="password">Enter Password</label>
                                <input value="password" type="password" name="password" class="form-control">
                                <?php isset($errors) ? validate($errors, 'password') : '' ?>
                            </div>
                            <span>Don't have an account?
                                <a href="<?php echo BASE_URL; ?>admin/register.php">
                                    <b class="text-primary">Register Now</b>
                                </a>
                            </span>
                            <p class="my-3">
                                <button class="btn btn-primary">Login</button>
                            </p>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="<?php echo BASE_URL ?>admin/assets/scripts/main.js"></script>
    <script type="text/javascript" src="<?php echo BASE_URL ?>admin/assets/scripts/admin.js"></script>
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
</body>

</html>