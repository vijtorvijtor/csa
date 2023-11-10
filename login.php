<?php
session_start ();
?>
<!DOCTYPE html>

<html>
<head>
 	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
  	<meta name="viewport" content="width=device-width, initial-scale=1" >
  	<link rel="stylesheet" href="css/estilos.css?<?php echo time(); ?>" > 
  	<link rel="stylesheet" href="jquery.mobile/jquery.mobile.min.css" > 
  	<script src="jquery/jquery.min.js"></script>
  	<script src="jquery/jquery-ui.min.js"></script>
  	<link href="jquery/jquery-ui.css" rel="stylesheet" >
  	<link href="jquery/select2.min.css" rel="stylesheet" >
	<script src="jquery/select2.min.js"></script>	
</head>
<body>
<div id="loc" class="infoCon"></div>
<div id="org" class="infoCon"></div>
<div id="browser" class="infoCon"></div>
<div id="ip" class="infoCon"></div>



<center>
	<fieldset style="background-color:var(--fondo); padding: 1px 1px 1px 1px color=var(--nones) " >
	<legend style="background-color:var(--fondo);  color: var(--nones)">Login </legend>
	<form style="background-color:var(--fondo); padding: 1px 1px 1px 1px" action="checklogin.php" method="POST"><br><br>
		<input type="hidden" id="idIp" name="nmIpExt">
		<input type="hidden" id="idLoc" name="nmLugar">
		<input type="hidden" id="idOrg" name="nmCarrier">
		<input type="hidden" id="idBrowser" name="nmBrowser">

		Usuario:<input type="text" required="" name="uname"><br><br>
		Contraseña:<input type="password" required="" name="upassword"><br><br>
		<input type="submit" value="Login" name="sub">
		<br>
		<?php 
		if(isset($_REQUEST["err"]))
			$msg="Sin acceso, datos incorrectos";
		?>
		<p style="color:red;">
			<?php 
				if(isset($msg))
				{	
					echo $msg;
				}
			?>
		</p>
	</form>
	</fieldset>
</center>
<script type="text/javascript">
// Base
let apiKey = 'd9e53816d07345139c58d0ea733e3870';



  //$.getJSON('http://ip-api.com/json', function(data) {

 $.getJSON('http://smart-ip.net/geoip-json?callback=?', function(data) {



console.log(JSON.stringify(data, null, 2));

ipLoc="<?php echo $_SERVER['REMOTE_ADDR']; ?>";

$("#response").html(JSON.stringify(data, null, 2)+"ipLOCAL ["+ipLoc+"]");
  $("#idIp").val(data.geoplugin_request);
  $("#idLoc").val(data.geoplugin_city+", "+data.geoplugin_region);
  $("#idOrg").val(data.org);
  $("#idBrowser").val(navigator.userAgent);
  $("#ip").html(data.geoplugin_request);
  $("#loc").html(data.geoplugin_city+", "+data.geoplugin_region);
  $("#org").html(data.org);
  $("#browser").html(navigator.userAgent);

  console.log(navigator);
});

</script>

</body>

</html>

