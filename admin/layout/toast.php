<?php
if (isset($_SESSION['success'])) {
?>
    <script>
        toastAlert('success', "<?php getSession('success'); ?>");
    </script>
<?php
    unset($_SESSION['success']);
}
?>
<?php
if (isset($_SESSION['error'])) {
?>
    <script>
        toastAlert('error', "<?php getSession('error'); ?>");
    </script>
<?php
    unset($_SESSION['error']);
}
?>
<!-- Error Modal Box-->
<?php
if (isset($_SESSION['errorModal'])) {
?>
    <script>
        alertModal('error','Error !', "<?php getSession('errorModal', 'errorModal'); ?>");
    </script>
<?php
    unset($_SESSION['errorModal']);
}
?>