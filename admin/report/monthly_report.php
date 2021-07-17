<?php
require('../../init.php');
$title = 'Monthly Report';
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
                    <i class="pe-7s-note2 icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div> Monthly Report
                </div>
            </div>

        </div>
    </div>
    <?php
    $now = date('Y-m-d');
    //  $from = date('Y-m-d', strtotime('-7 days', strtotime($now))); OR
    $from = date('Y-m-d', strtotime($now . ' -1 months'));
    $data = getAll("select *,(select name from users where sale_orders.user_id=users.id) as user
                   from sale_orders where cast(order_date as date)<='$now' and cast(order_date as date)>'$from' ");
    // pretty($data);
   
    ?>
    <!-- Main Content -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Monthly Report List</div>
                <div class="card-body">
                    <table class="table" id="weekly_report" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Customer</th>
                                <th>Total Amount</th>
                                <th>Order Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($data as $od) {
                            ?>
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $od['user'] ?></td>
                                    <td><?php echo $od['total_price']; ?> MMK</td>
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
        $('#weekly_report').DataTable();
    });
</script>
</body>

</html>