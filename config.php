<?php
session_start ();
function fAlerta($message) {
    echo "<script>alert('$message');</script>";
}

global $conn;
$_SESSION['dirBase']="/POS01/";
$_SESSION['dBHost']="localhost";
$_SESSION['dBName']="u947744031_csaPOS01";
$_SESSION['dBUser']="u947744031_csaPOS01";
$_SESSION['sBPass']="csaPOS01(*";
$conn = mysqli_connect($_SESSION['dBHost'], $_SESSION['dBUser'], $_SESSION['sBPass'],$_SESSION['dBName']);
$conn->set_charset("utf8");
$_SESSION['conn']=$conn;

ini_set('date.timezone',"Etc/GMT+6");
date_default_timezone_set('Etc/GMT+6');
setlocale(LC_ALL, 'es_MX.UTF-8');

function encabezado(){
echo "<title>Productos CSA</title>";
echo "<p id='lineaSuperior' style='font-family:SF-Pro; text-align:left;'>";
echo " <a href='index.php'><b>Inicio </b></a>";
echo "<span style='float:right;'> Usuario: [".$_SESSION['user']."] <a href='logout.php'><b> &nbsp;Cerrar sesión [X]</b></a>";
echo "</span> <br></p> ";
echo "<div id='divMenu'> ";
   echo '<table id="idTablaMenu" >';
   echo '<tr>';
   echo '<th > <a id="encab1" class="textoMenu" href="pos.php"> POS</a> </th>';
   echo '<th > <a id="encab2" class="textoMenu" href="productos.php">Productos</a> </th>';
   echo '<th > <a id="encab3" class="textoMenu" href="precios.php">Precios</a>  </th>';
   echo '<th > <a id="encab4" class="textoMenu" href="cierredia.php">Corte de caja</a></th>';
   echo '<th > <a id="encab5" class="textoMenu" href="catalogos.php">Catalogos</a></th>';
   echo '</tr></table>';
echo "</div>";
echo"<p id='idLogo' style='text-align:center;margin-bottom: 0px;margin-top:0px '><img style='text-align:center;margin-top: 0px;margin-top:0px ' src='img/logoLimp.png' width='15%'></p>";

}


function tabla0($query, $arcPhp, $tbl, $orden, $flecha, $lstCampos, $lstEncabezados){
    //echo $query;

$conn = mysqli_connect($_SESSION['dBHost'], $_SESSION['dBUser'], $_SESSION['sBPass'],$_SESSION['dBName']);
$conn->set_charset("utf8");
echo "<input id='filtro' type='text' placeholder='Filtro'>";
echo "<div id='idEspacioTabla'>";
$head1='<th id="tEncabezado" style="text-align:left"><a href="'.$arcPhp.'?sort=';
$result =mysqli_query($conn, $query);
if(mysqli_num_rows($result) > 0){
    $i=0;
    echo '<table id="idTabla" class="tablaCatalogo table-striped" width="95%"">';
    //echo '<tr id="renglon" >';
    foreach ($lstCampos as $campo){
        $head2=$campo.'&order='.$orden.'">'.$lstEncabezados[$i];
        echo $head1.$head2;
        if($field == $campo) { echo $flecha; }
        echo '</a></th>';
        $i++;
    }
    //echo '</tr>';
      while($row = mysqli_fetch_assoc($result)){
          echo '<tr>';
          foreach($lstCampos as $campo){
          echo '<td style="text-align:left">'.str_replace("\n","\\n",$row[$campo]).'</td>';
          }
       echo '</tr>';
      }
    echo '</table>';
    echo '</div>';


}else {
    $a=1;
    //echo "NO hay registros: ".$sSelect. ", [".mysqli_num_rows($result)."]";
    echo "NO hay registros [".$query."]";
}

}


?>
