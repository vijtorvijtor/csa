<?php
session_start ();
include("config.php");
if(isset($_REQUEST['sub']))
{
    $iptUser = $_REQUEST['uname'];
    $iptPass = $_REQUEST['upassword'];
    $ip=$_REQUEST['nmIpExt'];
    $browser=$_REQUEST['nmBrowser'];
    $carrier=$_REQUEST['nmCarrier'];
    $lugar=$_REQUEST['nmLugar'];
    $sQry="SELECT * FROM usuario WHERE user='$iptUser' AND pass='$iptPass'";
    $oRet = mysqli_query($conn, $sQry);
    if(mysqli_num_rows($oRet) == 0)
    {
        echo "No hay";

        fAlerta('NO HAY registros ['.$iptUser.",".$iptPass."]");
        /*
        $dispositivo=$browser."#".$carrier."#".$lugar; 
        $sQry="INSERT INTO accesos (idUser, fecha, IP, dispositivo) VALUES('$ip,'$dispositivo')";
        echo $sQry;
        */
        fAlerta("Usuario no encontrado");
        header("location:login.php?err=1");

    }
    else 
    {
        
        $row = mysqli_fetch_assoc($oRet);
        $_SESSION['start'] = time(); // Taking now logged in time.
        // Ending a session in 30 minutes from the starting time.
        $_SESSION["idUser"]=$row["id"];
        $idUser=$_SESSION["idUser"];
        $_SESSION["conexion"]=$conn;
        $_SESSION["user"]=$row["user"];
        $_SESSION["nivel"]=$row["nivel"];
        $sTmp="Encontro almenos 1 coincidecia de user/pass [$iptUser/$iptPass ".$_SESSION['idUser']."]";
        //fAlerta($sTmp);
        $dispositivo=$browser."#".$carrier."#".$lugar; 
        date_default_timezone_set('America/Mexico_City');
        $nIdRx=0;
        $date = new DateTime;
        $sFecha=date_format($date, 'Y-m-d H:i');
        $sQry="INSERT INTO accesos (idUser, fecha, IP, dispositivo) VALUES($idUser,'$sFecha','$ip','$dispositivo')";
        $tx="Asi guarda el registro[$sQry]";
        //fAlerta($tx);
        
        if (mysqli_query($conn, $sQry)) {
            $a=1;
            //echo "Nuevo Registro!";
         } else {
            
            echo "Error: " . $sQql . "<br>[".$sQry."]" . mysqli_error($conn);
         }
        header("location:index.php");

    }    
}
?>




