<?php
require('../init.php');
$title = 'Dashboard';
if (!isset($_SESSION['user'])) {
    back('errorModal', 'Account Login ဝင်ရန်လိုအပ်ပါသည်။', 'login.php');
}
 ## check data
$dateArr = [];
$customerArr = [];
$orderArr = [];

$today = date("Y-m-d");
for ($i = 0; $i < 7; $i++) {
    $date = date_create($today);
    date_sub($date, date_interval_create_from_date_string("$i days"));
    $current = date_format($date, "Y-m-d");
    array_push($dateArr, $current);
    $data = getAll("SELECT COUNT(id) AS customer FROM users WHERE cast(created_at AS DATE)='$current'");
    array_push($customerArr, $data[0]['customer']);
    $order = getAll("SELECT COUNT(id) AS order_count FROM sale_orders WHERE cast(order_date AS DATE)='$current'");
    array_push($orderArr, $order[0]['order_count']);
   
}
## get order count
$order_count = 0;
foreach($orderArr as $order){
    $order_count = $order_count + $order;
}

require('layout/header.php');
?>

<div class="app-main__inner">
    <!-- Leading -->
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-home icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div> Dashboard
                </div>
            </div>

        </div>
    </div>
    <!-- Main Content -->
    <div class="row">
        <div class="col-md-6 col-xl-4">
            <div class="card mb-3 widget-content bg-midnight-bloom">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading"> Orders</div>
                        <div class="widget-subheading">Total orders per week</div>
                    </div>
                
                    <div class="widget-content-right">
                        <div class="widget-numbers text-white"><span><?php echo $order_count ?></span></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-4">
            <div class="card mb-3 widget-content bg-arielle-smile">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading">Products</div>
                        <div class="widget-subheading">Total Products Profit</div>
                    </div>
                    <?php
                    $product = getAll('select count(id) as product_count from products');
                    $count = $product[0]['product_count'];
                    ?>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-white"><span><?php echo $count; ?></span></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-4">
            <div class="card mb-3 widget-content " style="background-color: #EB3F86;">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading"> Users</div>
                        <div class="widget-subheading">Total Clients Profit</div>
                    </div>
                    <div class="widget-content-right">
                        <?php
                        $user = getAll('select count(id) as user_count from users where role=0');
                        $count = $user[0]['user_count'];
                        ?>
                        <div class="widget-numbers text-white"><span><?php echo $count; ?></span></div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="row  align-items-end mt-3">
        <div class="col-12 col-xl-7">
            <div class="card overflow-hidden shadow mb-4">
                <div class="">
                    <div class="d-flex justify-content-between align-items-center p-3 ">
                        <h5 class='mb-0'>Order - Customer</h5>
                        <div class="">
                            <img width="42" class="rounded-circle" alt="">
                            <?php
                            $users = getAll("select * from users where role=0");
                            foreach ($users as $user) {
                            ?>
                                <img class='ov-img rounded-circle' alt="" style=" margin-left: -25px;"
                                 width="<?php echo !$user['image'] ? '49' : '' ;?>"  height="<?php echo !$user['image'] ? '49' : '' ;?>"
                                 src="<?php echo $user['image'] ? BASE_URL.'admin/assets/images/users/'.$user['image'] : 
                                  "https://ui-avatars.com/api/?background=0D8ABC&color=fff&name=" . $user['name'];  ?>">
                            <?php } ?>
                        </div>
                    </div>
                    <canvas id="ov" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require('layout/footer.php');?>
<script>
    let dateAr = <?php echo json_encode($dateArr); ?>;
    let orderCountArr =  <?php echo json_encode($orderArr); ?>;
     console.log(orderCountArr);
    let customerCountArr = <?php echo json_encode($customerArr); ?>;
    var ctx = document.getElementById('ov').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: dateAr,
            datasets: [
                {
                    label: 'Order Count',
                    data: orderCountArr,
                    backgroundColor: ['#EFF6FF'],
                    borderColor: ['#93C5FD'],
                    borderWidth: 1,
                    tension: 0
                },
                {
                    label: 'Customer Count',
                    data: customerCountArr,
                    backgroundColor: ['#ECFDF5'],
                    borderColor: ['#6EE7B7'],
                    borderWidth: 1,
                    tension: 0
                },
            ]
        },
        options: {
            scales: {
                yAxes: [{
                    display: false,
                    ticks: {
                        beginAtZero: true
                    }
                }],
                xAxes: [{
                    display: false,
                    gridLines: [{
                        display: false,
                    }]
                }]
            },
            legend: {
                display: true,
                position: 'top',
                labels: {
                    fontColor: '#333',
                    usePointStyle: true,
                }
            }
        }
    });
</script>
</body>

</html>