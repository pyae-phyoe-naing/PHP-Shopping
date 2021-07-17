<?php
require('../../init.php');
$title = 'Monthly Report';
if (!isset($_SESSION['user'])) {
back('errorModal', 'Account Login ဝင်ရန်လိုအပ်ပါသည်။','../login.php');
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