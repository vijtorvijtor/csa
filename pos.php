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
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<style>
tr.selected {
  background-color: yellow;
}
tr:hover {
          background-color: #ffff99;
        }
</style>
<body>
<script type="text/javascript">enciendeMenu("encab1");</script>
<h2>Punto de venta</h2>
<?php
$conn=$_SESSION["conn"];
$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
date_default_timezone_set('America/Mexico_City');
setlocale(LC_ALL, 'es_MX.UTF-8');
setlocale(LC_TIME, "es_MX.UTF-8","esp");
$date = new DateTime;
$sFecha=date_format($date, 'Y-m-d H:i');

$sQry="SELECT id FROM ticket ORDER BY id DESC LIMIT 1;";
$aryTmp=mysqli_query($conn, $sQry);
mysqli_data_seek($aryTmp, 0);
$row=$aryTmp->fetch_assoc();
$nTicket=$row["id"]+1;

function funcion_alert($message) {
    echo "<script>alert('$message');</script>";
}

function llenaSelect($cat){
$conn=$_SESSION["conn"];
switch ($cat){
	case "producto":
	$sQry="SELECT lpad(catProducto.idCatProducto,4,0) AS ID, catProducto.descripcion AS Producto, catTipo.descripcion AS Tipo FROM catProducto INNER JOIN catTipo ON catProducto.idCatTipo=catTipo.idCatTipo ORDER BY Tipo ASC, Producto ASC;";
	$aryProducto=mysqli_query($conn, $sQry);
	$sTmp="temino query con este error[".mysqli_error($conn)."]";
	printf("Errormessage: %s\n", mysqli_error($conn));
	mysqli_data_seek($aryProducto, 0);
	echo "<option value=''></option>";
	while ($row=$aryProducto->fetch_assoc()){
	echo "<option value='".$row["ID"]."'>".$row["ID"].", ".$row["Tipo"].", ".$row["Producto"]."</option>";

	}
	break;    
}
}
?>
<form id="idForma" method="post" onkeydown="return event.key != 'Enter';">
Ticket: 
<input type="text" class="ROnly" id="idTicket" name="nmTicket" style="width:12%" value="<?php echo $nTicket?>" onchange="fCambiaId(this)" readonly/>
Fecha: 
<input type="datetime-local" name="nmFecha"  id="idFecha" style="width:50%" value="<?php echo $sFecha ?>"  onchange="fCambiaFecha(this)" />
<BR>
<label class="labelNV">Producto: </label>
<select style="width:60%; height:500px  !important;" class="selectFiltro"  id="idProducto"  data-role="none" name="nmProducto" > <?php llenaSelect("producto")  ?></select><BR>
<label>Unidad: </label>
<input type="text" class="ROnly" id="idUnidad" name="nmUnidad" style="width:12%" value="<?php echo $sUnidad?>" onchange="fCambiaId(this)" readonly/><BR>
<label>Cantidad: </label>
<input type="number" id="idCantidad" name="nmCantidad" style="width:20%" step="any" onchange="fCambiaCantidad(this)" value="<?php echo '0'; ?>"/><br>
 <label>Precio unitario: </label>
 <input type="number" id="idUnitario" name="nmUnitario" style="width:20%" value="<?php echo $nUnitario; ?>"readonly/><BR>
 <label>Total: </label>
 <input type="number" id="idTotal" name="nmTotal" style="width:20%" value="<?php echo $nTotal; ?>"readonly/><BR>
<div style="display: inline;" align="center">
	<div style="float: left;">
	<input type="button" style="color: white; background-color: #4caf50; text-decoration: none; border-radius: 4px; display: inline-block; font-size: 100%;" id="idAgregar" value="Agregar" name="agregar" onclick="fBotonAgregar()">

	</div>
</div><br><br>
<div id="partidas" style="display: OK;">
<br>
	<table id="idTblPartidas" class="tbl-ticket">
		<col class="col1"/>
		<col class="col1"/>
		<col class="col1"/>
		<col class="col1"/>
		<col class="col1"/>
		<col class="col1"/>
      	<thead>
        <th> Cant. </th>
        <th> Unidad </th>         
        <th> Descripción </th>
        <th> $ Uni </th>
        <th> $ Subt </th>
 		<th> SKU </th>
       </thead>
      <tbody class="member">
      </tbody>
   </table>
	<input type="button" style="color: white; background-color: #4caf50; text-decoration: none; border-radius: 4px; margin-left:auto;margin-right:auto;display:block; font-size: 100%;" id="idQuitaPartida" value="Quitar el seleccionado" name="nmQuitaPartida" onclick="fQuitaPartida()"><br>
   <input type="text" id="idGranTotal" name="nmGranTotal" class="clGranTotal" readonly value="Total:"><br>

	<input type="button" style="color: white; background-color: #4caf50; text-decoration: none; border-radius: 4px; display: inline-block; font-size: 100%;" id="idGuardaTicket" value="Cobrar ticket" name="nmGuardaTicket" onclick="fGuardaTicket()">
