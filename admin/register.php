<?php
$title = 'Register';
require('layout/auth_header.php');
?>
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-12">
            <div class="card shadow pb-0">
                <div class="card-header">
                    <h5> Register</h5>
                </div>
                <div class="card-body px-5 py-3">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="name">Enter Name</label>
                            <input type="name" name="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="phone">Enter Phone</label>
                            <input type="number" name="phone" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="email">Enter Email</label>
                            <input type="email" name="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password">Enter Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="address">Enter Address</label>
                            <textarea name="address" class="form-control"></textarea>
                        </div>
                        <span>Already have an account?
                            <a href="<?php echo BASE_URL; ?>admin/login.php">
                                <b class="text-primary">Login Now</b>
                            </a>
                        </span>
                        <p class="my-3">
                            <button class="btn btn-primary">Register</button>
                        </p>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
<?php require('layout/auth_footer.php'); ?>