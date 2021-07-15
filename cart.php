<?php
require "init.php";
if (!isset($_SESSION['cart'])) {
    back('errorModal', 'ဝယ်ယူမည့် product ကို အရင်ရွေးချယ်ပေးပါ', 'index.php');
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
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        if (isset($_SESSION['cart'])) {
                            $total = 0;
                            foreach ($_SESSION['cart'] as $key => $val) {
                                $product_id = str_replace('id-', '', $key);
                                $product = getSingle("select * from products where id=$product_id");
                                //   echo $val."<hr>";
                        ?>
                                <tr>
                                    <td>
                                        <div class="media">
                                            <div class="d-flex">
                                                <!-- <img src="img/cart.jpg" alt=""> -->
                                            </div>
                                            <div class="media-body">
                                                <p><?php echo $product->name; ?></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <h5><?php echo $product->price; ?> MMK</h5>
                                    </td>
                                    <td>
                                        <div class="product_count">
                                            <input readonly type="text" name="qty" id="sst<?php echo $product->id; ?>" maxlength="12" value="<?php echo $val; ?>" title="Quantity:" class="input-text qty">
                                            <button product_id="<?php echo $product->id; ?>" product_qty="<?php echo $product->quantity; ?>" class="increase items-count" type="button"><i class="lnr lnr-chevron-up"></i></button>
                                            <button product_id="<?php echo $product->id; ?>" class="reduced items-count" type="button"><i class="lnr lnr-chevron-down"></i></button>
                                        </div>
                                    </td>
                                    <td>
                                        <h5 id='total<?php echo $product->id; ?>' price="<?php echo $product->price; ?>">
                                            <?php echo $product->price * $val; ?> MMK
                                        </h5>
                                    </td>
                                </tr>
                        <?php }
                        } ?>
                        <tr class="out_button_area">
                            <td>

                            </td>
                            <td>

                            </td>
                            <td>

                            </td>
                            <td>
                                <div class="checkout_btn_inner d-flex align-items-center">
                                    <a class="primary-btn" href="<?php echo BASE_URL ?>clearall.php">Clear All</a>
                                    <a class="gray_btn" href="<?php echo BASE_URL ?>index.php">Continue Shopping</a>
                                    <a class="primary-btn" href="<?php echo BASE_URL ?>checkout.php"> Checkout</a>

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
<script>
    let increases = document.querySelectorAll(".increase");
    let reduces = document.querySelectorAll(".reduced");
    increases.forEach(increase => {
        increase.addEventListener('click', function() {
            let product_qty = increase.getAttribute('product_qty');
            let product_id = increase.getAttribute('product_id');
            let total = document.getElementById('total' + product_id);
            let price = total.getAttribute('price');
            let input = document.getElementById('sst' + product_id);

            let qty = Number(input.value);
            qty += 1;
            if (qty <= product_qty) {
                input.value = qty;
                let total_price = price * qty
                total.innerText = total_price + ' MMK';
            } else {
                input.value = product_qty;
            }
        })
    })
    reduces.forEach(reduced => {
        reduced.addEventListener('click', function() {
            let product_id = reduced.getAttribute('product_id');
            let input = document.getElementById('sst' + product_id);
            let total = document.getElementById('total' + product_id);
            let price = total.getAttribute('price');

            let qty = Number(input.value);
            qty -= 1;
            if (qty < 1) {
                qty = 1;
            } else {
                input.value = qty;
                let total_price = price * qty
                total.innerText = total_price + ' MMK';
            }
        })
    })
</script>
</body>

</html>