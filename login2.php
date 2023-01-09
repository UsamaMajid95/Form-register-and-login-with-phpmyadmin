<?php

require 'function.php';
if(isset($_SESSION['id'])){
    header("Location:home.php");
}


if(isset($_POST['login'])){
   $login1 = new Login();
   $result =  $login1->login_user($_POST['login'],$_POST['password']);
   echo $result;
}

?>