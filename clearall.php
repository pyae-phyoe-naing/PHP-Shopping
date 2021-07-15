<?php
require 'init.php';
unset($_SESSION['cart']);
back('success','Clear all cart list !','index.php');