</div>

</form>



<script type="text/javascript">
//alert("Inica script js");
const options = {
  style: 'decimal',  
  minimumFractionDigits: 2,
  maximumFractionDigits: 2,
};
var nSKU=0;
var nCantidad=0;
var nMenudeo=0;
var nMedio=0;
var nMayoreo=0;
var sUnidad="";
var sProducto="";
var nTotal=0;
var nGranTotal=0;
var nRSeleccionado=0;
var nUser = "<?php echo $_SESSION['idUser']?>";


//Verifica si el valor es un numero
function isNumber(val){
    return typeof val==='number';
}
//Funcion inicial, la ejecuta al tener todos los objetos desplegados en pantalla
function ready0(){
$('.selectFiltro').select2({placeholder: 'Seleciona', allowClear: true, width:"resolve", allowClear: true});

$('#idCantidad').keyup(function() {
	nCantidad=isNumber(document.getElementById("idCantidad"))?parseFloat(document.getElementById("idCantidad")):parseFloat(document.getElementById("idCantidad").value);
    //console.log("keyUp Cantidad:["+nCantidad+"]");
    fCambiaCantidad(nCantidad);
   });

//Resalta el renglon seleccionado con el mouse
$("tr").click(function() {
  	if ($(this).index>0){
  		$(this).parent().children().removeClass("selected");
    	$(this).addClass("selected");
	}

});

//Oculta la ultima columna 
const table  = document.getElementById( 'idTblPartidas' );
const column = table.getElementsByTagName( 'col' )[5];
//console.log("column:["+column+"]");
column.style.visibility = "collapse";
document.getElementById("idGuardaTicket").disabled = true;



} //Fin de ready0


//Cambio de producto
$('#idProducto').select2().on('change', function(){
    sIdProducto=$(this).val();
    nIdProducto=parseInt(sIdProducto);
    nSKU=nIdProducto;
    console.log("Cambio idProducto("+nIdProducto+")");
    $.ajax({type: 'POST',url: 'fAjax.php', dataType: 'json',cache: false, async: false, data: {Key:"precioProducto", producto:nIdProducto},success: function(data) {
        arrPrecio=data;
        }
    });
    //console.log(arrPrecio);
    sUnidad=arrPrecio[0].unidad;
    nMenudeo=parseFloat(arrPrecio[0].menudeo);
    nMedio=parseFloat(arrPrecio[0].medio);
    nMayoreo=parseFloat(arrPrecio[0].mayoreo);
    sProducto=arrPrecio[0].descripcion;
    document.getElementById("idUnidad").value=arrPrecio[0].unidad;
    document.getElementById("idCantidad").value=0;
    nCantidad=0;
    fCambiaCantidad(nCantidad);
    //fCambiaCantidad();
}); //Termina cambio de producto


function fCambiaCantidad(a){
	//Cambia cantidad
	nCantidad=isNumber(a)?parseFloat(a):parseFloat(a.value);
	//console.log("fCambiaCantidad("+nCantidad+"): Men["+nMenudeo+"], Med["+nMedio+"], May["+nMayoreo+"],nCantidad["+nCantidad+"]");
	if (nCantidad>=20){
		document.getElementById("idUnitario").value=nMayoreo;
	} else if(nCantidad>4){
		document.getElementById("idUnitario").value=nMedio;
	} else{
		document.getElementById("idUnitario").value=nMenudeo;
	}
	nPrecio=parseFloat(document.getElementById("idUnitario").value);
	nTotal=nPrecio*nCantidad;
	document.getElementById("idTotal").value=nTotal;

}
function fBotonAgregar(){
	if (nCantidad>0){
		let tabla = document.getElementById("idTblPartidas");
		let row = tabla.insertRow(-1); 
		let c1 = row.insertCell(0);
		let c2 = row.insertCell(1);
		let c3 = row.insertCell(2);
		let c4 = row.insertCell(3);
		let c5 = row.insertCell(4);
		let c6 = row.insertCell(5);
		c1.innerText = nCantidad;
		c2.innerText = sUnidad;
		c3.innerText = sProducto;
		c4.innerText = "$"+nPrecio.toLocaleString("es-MX",options);
		c5.innerText = "$"+nTotal.toLocaleString("es-MX",options);
		c6.innerText = nSKU;
		nGranTotal+=nTotal;
		fGranTotal();
		document.getElementById("idCantidad").value="0";
		nCantidad=0;
		document.getElementById("idGuardaTicket").disabled = false;
	}
highlight_row();	
}

