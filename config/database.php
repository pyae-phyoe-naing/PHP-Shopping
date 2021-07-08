<?php

define('MYSQL_HOST', 'localhost');
define('MYSQL_DATABASE', 'php_shopping');
define('MYSQL_USER', 'root');
define('MYSQL_PASSWORD', '');

try {
    $conn = new PDO("mysql:host=".MYSQL_HOST.";dbname=".MYSQL_DATABASE,MYSQL_USER,MYSQL_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    echo 'Database connection fail : '.$e->getMessage();
}


function getSingle($sql,$params=[]){
    global $conn;
    $stmt = $conn->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetch(PDO::FETCH_OBJ);
}
function getAll($sql,$params=[]){
    global $conn;
    $stmt = $conn->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}