<?php
session_start ();
$Key=$_POST['Key'];
$conn = mysqli_connect($_SESSION['dBHost'], $_SESSION['dBUser'], $_SESSION['sBPass'],$_SESSION['dBName']);
$conn->set_charset("utf8");

switch ($Key) {
case 'precioProducto'://Devuelve el nombre de un arcivo dado el idMedio
    $productoTmp=$_POST['producto'];
    $aTmp=array();
    $query="SELECT catProducto.descripcion AS sProducto, catProducto.idCatProducto, precio.menudeo, precio.medio, precio.mayoreo, catUnidad.descripcion AS Unidad FROM catProducto INNER JOIN precio ON catProducto.idCatProducto=precio.idCatProducto INNER JOIN catUnidad ON catProducto.unidad=catUnidad.idUnidad WHERE catProducto.idCatProducto=".$productoTmp.';';  
    //Para depurar la funcion
    //$aTmp[]=array("unidad"=>"Inicio del Ajax","Param_producto"=>$productoTmp, "qry"=>$query);         
    
    $result = mysqli_query($conn, $query);
    if (!$result){
        $aTmp[]=array("unidad"=>"Fallo mysqli");
    }
    else{
        while ($row2 = mysqli_fetch_array($result)){
            $aTmp[] = array("unidad"=>$row2['Unidad'], "menudeo"=>$row2['menudeo'], "medio"=>$row2['medio'], "mayoreo"=>$row2['mayoreo'],"descripcion"=>$row2['sProducto']);
        }
    }    
    
    echo json_encode($aTmp);    
break;  

case 'creaTicket'://Devuelve el nombre de un arcivo dado el idMedio
    $v1=$_POST['user'];
    $v2=$_POST['edoTicket'];
    $v3=$_POST['fecha'];
    $v4=$_POST['granTotal'];
    $aTmp=array();
    $query="INSERT INTO ticket (user, estado, fecha, total) VALUES(".$v1.",".$v2.",\"".$v3."\",".$v4.");";  
    //Para depurar la funcion
    //$aTmp[]=array("unidad"=>"Inicio del Ajax","Param_producto"=>$productoTmp, "qry"=>$query);         
    $result = mysqli_query($conn, $query);
    if (!$result){
        $nRet="Fallo mysqli[".$query."]";
    }
    else{
        $nRet=mysqli_insert_id($conn);
    }
    echo $nRet;
break;

case 'creaPartida'://Devuelve el nombre de un arcivo dado el idMedio
    $v1=$_POST['ticket'];
    $v2=$_POST['producto'];
    $v3=$_POST['cantidad'];
    $v4=$_POST['precio'];
    $v5=$_POST['total'];
    $aTmp=array();
    $query="INSERT INTO partida (ticket, producto, cantidad, precio, total) VALUES (".$v1.",".$v2.",".$v3.",". $v4.",". $v5.");";  
    //Para depurar la funcion
    //$aTmp[]=array("unidad"=>"Inicio del Ajax","Param_producto"=>$productoTmp, "qry"=>$query);         
    $result = mysqli_query($conn, $query);
    if (!$result){
        $aTmp[]=array("resultado"=>"Fallo mysqli [".$query."]");
    }
    else{
        $aTmp[] = array("resultado"=>mysqli_insert_id($conn));
        }   
    echo json_encode($aTmp);
break;

    case 'actualizaInv'://Devuelve el nombre de un arcivo dado el idMedio
    $v1=$_POST['fecha'];
    $v2=$_POST['user'];
    $v3=$_POST['producto'];
    $v4=$_POST['cantidad'];
    $v5=$_POST['movimiento'];
    $aTmp=array();
    $query="INSERT INTO inventario (fecha, user, idProducto, cantidad, movimiento) VALUES(\"".$v1."\", ".$v2.",".$v3.",".$v4.",". $v5.")";  
    //Para depurar la funcion
    //$aTmp[]=array("unidad"=>"Inicio del Ajax","Param_producto"=>$productoTmp, "qry"=>$query);         
    $result = mysqli_query($conn, $query);
        if (!$result){
        $nRet="Fallo mysqli [".$query."], error:[".mysqli_error($conn)."]";
    }
    else{
        $nRet= mysqli_insert_id($conn);
        }
    
    echo $nRet;    
break;
    case 'qryArray':
    $query=$_POST['Query'];
    $arrCampos = $_POST['arrCampos'];
    $arrNombres = $_POST['arrNombres'];
    $nTamLista=count($arrCampos);
    //$nNombres+=1;
    $aTmp=array();
    //$query="SELECT * FROM tablas WHERE nbeTabla='catMarca'";
    //for ($i=0;$i<$nTamLista;$i++){
    //$aTmp[$i] = array("campo0"=>$arrCampos[1],"nombre0"=>$arrNombres[1]);
    //}
    
    $result = mysqli_query($conn, $query);
    if (!$result){
        $aTmp[]=array("Error∫"=>$query);
    }
    else{
        $i=0;
        while ($row2 = mysqli_fetch_array($result)){
            for ($j=0;$j<$nTamLista;$j++){
                $aTmp[$i]=array($arrNombres[$j]=>$row2[$arrCampos[$j]]);
                //$aTmp[$i]=array("$arrNombres[$j]"=>$j);
            }
            $i++;
            //$aTmp[] = array("unidad"=>$row2['Unidad'], "menudeo"=>$row2['menudeo'], "medio"=>$row2['medio'], "mayoreo"=>$row2['mayoreo'],"descripcion"=>$row2['sProducto']);
        }
    }    
    
    echo json_encode($aTmp);
break;
    case 'tabla00':
    $query=$_POST['Query'];
    $arrCampos = $_POST['arrCampos'];
    $arrNombres = $_POST['arrNombres'];
    $orden =$_POST['orden'];
    $arcPhp=$_POST['arcPHP'];
    $nTamLista=count($arrCampos);
    $head1='<th id="tEncabezado" style="text-align:left"><a href="catalogos.php"?sort=';
    $cmdTbl="<input id='filtro' type='text' placeholder='Filtro'>";
    $cmdTbl.="<div id='idEspacioTabla'>";
    $cmdTbl.='<th id="tEncabezado" style="text-align:left"><a href="'.$arcPhp.'?sort=';
    $result =mysqli_query($conn, $query);
    if(mysqli_num_rows($result) > 0){
        $i=99;
        $cmdTbl.='<table id="idTabla" class="tablaCatalogo table-striped" width="95%"">';
        $i=0;
        foreach ($arrCampos as $campo){
            $head2=$campo.'&order='.$orden.'">'.$arrNombres[$i];
            $cmdTbl.= $head1.$head2;
            
            $cmdTbl.= '</a></th>';
            $i++;
        }
        while($row = mysqli_fetch_assoc($result)){
            $cmdTbl.= '<tr>';
            foreach($arrCampos as $campo){
                //$cmdTbl.="CCCAAAAMMMPPPOO[".$campo."]";
                $cmdTbl.= '<td style="text-align:left">'.$row["$campo"].'</td>';
            }
        $cmdTbl.= '</tr>';
      }
    $cmdTbl.= '</table>';
    $cmdTbl.= '</div>';
    }
    echo $cmdTbl;
break;

 } //Fin del switch

?>
