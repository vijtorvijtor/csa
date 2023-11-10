<?php

include_once('variables.php');
echo "<script type='text/javascript'>alert('cierrasesion.php:');</script>";
echo "<script type='text/javascript'>alert('--cierrasesion.php--INICIA ');</script>";

$msg="--cierrasesion.php-- Inicia con  ckUserAct:[".$ckUserAct."] ";
echo "<script type='text/javascript'>alert('".$msg."');</script>";
setcookie($ckUserAct,"",date()-39600);
ob_start(); // ensures anything dumped out will be caught

while (ob_get_status()) 
{
    ob_end_clean();
}


//header( "Location:index.php" );
$url="index.php";
echo "<SCRIPT>window.location='$url';</SCRIPT>";
die();
?>

