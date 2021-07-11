<?php
require('../../init.php');
$title = 'Edit User';
if (!isset($_SESSION['user'])) {
    back('errorModal', 'Account Login ဝင်ရန်လိုအပ်ပါသည်။', '../login.php');
}
##########################################
## update user
if ($_POST) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    ## Check Validation
    $errors = [];
    if (empty($name)) {
        $errors['name'] = 'Name ဖြည့်ရန်လိုအပ်ပါသည်။';
    }
    if (empty($phone)) {
        $errors['phone'] = 'Phone Number ဖြည့်ရန်လိုအပ်ပါသည်။';
    }
    if (empty($email)) {
        $errors['email'] = 'Email  ဖြည့်ရန်လိုအပ်ပါသည်။';
    }
    if (empty($address)) {
        $errors['address'] = 'Address  ဖြည့်ရန်လိုအပ်ပါသည်။';
    }
    ## update
    if (empty($errors)) {
        ## check exist password
        if(empty($_POST['password'])){
           $user =  getSingle("select * from users where id=?",[$_GET['id']]);
           if($user){
               $password = $user->password;
           }else{
               back('error','User not found ','index.php');
           }
        }else{
            $password = password_hash($_POST['password'],PASSWORD_BCRYPT);
        }
         if($_POST['isAdmin'] == 'on'){
             $role = 1;
         }else{
             $role = 0;
         }
        $cond = query("update users set name=?,email=?,password=?,role=?,phone=?,address=? where id=?", 
         [$name, $email,$password,$role,$phone,$address,$_GET['id']]);
        if ($cond) {
            $updateUser = getSingle("select * from users where id=?",[$_GET['id']]);
            $admin = $_SESSION['user']; ## current admin
            unset($_SESSION['user']);
            if($updateUser->id == $admin->id){
               $_SESSION['user'] = $updateUser;
            }else{
                $_SESSION['user'] = $admin;
            }
            back('success', 'User updated success', 'index.php');
        }
    }
}

## get edit value
##########################################
## check exist slug value
if (empty($_GET['id'])) {
    back('error', 'Category Not Found !', 'index.php');
}
## check id value with category exist
$id = $_GET['id'];
$user = getSingle("select * from users where id=?", [$id]);
if (!$user) {
    back('error', 'User Not Found !', 'index.php');
}

require('../layout/header.php');
?>

<div class="app-main__inner">
    <!-- Leading -->
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-user icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div> Edit
                </div>
            </div>

        </div>
    </div>
    <!-- Main Content -->
    <div class="row">
        <div class=" col-12">
            <div class="card">
                <div class="card-header">
                    Edit User
                </div>
                <div class="card-body px-5 py-4">

                    <form action="" method="POST">
                        <input type="hidden" name="_token" value="<?php echo $_SESSION['_token'] ?>">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="name">Enter Name</label>
                                    <input type="text" name="name" value="<?php echo $user->name; ?>" class="form-control">
                                    <?php isset($errors) ? validate($errors, 'name') : '' ?>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="phone">Enter Phone</label>
                                    <input type="number" name="phone" value="<?php echo $user->phone; ?>" class="form-control">
                                    <?php isset($errors) ? validate($errors, 'phone') : '' ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="email">Enter Email</label>
                                    <input type="email" name="email" value="<?php echo $user->email; ?>" class="form-control">
                                    <?php isset($errors) ? validate($errors, 'email') : '' ?>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="password">Enter Password</label>
                                    <input type="password" name="password" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address">Enter Address</label>
                            <textarea name="address" class="form-control"><?php echo $user->address; ?></textarea>
                            <?php isset($errors) ? validate($errors, 'address') : '' ?>
                        </div>

                        <div class="mt-4 d-flex align-items-start flex-column">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" name="isAdmin" class="custom-control-input" <?php echo $user->role == 1 ? "checked" : ""; ?> id="customSwitch1">
                                <label class="custom-control-label" for="customSwitch1"> Admin</label>
                            </div>
                            <div class="mt-3">
                                <button class="btn btn-primary ">Update</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<?php require('../layout/footer.php') ?>
</body>

</html>