function fCambiaFecha(a){
	//alert("cambio Fecha");
}

function highlight_row() {
    var table = document.getElementById('idTblPartidas');
    var cells = table.getElementsByTagName('td');
    for (var i = 0; i < cells.length; i++) {
        var cell = cells[i];
        cell.onclick = function () {
            var rowId = this.parentNode.rowIndex;
            nRSeleccionado=rowId;
            //console.log("Renglon seleccionado:["+nRSeleccionado+"]");
            var rowsNotSelected = table.getElementsByTagName('tr');
            for (var row = 0; row < rowsNotSelected.length; row++) {
                rowsNotSelected[row].style.backgroundColor = "";
                rowsNotSelected[row].classList.remove('selected');
            }
            var rowSelected = table.getElementsByTagName('tr')[rowId];
            rowSelected.style.backgroundColor = "yellow";
            rowSelected.className += " selected";
        }
    }

} //end of function
function fQuitaPartida(){
	if (nRSeleccionado>0){
		nTmp=document.getElementById("idTblPartidas").rows[nRSeleccionado].cells[4].innerHTML;
		var nTot=parseFloat(nTmp.substring(1));
		nGranTotal-=nTot;
		fGranTotal();
		//console.log("Elimina row:["+nRSeleccionado+"], valor:["+nTot+"]");
		document.getElementById("idTblPartidas").deleteRow(nRSeleccionado);
		nRSeleccionado=0;
	}
}

function fGranTotal(){
	document.getElementById("idGranTotal").value="Total:  $ "+ nGranTotal.toLocaleString("es-MX",options);
}

function fCreaTicket(nUser, nEdoTicket, sFecha, nGranTotal){
	console.log("Crea ticket");
	$.ajax({type: 'POST',url: 'fAjax.php', cache: false, async: false, data: {Key:"creaTicket", user:nUser, edoTicket:nEdoTicket, fecha:sFecha, granTotal:nGranTotal },success: function(data) {
        nRet=data;
        }
        });
	return nRet;
}

function fCreaPartida(nTicket, nProducto, nCantidad, nPrecio, nTotal){
	console.log("Crea Partida");
	$.ajax({type: 'POST',url: 'fAjax.php', cache: false, async: false, data: {Key:"creaPartida", ticket:nTicket, producto:nProducto, cantidad:nCantidad, precio:nPrecio, total:nTotal },success: function(data) {
        nRet=data;
        }
        });
	return nRet;
}

function fActualizaInventario(sFecha, nUsuario, nProducto, nCantidad, nMovimiento){
	console.log("Actualiza inventario");
	$.ajax({type: 'POST',url: 'fAjax.php', cache: false, async: false, data: {Key:"actualizaInv", fecha:sFecha, user:nUsuario, producto:nProducto, cantidad:nCantidad, movimiento:nMovimiento },success: function(data) {
        nRet=data;
        }
        });
	return nRet;
}

function fGuardaTicket(){
	if (nGranTotal<=0){
		alert("No hay productos para cobrar");
		return 0;
	}

	var oTbl=document.getElementById("idTblPartidas");
	var sFecha=document.getElementById("idFecha").value;
	//console.log("Fecha en guardarTicket:["+sFecha+"]");
	var nEdoTicket=1;
	nMovimiento=1;
	nTicket=fCreaTicket(nUser, nEdoTicket, sFecha, nGranTotal);
	var nPartidas = oTbl.rows.length -1;
	console.log("partidas: ["+nPartidas+"], Usuario:["+nUser+"], ticket:["+nTicket+"]");
	
	for (i=1;i<=nPartidas;i++) { 
		let Cell = document.getElementById("idTblPartidas").rows[i].cells;
   		nCantidad=Cell[0].innerHTML;
   		nPrecio=parseFloat(Cell[3].innerHTML.substring(1));
   		nTotal=parseFloat(Cell[4].innerHTML.substring(1));
   		nSKU=Cell[5].innerHTML;
   		console.log("Cantidad:["+nCantidad+"], Precio["+nPrecio+"], Total["+nTotal+"], SKU=["+nSKU+"]");
   		nPartida=fCreaPartida(nTicket,nSKU, nCantidad, nPrecio, nTotal);
   		console.log("Partida nueva:["+nPartida+"]");
   		nInv=fActualizaInventario(sFecha, nUser, nSKU, nCantidad, nMovimiento);
   		console.log("actualizo inv:["+nInv+"]");
	}
	document.getElementById("idGuardaTicket").disabled = true;
	document.getElementById("idAgregar").disabled = true;
	document.getElementById("idQuitaPartida").disabled = true;

	
}
$(document).ready(ready0);
</script>
</body>