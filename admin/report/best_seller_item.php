<?php
require('../../init.php');
$title = 'Best Seller Item';
if (!isset($_SESSION['user'])) {
    back('errorModal', 'Account Login ဝင်ရန်လိုအပ်ပါသည်။', '../login.php');
}
$now = date('Y-m-d');
$from = date('Y-m-d', strtotime($now . ' -1 months'));
$data = getAll("SELECT product_id,SUM(quantity) AS total_quantity
                FROM `sale_order_detail` 
                WHERE cast(order_date as date)<='$now' and cast(order_date as date)>'$from' 
                GROUP BY product_id 
                HAVING SUM(quantity) >= 7
                ORDER BY SUM(quantity) DESC");
//pretty($data);
## End
require('../layout/header.php');
?>

<div class="app-main__inner">
    <!-- Leading -->
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-shopbag icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div> Best Seller Item In One Month
                </div>
            </div>

        </div>
    </div>
    <!-- Main Content -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table" id="best_seller_item" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Price</th>
                                <th>Total Quantity</th>
                                <th>Total Price</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($data as $od) {
                                $product = getSingle("SELECT * FROM products WHERE id=?", [$od['product_id']]);
                                // pretty($product->name);

                            ?>
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $product->name ?></td>
                                    <td>
                                        <img src="<?php echo BASE_URL . 'admin/assets/images/products/' . $product->image; ?>" width="50" height="50">
                                    </td>
                                    <td><?php echo $product->price ?> MMK</td>
                                    <td> <?php echo $od['total_quantity'] ?> </td>
                                    <td><?php echo $od['total_quantity'] * $product->price ?> MMK</td>

                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

<?php require('../layout/footer.php') ?>
<script>
    $(document).ready(function() {
        $('#best_seller_item').DataTable();
    });
</script>

</body>

</html>