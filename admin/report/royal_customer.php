<?php
require('../../init.php');
$title = 'Royal Customer';
if (!isset($_SESSION['user'])) {
    back('errorModal', 'Account Login ဝင်ရန်လိုအပ်ပါသည်။', '../login.php');
}

$now = date('Y-m-d');
$from = date('Y-m-d', strtotime($now . ' -1 months'));
$data = getAll("SELECT * FROM `sale_orders` WHERE total_price >= 200000
                AND cast(order_date as date)<='$now' and cast(order_date as date)>'$from'
                ORDER BY total_price DESC 
               ");
## End
require('../layout/header.php');
?>

<div class="app-main__inner">
    <!-- Leading -->
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="feather-user-check icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div> Royal Customer In One Month
                </div>
            </div>

        </div>
    </div>
    <!-- Main Content -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-responsive-sm" id="royal_customer" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Customer</th>
                                <th>Total Amount</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Order Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($data as $od) {
                                $user = getSingle("SELECT * FROM users WHERE id=?", [$od['user_id']]);
                                 pretty($user->name);
                            ?>
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $user->name ?></td>
                                    <td><?php echo $od['total_price']; ?> MMK</td>
                                    <td><?php echo $user->phone ?></td>
                                    <td> <?php echo $user->address ?></td>
                                    <td>
                                        <span class="mr-3">
                                            <i class="pe-7s-date mr-1"></i>
                                            <?php echo date_format(date_create($od['order_date']), "d F Y "); ?>
                                        </span>

                                    </td>
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
        $('#royal_customer').DataTable();
    });
</script>
</body>

</html>