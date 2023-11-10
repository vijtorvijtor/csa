<?php
session_start ();
$sesDur=10*60;
if(isset($_SESSION["idUser"]))
{
	if(time()-$_SESSION["start"] >$sesDur) 
    {
        session_unset();
        session_destroy();
        header("Location:login.php");
    }else 
    {
    	$_SESSION["start"]=time();
    }
}  else 
{
   header("location:login.php"); 
}
?>