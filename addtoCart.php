<?php
require "init.php";
if ($_POST) {

    $qty = $_POST['qty'];
    $product_id = $_POST['id'];
    $slug = $_POST['slug'];

    $product = getSingle("select * from products where slug='$slug'");

    if (isset($_SESSION['cart']['id-' . $product_id])) {
        $old_qty = $_SESSION['cart']['id-' . $product_id];
        $add_qty =  $old_qty + $qty;
        // check add qty amount > product qty
        if ($add_qty > $product->quantity) {
             ## if > set session old qty value
            $_SESSION['cart']['id-' . $product_id] = $old_qty;
            back('errorModal', 'Product အလုံအလောက်မရှိတော့ပါ !', 'product_detail.php?slug=' . $slug);
        } else {
            ## if not > set session old + new qty
            $_SESSION['cart']['id-' . $product_id] += $qty;
        }
    } else {
        if ($qty > $product->quantity) {
            back('errorModal', 'အလုံအလောက်မရှိတော့ပါ !', 'product_detail.php?slug=' . $slug);
        } else {
            $_SESSION['cart']['id-' . $product_id] = $qty;
        }
    }

    back('success', 'Add to cart ', 'product_detail.php?slug=' . $slug);
}
