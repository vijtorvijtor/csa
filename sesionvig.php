<?php
/*Verifica si existe cookie cambia bandera a SI y extiende el tiempo de vida a partide ahora
*/ 
//include_once('variables.php');
$ckUserAct=$GLOBALS["ckUserAct"];
$hayCookieU=$GLOBALS["hayCookieU"];
$idUser=$GLOBALS["idUser"];
$idUN=$GLOBALS["idUN"];
$userNombre=$GLOBALS["userNombre"];

if (isset($_COOKIE[$ckUserAct])) {
	$hayCookieU="SI";
	$valores=$_COOKIE[$ckUserAct];
	$valores_array=explode("|", $valores);
	$idUser=$valores_array[0];
	$idUN=$valores_array[1];
	$userNombre=$valores_array[2];
	$valor=$idUser."|".$idUN."|".$userNombre;
	$fecha=time()+$segundosConn;
	setcookie($ckUserAct,$valor,$fecha,  '/; samesite=strict');
	$msg="[".$ckUserAct."], el valor es[".$valores."]";
	echo "==sesionvigente.php== sesion abierta, se alarga el tiempo de sesion.";	
}
else {
	$idUser=-99;
	$hayCookieU="NO";
	echo "==sesionvigente.php== sesion abierta, se pide login porque no hay cookie.";	
	echo "<script type='text/javascript'>alert('sesionvig.php no encontro cookie');</script>";
	$url="login.php";
	echo "<SCRIPT>window.open('".$url."', '_self');</SCRIPT>";
	die();
	//header("Location:login.php");
	//die();
}
?>
