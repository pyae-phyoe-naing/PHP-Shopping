<?php
require '../../init.php';
if (isset($_GET['slug'])) {
    $slug = $_GET['slug'];
    $cat = getSingle("select * from categories where slug=?", [$slug]);
    if ($cat) {
      query("delete from categories where slug=?",[$slug]);
      back('success','category deleted','index.php');
    }else{
        back('error','Category not found','index.php');
    }
}else{
    back('error','Category not found','index.php');

}
