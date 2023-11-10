<?php
session_start ();
include("config.php");
include("sesionCheck.php");
encabezado();
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
    <script type="text/javascript" src="js/utils.js"></script>
     <link href="css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<style>
	.select2-container .select2-choice {
    height: 200px!important;
    line-height: 200px!important;
    max-height: 200px;
    min-height: 200px !important;
}
</style>	

<body>
<script type="text/javascript">enciendeMenu("encab5");</script>
<h2>Catalogos</h2>

<?php

?>
<br>
<div id="divTablas">
    
    <select name="catalogos" id="idSelCatalogo">
        <option value="0">--Selecciona un catalogo--</option>
        <option value="1">Marcas</option>
        <option value="2">Productos</option>
        <option value="3">Tipo de producto</option>
        <option value="4">Precios</option>
        <option value="5">Usuarios</option>
    </select>
    <div >
        <input type="button" style="color: white; background-color: #4caf50; text-decoration: none; border-radius: 4px; display: inline-block; font-size: 100%;" id="idAdministrar" value="Administrar" name="nmAdministrar" onclick="fAdministraCatalogo()">

    </div>

</div>
<div id="tablaDinamica"></div>
</body>
<script type="text/javascript" src="js/utils.js"></script>
<script type="text/javascript">
function ready0(){
propSelect2();

}; //Fin de ready0

function fAdministraCatalogo(){
    nSel=document.getElementById("idSelCatalogo").value;
    console.log("Catalogo seleccionado:["+nSel+"]");
    campos= new Array();
    nombres= new Array();
    switch(nSel){
        case "1"://Marcas
            console.log("selecciono MARCAS");
            sTbl="catMarca";
            break;
        case "2"://Productos
            console.log("selecciono PRODUCTOS");
            sTbl="catProducto";
            break;
        case "3"://Productos
            console.log("selecciono TIPO DE PRODUCTOS");
            sTbl="catTipo";
            break;
        case "4"://Productos
            console.log("selecciono PRECIOS");
            sTbl="precio";
            break;
        case "5"://Productos
            console.log("selecciono USUARIOS");
            sTbl="usuario";
            break;
        default://
            console.log("Seleccion no valida");
            break;

    } //Fin del switch
    sQry="SELECT id, nbeTabla FROM tablas WHERE nbeTabla='"+sTbl+"'";
    arrCampos0=new Array();
    arrNombres0=new Array();
    arrCampos0.push("id");
    arrCampos0.push("nbeTabla");
    arrNombres0.push("ID");
    arrNombres0.push("Tabla");
    $.ajax({type: 'POST',url: 'fAjax.php', dataType: 'json', cache: false, async: false, data: {Key:"qryArray", 'Query':sQry, 'arrCampos':arrCampos0, 'arrNombres':arrNombres0, 'arcPHP':"catalogos.php"},  success: function(data) {
        nRet=data;
        console.log(data);
        },
        error: function (error) {
            alert("ERROR: ["+JSON.stringify(error)+"]");
        }
        }); //Fin de ajax
    //arrRet=JSON.parse(nRet);
    nbeTabla=nRet[0].Tabla;
    //Construye tabla
    sQry="SELECT * FROM "+nbeTabla;
        $.ajax({type: 'POST',url: 'fAjax.php',  cache: false, async: false, data: {Key:"tabla00", 'Query':sQry, 'arrCampos':arrCampos0, 'arrNombres':arrNombres0, orden:"nbeTabla"},  success: function(data) {
        sRet=data;
        console.log(data);
        },
        error: function (error) {
            alert("ERROR: ["+JSON.stringify(error)+"]");
        }
        }); //Fin de ajax
        console.log("comando largo:["+sRet+"]");
        document.getElementById("tablaDinamica").innerHTML=sRet;

}//Fin de fAdministraCatalogo()
$(document).ready(ready0);
</script>    
</html>
