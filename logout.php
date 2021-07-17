  
<?php
require 'init.php';
unset($_SESSION["user"]);
unset($_SESSION['cart']);
redirect("login.php");

