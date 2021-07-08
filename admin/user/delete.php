<?php
require '../../init.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $cat = getSingle("select * from users where id=? and role=?", [$id,0]);
    if ($cat) {
      query("delete from users where id=? and role=?",[$id,0]);
      back('success','user deleted','index.php');
    }else{
        back('error','user not found','index.php');
    }
}else{
    back('error','user not found','index.php');

}
