<?php
require '../../init.php';
if (isset($_GET['slug'])) {
    $slug = $_GET['slug'];

    $product = getSingle("select * from products where slug=?", [$slug]);
    if ($product) {
        ## delete image
        unlink("../assets/images/products/" . $product->image);
        ## delete database record
        query("delete from products where slug=?", [$slug]);
        back('success', 'product deleted', 'index.php');
    } else {
        back('error', 'Product not found', 'index.php');
    }
} else {
    back('error', 'Product not found', 'index.php');
}
