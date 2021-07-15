<?php
require "init.php";

if (!isset($_SESSION['cart']) || count($_SESSION['cart']) < 1) {
    back('errorModal', 'ဝယ်ယူမည့် product ကို အရင်ရွေးချယ်ပေးပါ', 'index.php');
}

// clear single cart
if (isset($_GET['key']) and !empty($_GET['key'])) {
    $key = $_GET['key'];
    unset($_SESSION['cart'][$key]);
    redirect('cart.php');
}

require "layout/header.php";

?>

<!--================Cart Area =================-->
<section class="cart_area" style="padding-top: 30px;">
    <div class="container">
        <div class="cart_inner">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Product</th>
                            <th scope="col">Image</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        if (isset($_SESSION['cart'])) {
                            $total = 0;
                            foreach ($_SESSION['cart'] as $key => $val) {
                                $product_id = str_replace('id-', '', $key);
                                $product = getSingle("select * from products where id=$product_id");
                                $total += $product->price * $val;
                        ?>
                                <tr>
                                    <td>
                                        <?php echo $product->name; ?>
                                    <td style="padding-top: 0px;">
                                        <img height='70' class="mt-5" src="<?php echo BASE_URL . 'admin/assets/images/products/' . $product->image; ?>" alt="">

                                    </td>
                                    <td>
                                        <h5><?php echo $product->price; ?> MMK</h5>
                                    </td>
                                    <td>
                                        <h5><?php echo $val; ?></h5>
                                    </td>
                                    <td>
                                        <h5>
                                            <?php echo $product->price * $val; ?> MMK
                                        </h5>
                                    </td>
                                    <td>
                                        <a href="<?php echo BASE_URL . 'cart.php?key=' . $key; ?>" class="btn btn-sm shadow" style="border-radius: 30%;color:white;background:#EECC5C;">
                                            X
                                        </a>
                                    </td>
                                </tr>
                        <?php }
                        } ?>
                        <tr>                   
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <h5>Total Price</h5>
                            </td>
                            <td>
                                <h5 id="main_total">
                                    <?php echo $total; ?> MMK
                                </h5>
                            </td>
                        </tr>
                        <tr class="out_button_area">
                            <td colspan="4"></td>

                            <td colspan="2">
                                <div class="checkout_btn_inner d-flex align-items-center">
                                    <a class="primary-btn" href="<?php echo BASE_URL ?>clearall.php">Clear All</a>
                                    <a class="gray_btn" href="<?php echo BASE_URL ?>index.php">Continue Shopping</a>
                                    <a href="<?php echo BASE_URL ?>ordersubmit.php" class="primary-btn text-white">Order Submit</a>

                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<!--================End Cart Area =================-->


<?php require "layout/footer.php"; ?>

</body>

</html>