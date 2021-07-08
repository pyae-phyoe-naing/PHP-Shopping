<?php
require('../../init.php');
$title = 'Edit Category';
if (!isset($_SESSION['user'])) {
    back('errorModal', 'Account Login ဝင်ရန်လိုအပ်ပါသည်။', 'login.php');
}
##########################################
## update category
if ($_POST) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    ## Check Validation
    $errors = [];
    if (empty($name)) {
        $errors['name'] = 'Category name ဖြည့်ရန်လိုအပ်ပါသည်။';
    }
    if (empty($description)) {
        $errors['description'] = 'Category description ဖြည့်ရန်လိုအပ်ပါသည်။';
    }
    ## update
    if (empty($errors)) {
      $cond = query('update categories set name=?,slug=?,description=? where slug=?',[$name,slug($name),$description,$_GET['slug']]);
      if($cond){
          back('success','category updated success','index.php');
      }
    }
}

## get edit value
##########################################
## check exist slug value
if (empty($_GET['slug'])) {
    back('error', 'Category Not Found !', 'index.php');
}
## check slug value with category exist
$slug = $_GET['slug'];
$category = getSingle("select * from categories where slug=?", [$slug]);
if (!$category) {
    back('error', 'Category Not Found !', 'index.php');
}

require('../layout/header.php');
?>

<div class="app-main__inner">
    <!-- Leading -->
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-edit icon-gradient bg-mean-fruit">
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
                    Edit Category
                </div>
                <div class="card-body px-5 py-3">
                    <form action="" method="POST">
                        <input type="hidden" name="_token" class="form-control" value="<?php echo $_SESSION['_token']; ?>">
                        <div class="form-group">
                            <label for="email">Enter Category Name</label>
                            <input value="<?php echo $category->name; ?>" type="text" name="name" class="form-control">
                            <?php isset($errors) ? validate($errors, 'name') : '' ?>

                        </div>
                        <div class="form-group">
                            <label for="password">Enter Category Description</label>
                            <textarea name="description" class="form-control"><?php echo $category->description; ?></textarea>
                            <?php isset($errors) ? validate($errors, 'description') : '' ?>
                        </div>

                        <p class="my-3">
                            <button class="btn btn-primary">Create</button>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require('../layout/footer.php') ?>
</body>

</html>