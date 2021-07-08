<?php
require('../../init.php');
$title = 'Create Product';
if (!isset($_SESSION['user'])) {
    back('errorModal', 'Account Login ဝင်ရန်လိုအပ်ပါသည်။', 'login.php');
}
##########################################
## create category
if ($_POST) {
    $name = $_POST['name'];
    $category_id = $_POST['category_id'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $description = $_POST['description'];
    ## Check Validation
    $errors = [];
    if (empty($name)) {
        $errors['name'] = 'Category name ဖြည့်ရန်လိုအပ်ပါသည်။';
    }
    if (empty($category_id)) {
        $errors['category_id'] = 'Category  ဖြည့်ရန်လိုအပ်ပါသည်။';
    }
    if (empty($price)) {
        $errors['price'] = 'Product price ဖြည့်ရန်လိုအပ်ပါသည်။';
    } elseif (is_numeric($price) != 1) {
        $errors['price'] = 'Product price must be integer';
    }
    if (empty($quantity)) {
        $errors['quantity'] = 'Product quantity ဖြည့်ရန်လိုအပ်ပါသည်။';
    } elseif (is_numeric($quantity) != 1) {
        $errors['quantity'] = 'Product quantity must be integer';
    }
    if (empty($description)) {
        $errors['description'] = 'Product description ဖြည့်ရန်လိုအပ်ပါသည်။';
    }
    if (empty($_FILES['image']['name'])) {
        $errors['image'] = 'Product Image ဖြည့်ရန်လိုအပ်ပါသည်။';
    } else {
        ## check image extension
        $imagetype = $_FILES['image']['name'];
        $supported_image = array('jfif', 'jpg', 'jpeg','png');
        $ext = strtolower(pathinfo($imagetype, PATHINFO_EXTENSION));
        if (!in_array($ext, $supported_image)) {
            $errors['image'] = 'Product Image not allows image type';
        }
    }
    ## create
    if (empty($errors)) {

        $file = "../assets/images/products/" .time().str_replace(' ','_',$_FILES["image"]['name']);

        $tmpName = $_FILES['image']['tmp_name'];
        $image = time() . $_FILES["image"]['name'];

        move_uploaded_file($tmpName, $file);

        $time = date("Y-m-d H:i:s");
        $cond = query(
            'insert into products (name,slug,category_id,price,quantity,image,description,created_at) values (?,?,?,?,?,?,?,?)',
            [$name, slug($name), $category_id, $price, $quantity, $image, $description, $time]
        );
        if ($cond) {
            back('success', 'product create success', 'index.php');
        }
    }
}

## get categories
$result = getAll("select * from categories");

require('../layout/header.php');
?>

<div class="app-main__inner">
    <!-- Leading -->
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-menu icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div> Create
                </div>
            </div>

        </div>
    </div>
    <!-- Main Content -->
    <div class="row">
        <div class=" col-12">
            <div class="card">
                <div class="card-header">
                    Create Category
                </div>
                <div class="card-body px-5 py-3">
                    <form action="" method="POST" enctype="multipart/form-data">

                        <input type="hidden" name="_token" class="form-control" value="<?php echo $_SESSION['_token']; ?>">
                        <!-- Name and Category -->
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="name">Enter Product Name</label>
                                    <input type="text" name="name" class="form-control">
                                    <?php isset($errors) ? validate($errors, 'name') : '' ?>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="email">Choose Category</label>
                                    <select name="category_id" class="form-control">
                                        <?php foreach ($result as $value) { ?>
                                            <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                                        <?php } ?>
                                    </select>
                                    <?php isset($errors) ? validate($errors, 'category_id') : '' ?>
                                </div>
                            </div>
                        </div>
                        <!-- Price and Quantity -->
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="price">Enter Product Price</label>
                                    <input type="number" name="price" class="form-control">
                                    <?php isset($errors) ? validate($errors, 'price') : '' ?>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="quantity">Enter Product Quantity</label>
                                    <input type="number" name="quantity" class="form-control">
                                    <?php isset($errors) ? validate($errors, 'quantity') : '' ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="quantity">Choose Product Image</label>
                            <input type="file" name="image" class="form-control p-1">
                            <?php isset($errors) ? validate($errors, 'image') : '' ?>
                        </div>
                        <div class="form-group">
                            <label for="password">Enter Category Description</label>
                            <textarea name="description" class="form-control"></textarea>
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