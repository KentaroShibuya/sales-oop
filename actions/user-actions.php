<?php
include "../classes/user.php";

$user = new User;
if(isset($_POST['register'])){
  $user->store($_POST);
}elseif(isset($_POST['login'])){
  $user->login($_POST);
}

?>