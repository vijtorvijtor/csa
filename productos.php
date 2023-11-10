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
<script type="text/javascript">enciendeMenu("encab2");</script>
<h2>Productos</h2>

<?php
///Ejecuta accion de boton nuevo,editar,eliminar

if( isset($_POST['Nuevo']) and $_POST['nmCheckEjecuta']=="ejecutar"){
    $sVar=" (idCatTipo, marca, descripcion, unidad)";
    $sVal=" VALUES(".$_POST['nmIdCatTipo'].",".$_POST['nmMarca'].", '".$_POST['nmDescripcion']."',".$_POST['nmUnidad'].");";
    $sSql = " INSERT INTO catProducto " .$sVar. $sVal ;
    mysqli_query($conn, $sSql);
    $nTmp=mysqli_insert_id($conn);
    $sVar=" (idCatProducto) ";
    $sVal=" VALUES(".$nTmp.")";
    $sSql = " INSERT INTO precio  " .$sVar. $sVal ;
    mysqli_query($conn, $sSql);
        
    echo "<h3>Registro creado!</h3>".$sSql;
    //fAlerta($sSql);
}

if( isset($_POST['Editar']) and $_POST['nmCheckEjecuta']=="ejecutar"){
        $sSql="UPDATE catProducto SET idCatTipo=".$_POST['nmIdCatTipo'].", descripcion='".$_POST['nmDescripcion']."', unidad=".$_POST['nmUnidad'].",marca=".$_POST['nmMarca']." WHERE idCatProducto=".$_POST['nmID'].";";
    mysqli_query($conn, $sSql);    
    echo "<h3>Registro modificado! </h3> ".$sSql;
}
if( isset($_POST['Eliminar']) and $_POST['nmCheckEjecuta']=="ejecutar"){
        $sSql="DELETE FROM catProducto WHERE idCatProducto=".$_POST['nmID'].";";
        //echo $sSql;   
    mysqli_query($conn, $sSql);    
    echo "<h3>Registro eliminado!</h3>";

}

$field =$_GET['sort'];
if($field == ''){
   $field = 'idCatProducto'; 
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

$sSelect = "SELECT catProducto.idCatProducto, catTipo.descripcion AS descTipo, catMarca.marca AS marca, catUnidad.descripcion AS descUnidad, catProducto.descripcion AS descProducto FROM catProducto INNER JOIN catTipo ON catProducto.idCatTipo = catTipo.idCatTipo INNER JOIN catUnidad ON catProducto.unidad=catUnidad.idUnidad INNER JOIN catMarca ON catProducto.marca=catMarca.id ORDER BY $field $ordertype ;";
$lstCampos=array("idCatProducto", "descTipo", "marca", "descUnidad","descProducto");
$lstEncabezados=arraY("ID","Tipo", "Marca", "Unidad", "Descripción");
echo "<DIV id='divTabla'>";
tabla0($sSelect,"productos.php", "catProducto", $ordertype, $sort_arrow, $lstCampos, $lstEncabezados);
echo "</DIV>";


function llenaSelect($cat){
    //Obtiene los registros para selecionar
   global $aryTipo;
   global $aryUnidad;
   global $aryMarca;
   switch ($cat){
    case "Tipo":
        mysqli_data_seek($aryTipo, 0);
        echo "<option value=''></option>";
        while ($row=$aryTipo->fetch_assoc()){
            echo "<option value='".$row["idCatTipo"]."'>".$row["descripcion"]. "</option>";
        }   
        break;
    case "Marca":
        mysqli_data_seek($aryMarca, 0);
        echo "<option value=''></option>";
        while ($row=$aryMarca->fetch_assoc()){
            echo "<option value='".$row["id"]."'>".$row["marca"]. "</option>";
        }   
        break;
    case "Unidad":
         mysqli_data_seek($aryUnidad, 0);
         echo "<option value=''></option>";
         while ($row=$aryUnidad->fetch_assoc()){
            echo "<option value='".$row["idUnidad"]."'>".$row["descripcion"]. "</option>";
         }
         break;
   }
}

//Querys para obener los valores de los selectores
$sQry="SELECT *  FROM catTipo  ORDER BY descripcion  ASC";
$aryTipo=mysqli_query($conn, $sQry);
$sQry="SELECT *  FROM catUnidad  ORDER BY descripcion  ASC";
$aryUnidad=mysqli_query($conn, $sQry);
$sQry="SELECT *  FROM catMarca  ORDER BY marca  ASC";
$aryMarca=mysqli_query($conn, $sQry);


?>
<br>
<div id="idModifDatos">
    <form method="post">
    <label>ID: </label>
    <input type="text" id="idID" name="nmID" style="width:40%" value="" readonly /><br>
    <label>Tipo: </label>
    <select style="width:50%; height:500px  !important;" class="selectFiltro"  id="idIdCatTipo"  data-role="none" name="nmIdCatTipo" > <?php llenaSelect("Tipo")  ?></select><br>
    <label>Marca: </label>
    <select style="width:50%; height:500px  !important;" class="selectFiltro"  id="idCatMarca"  data-role="none" name="nmMarca" > <?php llenaSelect("Marca")  ?></select><br>
    <label>Unidad: </label>
    <select style="width:50%; height:500px  !important;" class="selectFiltro"  id="idUnidad"  data-role="none" name="nmUnidad" > <?php llenaSelect("Unidad")  ?></select><br>
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
        sTipo=this.cells[1].innerHTML;
        sMarca=this.cells[2].innerHTML;
        sUnidad=this.cells[3].innerHTML;
        sDescr=this.cells[4].innerHTML;
        document.getElementById("idID").value = sID;
        document.getElementById("idIdCatTipo").value = sTipo;
        document.getElementById("idCatMarca").value = sMarca;
        document.getElementById("idUnidad").value = sUnidad;        
        document.getElementById("idDescripcion").value = sDescr;
        oInp=$('#idIdCatTipo');sTexto=sTipo;
        pos=oInp.find("option:contains('"+sTexto+"')").val()
        oInp.val(pos).trigger('change.select2');
        oInp=$('#idCatMarca');sTexto=sMarca;
        pos=oInp.find("option:contains('"+sTexto+"')").val()
        oInp.val(pos).trigger('change.select2');
        oInp=$('#idUnidad');sTexto=sUnidad;
        pos=oInp.find("option:contains('"+sTexto+"')").val()
        oInp.val(pos).trigger('change.select2');

    };
    }
}; //Fin de ready0

enciendeBotones();
filtraTabla();

$(document).ready(ready0);
</script>    
</html>
