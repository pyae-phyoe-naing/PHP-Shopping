<?php
require('../../init.php');
$title = 'User';
if (!isset($_SESSION['user'])) {
    setSession('errorModal', 'Account Login ဝင်ရန်လိုအပ်ပါသည်။');
    redirect('login.php');
    die();
}

require('../layout/header.php');
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
       
    </div>
</div>

<?php require('../layout/footer.php') ?>

</body>

</html>