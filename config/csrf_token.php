<?php
    
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if (!isset($_POST['_token']) || ($_POST['_token'] !== $_SESSION['_token'])) {
          die('Invalid CSRF token');
        }else{
            unset($_SESSION['_token']);
        }
    }

    if (empty($_SESSION['_token'])) {
        if (function_exists('random_bytes')) {
            $_SESSION['_token'] = bin2hex(random_bytes(32));
        }else {
            $_SESSION['_token'] = bin2hex(openssl_random_pseudo_bytes(32));
        }
    }