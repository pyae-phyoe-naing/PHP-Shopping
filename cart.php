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
                                        <h5 id="original_price<?php echo $product->id; ?>" price="<?php echo $product->price; ?>"><?php echo $product->price; ?> MMK</h5>
                                    </td>
                                    <td>
                                        <div class="product_count">
                                            <input readonly type="text" name="qty" id="sst<?php echo $product->id; ?>" maxlength="12" value="<?php echo $val; ?>" title="Quantity:" class="input-text qty">
                                            <button product_id="<?php echo $product->id; ?>" product_qty="<?php echo $product->quantity; ?>" class="increase items-count" type="button"><i class="lnr lnr-chevron-up"></i></button>
                                            <button product_id="<?php echo $product->id; ?>" class="reduced items-count" type="button"><i class="lnr lnr-chevron-down"></i></button>
                                        </div>
                                    </td>
                                    <td>
                                        <h5 id='total<?php echo $product->id; ?>'>
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
    let main_total = document.getElementById('main_total');

    let increases = document.querySelectorAll(".increase");
    let reduces = document.querySelectorAll(".reduced");
    let count = document.querySelector('.count');
    increases.forEach(increase => {
        increase.addEventListener('click', function() {
            let product_qty = increase.getAttribute('product_qty');
            let product_id = increase.getAttribute('product_id');
            let main_total_price = main_total.innerHTML.replace('MMK', '').trim();
            let original_price = document.getElementById('original_price' + product_id).getAttribute('price');

            let total = document.getElementById('total' + product_id);
            let input = document.getElementById('sst' + product_id);

            let qty = Number(input.value);
            qty += 1;
            if (qty <= product_qty) {
                    count.innerHTML = Number(count.innerHTML) + 1;
                    input.value = qty;
                let total_price = original_price * qty
                total.innerText = total_price + ' MMK';
                main_total.innerHTML = Number(main_total_price) + Number(original_price) + ' MMK';
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
            let main_total_price = main_total.innerHTML.replace('MMK', '').trim();
            let original_price = document.getElementById('original_price' + product_id).getAttribute('price');


            let qty = Number(input.value);
            qty -= 1;
            if (qty < 1) {
                qty = 1;
            } else {
                count.innerHTML = Number(count.innerHTML) - 1;
                input.value = qty;
                let total_price = original_price * qty
                total.innerText = total_price + ' MMK';
                main_total.innerHTML = Number(main_total_price) - Number(original_price) + ' MMK';
            }
        })
    })
</script>
</body>

</html>