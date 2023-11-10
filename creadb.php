<?php
	$dbuser = 'abejashc_optica';
	$dbpass = '1Abejash(*@';
	$dbname = 'abejashc_optica';
	$dbhost = 'localhost';
   
   function creaTabla($conexion, $sTabla,$listaCampos){
   $sCmd="CREATE TABLE ".$sTabla." ".$listaCampos;  
   if ($conexion->query($sCmd)==TRUE){
      echo "Tabla [".$sTabla."] creada\n";
   }else {
      echo "Fallo en la creacion de la tabla [".$sTabla."],".$conexion->error."\n"; 
   }
   }

   function cargaTabla($conexion,$sCSV, $sTabla){
      $cmd = "LOAD DATA LOCAL INFILE '".$sCSV."' INTO TABLE ".$sTabla." FIELDS TERMINATED BY ',' LINES TERMINATED BY '\n'";
      $nRet = $conexion->query($cmd);
      if ($nRet != TRUE){
         echo "********* Error al importar el archivo  ".$sCSV." en la tabla ".$sTabla." [" . $conexion->error ."] ***********\n";
      }else{
         echo"Carga de datos ok ".$sCSV."' en tabla ".$sTabla."\n";
      }

   }

// $conn = mysql_connect($dbhost, $dbuser, $dbpass);
   $conn= new mysqli($dbhost, $dbuser, $dbpass, );
   if ($conn->connect_error) {
    die("ERROR: No se puede conectar al servidor: " . $conn->connect_error);
   } 

   echo "Servidor conectado.\n";
   $sQry="DROP DATABASE IF EXISTS ".$dbname;
   if (mysqli_query($conn, $sQry)){
       echo "Base de datos eliminada\n";
   }
   else{
       echo "No se elimino la base de datos\n";
   }
   echo "Crea base de datos [".$dbname."]\n";
   $sQry="CREATE DATABASE IF NOT EXISTS $dbname;";
   $result = mysqli_query($conn, $sQry);
   
   //Crea tablas
   echo "Creacion y llenado de tablas...\n";
   $sQry="USE ".$dbname;
   $conn->query($sQry);
   
   $sTabla="usuario";
   $sCampos=" (idUser INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
      nombreU VARCHAR(20),
      user VARCHAR(15) NOT NULL,
      pass VARCHAR(15) NOT NULL,
      idUN INT,
      idNivel INT);";
   creaTabla($conn,$sTabla,$sCampos);
   cargaTabla($conn,"usuario.csv",$sTabla);

   $sTabla="uNegocio";
   $sCampos=" (idUN INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
      nombreUN VARCHAR(30),
      direccionUN VARCHAR(50));";
   creaTabla($conn,$sTabla,$sCampos);
   cargaTabla($conn,"uNegocio.csv",$sTabla);

   $sTabla="paciente";
   $sCampos=" (idPaciente INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
      nombre VARCHAR(40) NOT NULL,
      apellido VARCHAR(40) NOT NULL,
      edad INT,
      ocupacion VARCHAR(30),
      domicilio VARCHAR(40),
      telefono VARCHAR(14),
      fechaAlta DATETIME,
	   idUser INT,
      idUN INT
   );";
   creaTabla($conn,$sTabla,$sCampos);
   cargaTabla($conn,"paciente.csv",$sTabla);

   $sTabla="notav";
   $sCampos=" (idNV INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
	  idPaciente INT,
	  idEdoNota INT,
      nvObs VARCHAR(70),
      fechaAlta DATETIME,
      fechaPromesa DATE,
	  total FLOAT,
	  idUser INT,
      idUN INT)";
   creaTabla($conn,$sTabla,$sCampos);
   cargaTabla($conn,"notav.csv",$sTabla);

   $sTabla="partida";
   $sCampos=" (idPartida INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
	  idNV INT,
	  idRX INT,
      idArmazon INT,
      idPrecioLen INT,
      precio FLOAT);";
   creaTabla($conn,$sTabla,$sCampos);
   cargaTabla($conn,"partida.csv",$sTabla);


   $sTabla="abono";
   $sCampos=" (idAbono INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
	  idNV INT,
	  abono FLOAT,
	  fechaAbono DATETIME,
	  idFormaPago INT,
	  idUser INT,
	  idUN INT)";
   creaTabla($conn,$sTabla,$sCampos);
   cargaTabla($conn,"abono.csv",$sTabla);

   $sTabla="OT";
   $sCampos=" (idROT INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
      idPaciente INT,
      idOC INT,
      fechaOT DATETIME,
      idUser INT );";
   creaTabla($conn,$sTabla,$sCampos);
   cargaTabla($conn,"OT.csv",$sTabla);

   $sTabla="invArmazon";
   $sCampos=" (idArmazon INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
	  idArmMarca INT,
	  idArmTipo INT,
      descripcion VARCHAR(50),
      cantidad INT,
      idGenero INT,
      idLinea INT,
      precioV FLOAT,
	  costo FLOAT,
      fechaEntrada DATETIME,
	  idUser INT,
	  idUN INT );";
   creaTabla($conn,$sTabla,$sCampos);
   cargaTabla($conn,"invArmazones.csv",$sTabla);

   $sTabla="invProductos";
   $sCampos=" (idInvProductos INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
      idProducto INT,
      cantidad INT,
      precioV FLOAT,
      costo FLOAT,
      fechaAltaPro DATETIME,
	  idUser INT, 
	  idUN INT);";
   creaTabla($conn,$sTabla,$sCampos);
   cargaTabla($conn,"invArmazon.csv",$sTabla);

   $sTabla="catEdoNota";
   $sCampos=" (idEdoNota INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
      edoNota VARCHAR(30));";
   creaTabla($conn,$sTabla,$sCampos);
   cargaTabla($conn,"catEdoNota.csv",$sTabla);

   $sTabla="catArmMarca";
   $sCampos=" (idArmMarca INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
      nombreArmMarca VARCHAR(30));";
   creaTabla($conn,$sTabla,$sCampos);
   cargaTabla($conn,"catArmMarca.csv",$sTabla);

   $sTabla="catArmTipo";
   $sCampos=" (idArmTipo INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
      nombreArmTipo VARCHAR(30));";
   creaTabla($conn,$sTabla,$sCampos);
   cargaTabla($conn,"catArmTipo.csv",$sTabla);

   $sTabla="catLMaterial";
   $sCampos=" (idLMaterial INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
      nombreMat VARCHAR(30) );";
   creaTabla($conn,$sTabla,$sCampos);
   cargaTabla($conn,"catLMaterial.csv",$sTabla);

   $sTabla="catLTratamiento";
   $sCampos=" (idLTratamiento INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
      nombreTra VARCHAR(30) );";
   creaTabla($conn,$sTabla,$sCampos);
   cargaTabla($conn,"catLTratamiento.csv",$sTabla);

   $sTabla="catGenero";
   $sCampos=" (idGenero INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
      nombreGenero VARCHAR(20) );";
   creaTabla($conn,$sTabla,$sCampos);
   cargaTabla($conn,"catGenero.csv",$sTabla);

   $sTabla="catColor";
   $sCampos=" (idColor INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
      nombreGenero VARCHAR(25) );";
   creaTabla($conn,$sTabla,$sCampos);
   cargaTabla($conn,"catColor.csv",$sTabla);


   $sTabla="catFormaPago";
   $sCampos=" (idFPago INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
      nombreFPago VARCHAR(25) );";
   creaTabla($conn,$sTabla,$sCampos);
   cargaTabla($conn,"catFormaPago.csv",$sTabla);


   $sTabla="catProductos";
   $sCampos=" (idProducto INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
      nombreProducto VARCHAR(50) );";
   creaTabla($conn,$sTabla,$sCampos);
   cargaTabla($conn,"catProductos.csv",$sTabla);


   $sTabla="catLinea";
   $sCampos=" (idLinea INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
      nombreLinea VARCHAR(50) );";
   creaTabla($conn,$sTabla,$sCampos);
   cargaTabla($conn,"catLinea.csv",$sTabla);

   $sTabla="catPrecioLen";
   $sCampos=" (idPrecioLen INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
	  nombreLen VARCHAR(100),
	  minEsf DECIMAL(4,2),
      maxEsf DECIMAL(4,2),
	  minCil DECIMAL(4,2),
	  pTerminado FLOAT,
      pTallado FLOAT,
	  idUN INT);";
   creaTabla($conn,$sTabla,$sCampos);
   cargaTabla($conn,"catPrecioLen.csv",$sTabla);

   $sTabla="catDescuento";
   $sCampos=" (idDescuento INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
      nombreDescuento VARCHAR(50) );";
   creaTabla($conn,$sTabla,$sCampos);
   cargaTabla($conn,"catDescuento.csv",$sTabla);

   $sTabla="hclinica";
   $sCampos=" (idHClinica INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
      idPaciente INT, usadolentes BOOLEAN DEFAULT 0,
      tomamedicamentos BOOLEAN DEFAULT 0, diabetes BOOLEAN DEFAULT 0, hipertension BOOLEAN DEFAULT 0,
      otras VARCHAR(50) DEFAULT '', observaciones VARCHAR(80) DEFAULT '', idUser INT  DEFAULT 1, fecha DATETIME DEFAULT CURRENT_TIMESTAMP);";
   creaTabla($conn,$sTabla,$sCampos);
   cargaTabla($conn,"hclinica.csv",$sTabla);

   $sTabla="examenrx";
   $sCampos=" (idRX INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
      idPaciente INT, 
      ar_ODEsf DECIMAL(4,2), ar_ODCil DECIMAL(4,2), ar_ODEje INT, ar_ODAdd DECIMAL(4,2),
      ar_OIEsf DECIMAL(4,2), ar_OICil DECIMAL(4,2), ar_OIEje INT, ar_OIAdd DECIMAL(4,2),
      ls_ODEsf DECIMAL(4,2), ls_ODCil DECIMAL(4,2), ls_ODEje INT, ls_ODAdd DECIMAL(4,2), 
      ls_OIEsf DECIMAL(4,2), ls_OICil DECIMAL(4,2), ls_OIEje INT, ls_OIAdd DECIMAL(4,2),
      av_LOD INT, av_LOI INT, av_LAO INT, av_CAO INT,
      avest_OD VARCHAR(50), avest_OI VARCHAR(50),
      ctest_OD VARCHAR(50), ctest_OI VARCHAR(50),
      rej_OD  VARCHAR(50), rej_OI  VARCHAR(50),
      OD_Esf DECIMAL(4,2), OD_Cil DECIMAL(4,2), OD_Eje DECIMAL(4,2), OD_Add DECIMAL(4,2),
      OI_Esf DECIMAL(4,2), OI_Cil DECIMAL(4,2), OI_Eje DECIMAL(4,2), OI_Add DECIMAL(4,2),
      DIP INT, observaciones VARCHAR(80), idUser INT, fecha DATETIME);";
   creaTabla($conn,$sTabla,$sCampos);
   cargaTabla($conn,"examenrx.csv",$sTabla);

   //Carga de catalogos
  $conn->close();
?>
