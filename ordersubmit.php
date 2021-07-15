<?php
require "init.php";
if (!isset($_SESSION['user'])) {
    back('errorModal', 'Order ပို့ရန် အကောင့် အရင် ဝင်ပေးပါ', 'login.php');
}
if (!isset($_SESSION['cart']) || count($_SESSION['cart']) < 1) {
    back('errorModal', 'ဝယ်ယူမည့် product ကို အရင်ရွေးချယ်ပေးပါ', 'index.php');
}

// checkout 

if ($_POST) {
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    ## Check Validation
    $errors = [];
    if (empty($phone)) {
        $errors['phone'] = 'Phone Number ဖြည့်ရန်လိုအပ်ပါသည်။';
    }
    if (empty($address)) {
        $errors['address'] = 'လိပ်စာ ဖြည့်ရန်လိုအပ်ပါသည်။';
    }
    ## create
    if (empty($errors)) {
        $time = date("Y-m-d H:i:s");
        $user_id = $_SESSION['user']->id;

        if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
            $total_price = 0;
            foreach ($_SESSION['cart'] as $key => $val) {
                $product_id = str_replace('id-', '', $key);
                $product = getSingle("select * from products where id=$product_id");
                $total_price += $product->price * $val;

                // reduce quantity from product
                $qty = $product->quantity - $val;
                query("update products set quantity=$qty where id=$product_id");
            }
            // save dale order
            query("insert into sale_orders (user_id,total_price,order_date) values (?,?,?)", [$user_id, $total_price, $time]);
            $soId = $conn->lastInsertId();

            foreach ($_SESSION['cart'] as $key => $val) {
                $product_id = str_replace('id-', '', $key);
                // save sale orde rdetail
                query("insert into sale_order_detail (sale_order_id,product_id,quantity,order_date) values (?,?,?,?)", [$soId, $product_id, $val, $time]);
            }

            // update customer detail
            query("update users set phone=?,address=? where id=?",[$phone,$address,$user_id]);

            // unset session
            unset($_SESSION['cart']);
            back('success', 'Orders success!', 'confirmation.php');
        }
       
    }
}



require "layout/header.php";

?>

<!--================Cart Area =================-->
<section class="cart_area" style="padding-top: 30px;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                <h3 style="color:#D1AD0C" class=" mb-2"><i class="feather-info mr-2"></i>Fill Your Detail</h3>
                <hr>
                <form action="" method="POST">
                    <input type="hidden" name="_token" class="form-control" value="<?php echo $_SESSION['_token']; ?>">
                    <div class="form-group">
                        <label for="phone">Enter Phone Number</label>
                        <input type="number" name="phone" class="form-control">
                        <?php isset($errors) ? validate($errors, 'phone') : '' ?>

                    </div>
                    <div class="form-group">
                        <label for="phone">Enter Address</label>
                        <textarea name="address" class="form-control"></textarea>
                        <?php isset($errors) ? validate($errors, 'address') : '' ?>

                    </div>
                    <button class="primary-btn btn text-white" style="border-radius: 0;">Check OUt</button>

                </form>
            </div>
        </div>
    </div>
</section>
<!--================End Cart Area =================-->


<?php require "layout/footer.php"; ?>

</body>

</html>