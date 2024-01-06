<?php
    include 'model/model.php';
    $user = new User();
  $list_user=$user ->get_all_user();
    include 'view/view.php';
?>