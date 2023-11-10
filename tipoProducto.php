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
<h2>Tipo productos</h2>

<?php
///Ejecuta accion de boton nuevo,editar,eliminar
$sTbl="catTipo";
if( isset($_POST['Nuevo']) and $_POST['nmCheckEjecuta']=="ejecutar"){
    $sVar=" (descripcion)";
    $sVal=" VALUES('".$_POST['nmDescripcion']."');";
    $sSql = " INSERT INTO ".$sTbl." ".$sVar. $sVal ;
    mysqli_query($conn, $sSql);    
    echo "<h3>Registro creado!</h3>".$sSql;
    //fAlerta($sSql);
}

if( isset($_POST['Editar']) and $_POST['nmCheckEjecuta']=="ejecutar"){
        $sSql="UPDATE ".$sTbl." SET descripcion='".$_POST['nmDescripcion']."' WHERE idCatTipo=".$_POST['nmID'].";";
    mysqli_query($conn, $sSql);    
    echo "<h3>Registro modificado! </h3> ".$sSql;
}
if( isset($_POST['Eliminar']) and $_POST['nmCheckEjecuta']=="ejecutar"){
        $sSql="DELETE FROM ".$sTbl." WHERE idCatTipo=".$_POST['nmID'].";";
        //echo $sSql;   
    mysqli_query($conn, $sSql);    
    echo "<h3>Registro eliminado!</h3>";

}

$field =$_GET['sort'];
if($field == ''){
   $field = 'descripcion'; 
} 
$ordertype = ($_GET['order'] == 'asc')? 'desc' : 'asc';
if($_GET['order'] == 'asc'){
    $sort_arrow =  '<img src="img/sort-des.png" />';
}
else if($_GET['order'] == 'desc'){
    $sort_arrow =  '<img src="img/sort-asc.png" />';
}
else{
    $sort_arrow =  '<img src="img/sort-des.png" />';
}

$sSelect = "SELECT catTipo.idCatTipo, catTipo.descripcion FROM catTipo  ORDER BY $field $ordertype ;";
$lstCampos=array("idCatTipo", "descripcion");
$lstEncabezados=arraY("ID","Descripción");
echo "<DIV id='divTabla'>";
tabla0($sSelect,"tipoProducto.php", "catTipo", $ordertype, $sort_arrow, $lstCampos, $lstEncabezados);
echo "</DIV>";


function llenaSelect($cat){
    //Obtiene los registros para selecionar
   global $aryTipo;
   switch ($cat){
      case "Tipo":
         mysqli_data_seek($aryTipo, 0);
         echo "<option value=''></option>";
         while ($row=$aryTipo->fetch_assoc()){
            echo "<option value='".$row["idCatTipo"]."'>".$row["descripcion"]. "</option>";
         }
         break;
   }
}

//Querys para obener los valores de los selectores
$sQry="SELECT *  FROM catTipo  ORDER BY descripcion  ASC";
$aryTipo=mysqli_query($conn, $sQry);


?>
<br>
<div id="idModifDatos">
    <form method="post">
    <label>ID: </label>
    <input type="text" id="idID" name="nmID" style="width:40%" value="" readonly /><br>
    <label>Descripción: </label>
    <input type="text" id="idDescripcion" name="nmDescripcion" style="width:40%" value=""required /><br>
    <BR>
    <br><br>
    <input type="checkbox" id="idCheckEjecuta" value="ejecutar" name="nmCheckEjecuta" onclick="enciendeBotones()"> Ejecutar la siguiente acción:<br>
    <input type="submit" name="Nuevo" id="idBtnNuevo" value="Guardar como nuevo" disabled />    
    <input type="submit" name="Editar" id="idBtnEditar" value="Actualizar" disabled/>    
    <input type="submit" name="Eliminar" id="idBtnEliminar"  value="Eliminar" disabled/>    

</form>
</div>
</body>
<script type="text/javascript" src="js/utils.js"></script>
<script type="text/javascript">
function ready0(){
propSelect2();

//Llena de valores inputs de acuerdo al renglon seleccionado
var tabla = document.getElementById("idTabla"),rIndex;
for(var i = 1; i < tabla.rows.length; i++)
{
    tabla.rows[i].onclick = function()
    {
        rIndex = this.rowIndex;
        console.log(rIndex);
        sID=this.cells[0].innerHTML;
        sDescr=this.cells[1].innerHTML;
        document.getElementById("idID").value = sID;
        document.getElementById("idDescripcion").value = sDescr;
    };
    }
}; //Fin de ready0

enciendeBotones();
filtraTabla();

$(document).ready(ready0);
</script>    
</html>
