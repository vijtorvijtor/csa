<?php
/*
global $conn;
global $ckUserAct;
global $idUser;
global $idUN;
global $hayCookieU;
global $segundosConn;
global $dbhost;
global $dbuser;
global $dbpass;
global $dbname;
*/
   //session_start();

$GLOBALS["general"];
$GLOBALS["conn"];
$GLOBALS["ckUserAct"];
$GLOBALS["idUser"];
$GLOBALS["idUN"];
$GLOBALS["hayCookieU"];
$GLOBALS["segundosConn"];
$GLOBALS["dbhost"];
$GLOBALS["dbuser"];
$GLOBALS["dbpass"];
$GLOBALS["dbname"];
$GLOBALS["segundosConn"]=3600;
$GLOBALS["ckUserAct"] = 'cookieU';
$GLOBALS["dbhost"] = 'localhost';
$GLOBALS["dbuser"] = 'abejashc_optica';   
$GLOBALS["dbpass"] = '1Abejash(*@';
$GLOBALS["dbname"] = 'abejashc_optica';
$GLOBALS["general"]=98765;

//$GLOBALS["conn"]=0;

function sesionVigente()
{
	$ckUserAct=$GLOBALS["ckUserAct"];
	$hayCookieU=$GLOBALS["hayCookieU"];
	$idUser=$GLOBALS["idUser"];
	$idUN=$GLOBALS["idUN"];
	$hayCookieU=$GLOBALS["hayCookieU"];
	$userNombre=$GLOBALS["userNombre"];
	$segundosConn=$GLOBALS["segundosConn"];
	
	$msg="--sesionVigente()-- Inicia";
	//echo "<script type='text/javascript'>alert('".$msg."');</script>";
	if (isset($_COOKIE[$ckUserAct])) 
	{
		$GLOBALS["hayCookieU"]="SI";
		$valores=$_COOKIE[$ckUserAct];
		$valores_array=explode("|", $valores);
		$GLOBALS["idUser"]=$valores_array[0];
		$GLOBALS["idUN"]=$valores_array[1];
		$GLOBALS["userNombre"]=$valores_array[2];
		$valor=$idUser."|".$idUN."|".$userNombre;
		$fecha=time()+$segundosConn;
		setcookie($ckUserAct,$valor,$fecha." UTC",  '/; samesite=strict');
		$msg="[".$ckUserAct."], el valor es[".$valores."]";
		//echo "==funcion sesionvigente()== sesion abierta, se alarga el tiempo de sesion.";	
	}
	else
	{
		$GLOBALS['idUser']=-99;
		$GLOBALS['hayCookieU']="NO";
//		$url="login.php";
//		header("Location:login.php");
		//echo "<SCRIPT>window.open('".$url."', '_self');</SCRIPT>";
	}
}

	function lanzaLogin()
  	{
  		if($GLOBALS["idUser"]=="-99")
  		{
  			$msg="--index.php-- Lanzara login.php porque idUser:[".$GLOBALS['idUser']."] es -99";
			//echo "<script type='text/javascript'>alert('".$msg."');</script>";
			$url="login.php";
			echo "<SCRIPT>window.open('".$url."', '_self');</SCRIPT>";
			exit;
			//die();
			//header("Location:login.php");  		
  		}
  		else
  		{
  			$msg="--index.php-- idUser es [".$GLOBALS['idUser']."]<> -99, no lanza login";
			//echo "<script type='text/javascript'>alert('".$msg."');</script>";
  		
  		}
  	}

function cierraSesion()
{
	$ckUserAct=$GLOBALS["ckUserAct"];
	$msg="--cierraSesion()-- Inicia";
	//echo "<script type='text/javascript'>alert('".$msg."');</script>";
	setcookie($ckUserAct,"",date()-39600);
	ob_start(); // ensures anything dumped out will be caught
	while (ob_get_status()) 
	{
		ob_end_clean();
	}
	$url="index.php";
	echo "<SCRIPT>window.location='$url';</SCRIPT>";
}

function conectaDB()
{
	$dbhost=$GLOBALS["dbhost"];
	$dbname=$GLOBALS["dbname"];
	$dbuser=$GLOBALS["dbuser"];
	$dbpass=$GLOBALS["dbpass"];
	$gen=$GLOBALS["general"];
	$conn=mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
	$GLOBALS["conn"]=$conn;
	$msg="--conectaDB()-- Conecta DB con [".$dbhost.", ".$dbname.", ".$dbuser."], gen:[".$gen."], threadsss:[".mysqli_thread_id($GLOBALS["conn"])."]";
	//echo "<script type='text/javascript'>alert('".$msg."');</script>";
	if (mysqli_connect_errno()) {
		die("ERROR al intentar conectar a la base de datos [".$dbhost.", ".$dbname.", ".$dbuser."]: " .mysqli_connect_error())."<br>";
		} 	
}

?>