<?php
$title = 'Login';
require('layout/auth_header.php');
?>
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-12">
            <div class="card shadow">
                <div class="card-header">
                    <h5> Login</h5>
                </div>
                <div class="card-body p-5">
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="email">Enter Email</label>
                            <input type="email" name="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password">Enter Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        <span>Don't have an account? 
                            <a href="<?php echo BASE_URL;?>admin/register.php">
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
<?php require('layout/auth_footer.php'); ?>