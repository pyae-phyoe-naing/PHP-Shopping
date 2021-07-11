<?php
require('../../init.php');
$title = 'Edit Product';
if (!isset($_SESSION['user'])) {
    back('errorModal', 'Account Login ဝင်ရန်လိုအပ်ပါသည်။', 'login.php');
}
##########################################
## edit category
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
    if (!empty($_FILES['image']['name'])) {
        $imagetype = $_FILES['image']['name'];
        $supported_image = array('jfif', 'jpg', 'jpeg','png');
        $ext = strtolower(pathinfo($imagetype, PATHINFO_EXTENSION));
        if (!in_array($ext, $supported_image)) {
            $errors['image'] = 'Product Image not allows image type';
        }
    }
    ## create
    if (empty($errors)) {
        ## get old image
        $old_obj = getSingle('select * from products where slug=?', [$_GET['slug']]);

        ## check image extension
        if (!empty($_FILES['image']['name'])) {    // check empty if check isset error

            unlink("../assets/images/products/" . $old_obj->image);

            $file = "../assets/images/products/" . time() . str_replace(' ', '_', $_FILES["image"]['name']);
            $tmpName = $_FILES['image']['tmp_name'];
            move_uploaded_file($tmpName, $file);
            $image = time() . str_replace(' ', '_', $_FILES["image"]['name']);
        } else {
            $image = $old_obj->image;
        }

        $cond = query(
            'update products set name=?,slug=?,category_id=?,price=?,quantity=?,image=?,description=? where slug=?',
            [$name, slug($name), $category_id, $price, $quantity, $image, $description, $_GET['slug']]
        );
        if ($cond) {
            back('success', 'product update success', 'index.php');
        }
    }
}

## get categories
$result = getAll("select * from categories");
## get edit value
##########################################
## check exist slug value
if (empty($_GET['slug'])) {
    back('errorModal', 'Product ရှာမတွေ့ပါ !', 'index.php');
}
## check slug value with category exist
$slug = $_GET['slug'];
$product = getSingle("select * from products where slug=?", [$slug]);
if (!$product) {
    back('errorModal', 'Product ရှာမတွေ့ပါ !', 'index.php');
}

require('../layout/header.php');
?>

<div class="app-main__inner">
    <!-- Leading -->
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-next-2 icon-gradient bg-mean-fruit">
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
                                    <input value="<?php echo $product->name; ?>" type="text" name="name" class="form-control">
                                    <?php isset($errors) ? validate($errors, 'name') : '' ?>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="email">Choose Category</label>
                                    <select name="category_id" class="form-control">
                                        <?php foreach ($result as $value) { ?>
                                            <option <?php echo $product->category_id == $value['id'] ? 'selected' : ''; ?> value="<?php echo $value['id']; ?>">
                                                <?php echo $value['name']; ?>
                                            </option>
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
                                    <input value="<?php echo $product->price; ?>" type="number" name="price" class="form-control">
                                    <?php isset($errors) ? validate($errors, 'price') : '' ?>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="quantity">Enter Product Quantity</label>
                                    <input value="<?php echo $product->quantity; ?>" type="number" name="quantity" class="form-control">
                                    <?php isset($errors) ? validate($errors, 'quantity') : '' ?>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-8">
                                <div class="form-group">
                                    <label for="quantity">Choose Product Image</label>
                                    <input type="file" name="image" class="form-control p-1">
                                    <?php isset($errors) ? validate($errors, 'image') : '' ?>
                                </div>
                            </div>
                            <div class="col-md-6 col-4">
                                <p><img width="70" style="border-radius: 20%;" height="70" src="<?php echo BASE_URL . 'admin/assets/images/products/' . $product->image; ?>" alt=""></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password">Enter Category Description</label>
                            <textarea name="description" class="form-control"><?php echo $product->description; ?></textarea>
                            <?php isset($errors) ? validate($errors, 'description') : '' ?>
                        </div>

                        <p class="my-3">
                            <button class="btn btn-primary">Update</button>
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