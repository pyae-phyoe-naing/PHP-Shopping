<?php
require('../../init.php');
$title = 'Order Detail';
if (!isset($_SESSION['user'])) {
    back('errorModal', 'Account Login ဝင်ရန်လိုအပ်ပါသည်။', 'login.php');
}
## For search Paginate Set Cookie
if (empty($_POST['search'])) {
    if (empty($_GET['pageno'])) {
        unset($_COOKIE['search']);
        setcookie('search', null, -1, '/');
    }
} else {
    setcookie('search', $_POST['search'], time() + (8600 * 30), "/");
}

## End
require('../layout/header.php');
?>

<div class="app-main__inner">
    <!-- Leading -->
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-info icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div> Order Detail
                </div>
            </div>

        </div>
    </div>
    <!-- Main Content -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                        <a class="btn btn-secondary btn-sm" href="<?php echo BASE_URL; ?>admin/order/index.php">Back</a>
                </div>
                <div class="card-body">

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total Price</th>
                                <th>Order Date</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($_GET["pageno"])) {
                                $pageno = $_GET["pageno"];
                            } else {
                                $pageno = 1;
                            }
                            $numOfrecord = 5;
                            $offset = ($pageno - 1) * $numOfrecord;

                            if (empty($_POST["search"]) && empty($_COOKIE['search'])) {
                                $rawData = getAll("SELECT * FROM sale_order_detail WHERE sale_order_id=?", [$_GET['id']]);
                                $total_pages = ceil(count($rawData) / $numOfrecord);
                                $result = getAll("SELECT * FROM sale_order_detail WHERE sale_order_id=? ORDER BY id DESC LIMIT $offset,$numOfrecord ", [$_GET['id']]);
                            }
                            if ($result) {
                                $i = 1;
                                foreach ($result as $value) {
                                    $product = getSingle("select * from products where id=?", [$value['product_id']]);
                            ?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo escape($product->name); ?></td>
                                        <td>
                                            <img src="<?php echo BASE_URL . 'admin/assets/images/products/' . $product->image;; ?>" width="50" height="50">
                                        </td>
                                        <td>
                                            <?php echo $product->price; ?>
                                        </td>
                                        <td>
                                            <?php echo $value['quantity']; ?>
                                        </td>
                                        <td><?php echo $value['quantity'] * $product->price; ?> MMK</td>
                                        <td>
                                            <span class="mr-3">
                                                <i class="pe-7s-date mr-1"></i>
                                                <?php echo date_format(date_create($value['order_date']), "d F Y "); ?>
                                            </span>
                                            <span>
                                                <i class="pe-7s-clock mr-1"></i>
                                                <?php echo date_format(date_create($value['order_date']), " h:i:a"); ?>
                                            </span>
                                        </td>

                                    </tr>
                            <?php }
                            } ?>
                        </tbody>

                    </table>
                    <p>
                    <nav aria-label="Page navigation">
                        <ul class="pagination mt-3">
                            <!-- First -->
                            <li class="page-item ">
                                <a class="page-link" href="?pageno=1">First</a>
                            </li>
                            <li class="page-item <?php echo $pageno <= 1 ? 'disabled' : '' ?>">
                                <a class="page-link" href="<?php echo $pageno <= 1 ? '#' : '?pageno=' . ($pageno - 1); ?>">
                                    Previous
                                </a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#"><?php echo $pageno; ?></a></li>
                            <li class="page-item <?php echo $pageno >= $total_pages ? 'disabled' : ''; ?>">
                                <a class="page-link" href="<?php echo $pageno >= $total_pages ? '#' : '?pageno=' . ($pageno + 1);  ?>">
                                    Next
                                </a>
                            </li>
                            <!-- last -->
                            <li class="page-item">
                                <a class="page-link" href="?pageno=<?php echo $total_pages; ?>">Last</a>
                            </li>
                        </ul>
                    </nav>
                    </p>
                </div>
            </div>
        </div>

    </div>
</div>

<?php require('../layout/footer.php') ?>
<script>

</script>

</body>

</html>