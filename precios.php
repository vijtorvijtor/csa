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
<h2>Precios</h2>
<script type="text/javascript">enciendeMenu("encab3");</script>
<?php
///Ejecuta accion de boton nuevo,editar,eliminar
$sTbl=" precio ";
if( isset($_POST['Nuevo']) and $_POST['nmCheckEjecuta']=="ejecutar"){
    $sVar=" (idCatTipo, descripcion)";
    $sVal=" VALUES(".$_POST['nmIdCatTipo'].", '".$_POST['nmDescripcion']."');";
    $sSql = "INSERT INTO ".$sTbl .$sVar. $sVal ;
    mysqli_query($conn, $sSql);    
    echo "<h3>Registro creado!</h3>".$sSql;
    //fAlerta($sSql);
}

if( isset($_POST['Editar']) and $_POST['nmCheckEjecuta']=="ejecutar"){
        $sSql="UPDATE".$sTbl." SET  costo=".$_POST['nmCosto'].", menudeo=".$_POST['nmMenudeo'].", medio=".$_POST['nmMedio']." ,mayoreo=".$_POST['nmMayoreo']." WHERE idCatProducto=".$_POST['nmID'].";";
    mysqli_query($conn, $sSql);    
    echo "<h3>Registro modificado! </h3> ";
}
if( isset($_POST['Eliminar']) and $_POST['nmCheckEjecuta']=="ejecutar"){
        $sSql="DELETE FROM ".$sTbl." WHERE idCatProducto=".$_POST['nmID'].";";
        //echo $sSql;   
    mysqli_query($conn, $sSql);    
    echo "<h3>Registro eliminado!</h3>";

}

$field =$_GET['sort'];
if($field == ''){
   $field = 'ID'; 
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

$sSelect = "SELECT catProducto.idCatProducto AS ID, catProducto.descripcion, catUnidad.descripcion AS Unidad, precio.costo,  precio.menudeo, precio.medio, precio.mayoreo FROM catProducto  LEFT JOIN precio ON catProducto.idCatProducto=precio.idCatProducto LEFT JOIN catUnidad ON catProducto.unidad=catUnidad.idUnidad ORDER BY $field $ordertype ;";
$lstCampos=array("ID", "descripcion", "Unidad","costo","menudeo","medio","mayoreo");
$lstEncabezados=arraY("ID","Producto","Unidad","Costo","Menudeo","Medio", "Mayoreo");
echo "<DIV id='divTabla'>";
tabla0($sSelect,"precios.php", "precio", $ordertype, $sort_arrow, $lstCampos, $lstEncabezados);
echo "</DIV>";


function llenaSelect($cat){
    //Obtiene los registros para selecionar
   global $aryUnidad;
   switch ($cat){
      case "Unidad_":
         mysqli_data_seek($aryUnidad, 0);
         echo "<option value=''></option>";
         while ($row=$aryUnidad->fetch_assoc()){
            echo "<option value='".$row["idUnidad"]."'>".$row["descripcion"]. "</option>";
         }
         break;
   }
}

//Querys para obener los valores de los selectores
$sQry="SELECT *  FROM catUnidad  ORDER BY descripcion  ASC";
$aryUnidad=mysqli_query($conn, $sQry);


?>
<br>
<div id="idModifDatos">
    <form method="post">
    <label>ID: </label>
    <input type="text" id="idID" name="nmID" style="width:40%" value="" readonly /><br>
    <label>Descripción: </label>
    <input type="text" id="idDescripcion" name="nmDescripcion" style="width:40%" value=""required readonly/><br>
    <label>Costo: </label>
    <input type="text" id="idCosto" name="nmCosto" style="width:40%" value=""required /><br>
    <label>Menudeo: </label>
    <input type="text" id="idMenudeo" name="nmMenudeo" style="width:40%" value=""required /><br>
    <label>Medio: </label>
    <input type="text" id="idMedio" name="nmMedio" style="width:40%" value=""required /><br>
    <label>Mayoreo: </label>
    <input type="text" id="idMayoreo" name="nmMayoreo" style="width:40%" value=""required /><br>
    <BR>
    <br><br>
    <input type="checkbox" id="idCheckEjecuta" value="ejecutar" name="nmCheckEjecuta" onclick="enciendeBotones()"> Ejecutar la siguiente acción:<br>
    <input type="submit" name="Nuevo" id="idBtnNuevo" value="Guardar como nuevo" disabled style="display: none;"/>    
    <input type="submit" name="Editar" id="idBtnEditar" value="Actualizar" disabled/>    
    <input type="submit" name="Eliminar" id="idBtnEliminar"  value="Eliminar" disabled style="display: none;" />    

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
        sCosto=this.cells[3].innerHTML;
        sMenudeo=this.cells[4].innerHTML;
        sMedio=this.cells[5].innerHTML;
        sMayoreo=this.cells[6].innerHTML;
        document.getElementById("idID").value = sID;
        document.getElementById("idDescripcion").value = sDescr;
        document.getElementById("idCosto").value = sCosto;
        document.getElementById("idMenudeo").value = sMenudeo;
        document.getElementById("idMedio").value = sMedio;
        document.getElementById("idMayoreo").value = sMayoreo;
//        oInp=$('#idUnidad');sTexto=sUnidad;
//        pos=oInp.find("option:contains('"+sTexto+"')").val()
//        oInp.val(pos).trigger('change.select2');
    };
    }
}; //Fin de ready0

enciendeBotones();
filtraTabla();

$(document).ready(ready0);
</script>    
</html>
