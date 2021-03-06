<?php
require('../../init.php');
$title = 'Order';
if (!isset($_SESSION['user'])) {
    back('errorModal', 'Account Login ဝင်ရန်လိုအပ်ပါသည်။', '../login.php');
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
                    <i class="pe-7s-cart icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div> Order
                </div>
            </div>

        </div>
    </div>
    <!-- Main Content -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Order List</div>
                <div class="card-body">

                    <table class="table table-bordered table-responsive-sm">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Customer</th>
                                <th>Address</th>
                                <th>Total Price</th>
                                <th>Order Date</th>
                                <th>Action</th>
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
                                $rawData = getAll("SELECT * FROM sale_orders ORDER BY id DESC");
                                $total_pages = ceil(count($rawData) / $numOfrecord);
                                $result = getAll("SELECT * FROM sale_orders ORDER BY id DESC LIMIT $offset,$numOfrecord ");
                            }
                            if ($result) {
                                $i = 1;
                                foreach ($result as $value) {
                                    $user = getSingle("select * from users where id=? and role=0", [$value['user_id']]);
                            ?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo escape($user->name); ?></td>
                                        <td>
                                            <span class="mr-3">
                                                <i class="pe-7s-map mr-1"></i>
                                                <?php echo $user->address; ?>
                                            </span>
                                            <br>
                                            <span>
                                                <i class="pe-7s-phone mr-1"></i>
                                                <?php echo $user->phone; ?>
                                            </span>
                                        </td>
                                        <td><?php echo escape($value['total_price']); ?> MMK</td>
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
                                        <td class='text-center'>
                                            <a href="order_detail.php?id=<?php echo $value['id']; ?>" class="btn btn-sm btn-success mr-2">
                                                View
                                            </a>

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
    // function deleteCat(slug) {

    //     Swal.fire({
    //         title: 'Are you sure delete?',
    //         text: "You won't be able to revert this!",
    //         icon: 'warning',
    //         reverseButtons: true,
    //         confirmButtonText: 'Confirm',
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         showCancelButton: true,
    //         preConfirm: () => {
    //             $.get(`delete.php?slug=${slug}`)
    //         },
    //     }).then(res => {
    //         if(res.isConfirmed){
    //             location.reload();
    //         }
    //     })

    // }
</script>

</body>

</html>