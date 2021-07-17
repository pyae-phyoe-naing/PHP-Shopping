<?php
require('../../init.php');
$title = 'Weely Report';
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
                <div> Weely Report
                </div>
            </div>

        </div>
    </div>
    <?php
    $now = date('Y-m-d');
    $from = date('Y-m-d', strtotime('-7 days', strtotime($now))); 
    $data = getAll("select * from sale_orders where cast(order_date as date)<='$now' and cast(order_date as date)>'$from' ");
    pretty($data);
    ?>
    <!-- Main Content -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Category List</div>
                <div class="card-body">

                </div>
            </div>
        </div>

    </div>
</div>

<?php require('../layout/footer.php') ?>

</body>

</html>