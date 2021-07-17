<?php
require('../../init.php');
$title = 'Best Seller Item';
if (!isset($_SESSION['user'])) {
back('errorModal', 'Account Login ဝင်ရန်လိုအပ်ပါသည်။','../login.php');
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
                    <i class="pe-7s-shopbag icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div> Best Seller Item
                </div>
            </div>

        </div>
    </div>
    <!-- Main Content -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header"> List</div>
                <div class="card-body">
                   
                </div>
            </div>
        </div>

    </div>
</div>

<?php require('../layout/footer.php') ?>
<script>
    function deleteCat(slug) {

        Swal.fire({
            title: 'Are you sure delete?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            reverseButtons: true,
            confirmButtonText: 'Confirm',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            showCancelButton: true,
            preConfirm: () => {
                $.get(`delete.php?slug=${slug}`)
            },
        }).then(res => {
            if(res.isConfirmed){
                location.reload();
            }
        })

    }
</script>

</body>

</html>