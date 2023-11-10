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
   <link href="jquery/jquery-ui.css" rel="stylesheet">
   <link href="jquery/select2.min.css" rel="stylesheet">
   <script src="jquery/select2.min.js"></script>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
   <script src="js/utils.js"></script>
   <title>Óptica ECO -- Inicio</title>
</head>
<style>
   .select2-container .select2-choice {
    height: 200px!important;
    line-height: 200px!important;
    max-height: 200px;
    min-height: 200px !important;
}

.titulo{
   text-align: right;
   font-weight: bold;
   font-size: 1.3em;
   color: darkblue;
}

label {
   border: 1px  solid whitesmoke ; 
   margin: 1px;
   padding: 1px;
   cursor: pointer;
   width:45%;

}
</style>

<body>
<div class="divTotal" >
   <p id="idTotal" ></p> 
</div>

<div class="stripArm" id="idDivArm">
   <p class="titulo">Multilimpiador</p>
</div>

<div class="stripTra" id="idDivTra">
   <p class="titulo">Aromatizante</p>
</div>

<div class="stripMat" id="idDivMat">
   <p class="titulo">Detergente de ropa</p>
</div>


<div class="stripVis" id="idDivVis">
   <p class="titulo">Prelavadores</p>
</div>

<div class="stripSer" id="idDivSer">
   <p class="titulo">Suavizantes</p>
</div>

<div class="stripOtr" id="idDivOtr">
   <p class="titulo">Detergentes de ropa peroxidados</p>
</div>
<div class="stripOtr" id="idDivOtr">
   <p class="titulo">Detergentes de trastes</p>
</div>
<div class="stripOtr" id="idDivOtr">
   <p class="titulo">Industriales</p>
</div>
<div class="stripOtr" id="idDivOtr">
   <p class="titulo">Shampu mano y cuerpo</p>
</div>
<div class="stripOtr" id="idDivOtr">
   <p class="titulo">Shampoo capilar</p>
</div>
<div class="stripOtr" id="idDivOtr">
   <p class="titulo">Shampoo mascotas</p>
</div>
<div class="stripOtr" id="idDivOtr">
   <p class="titulo">Clorados</p>
</div>
<div class="stripOtr" id="idDivOtr">
   <p class="titulo">Desinfectantes</p>
</div>
<div class="stripOtr" id="idDivOtr">
   <p class="titulo">Automotriz</p>
</div>
<div class="stripOtr" id="idDivOtr">
   <p class="titulo">Jarceria</p>
</div>

<script type="text/javascript">
function creaRadios(divT,arry,nbeObj){
   i=0;
   arry.forEach(function(elem) {
      i++;
//      console.log("elemento[",i,"]: ",elem);
      var label = document.createElement("label");
      var input = document.createElement("input");
      label.innerHTML = elem.nbe+", "+elem.precio;
      input.type = "radio";
      input.name = nbeObj;
      input.value = elem.precio;
      input.classList.add('form-check-input');
      label.appendChild(input);
      obj=document.getElementById(divT);      
      obj.appendChild(label);
});

}
function calculaPrecio(){
   pesos = Intl.NumberFormat('es-MX')
   tmp=0;
   var elem=document.getElementsByTagName('input');
   for(i = 0; i < elem.length; i++) {
      if(elem[i].type="radio") {      
         if(elem[i].checked){
            tmp+=Number(elem[i].value.replace(/[^0-9\.]+/g,""));
            //console.log("radio:["+elem[i].name+"],["+elem[i].value+"]");
      }
      document.getElementById('idTotal').innerHTML="$ "+pesos.format(tmp);
   }
}
}
function ready0(){
    //Inicializacion de componentes convierte select a select2
/*
$.ajax({type: 'POST',url: 'fAjax.php', dataType: 'json', cache: false, async: false, data: {Key:"armTipo"},success: function(data) {
        aryTmp=data;
        }
    });
creaRadios("idDivArm",aryTmp,"tipoArm");
$.ajax({type: 'POST',url: 'fAjax.php', dataType: 'json', cache: false, async: false, data: {Key:"material"},success: function(data) {
        aryTmp=data;
        }
    });
creaRadios("idDivMat",aryTmp,"mat");
$.ajax({type: 'POST',url: 'fAjax.php', dataType: 'json', cache: false, async: false, data: {Key:"tratamiento"},success: function(data) {
        aryTmp=data;
        }
    });
creaRadios("idDivTra",aryTmp,"tra");
$.ajax({type: 'POST',url: 'fAjax.php', dataType: 'json', cache: false, async: false, data: {Key:"vision"},success: function(data) {
        aryTmp=data;
        }
    });
creaRadios("idDivVis",aryTmp,"vis");
$.ajax({type: 'POST',url: 'fAjax.php', dataType: 'json', cache: false, async: false, data: {Key:"serie"},success: function(data) {
        aryTmp=data;
        }
    });
creaRadios("idDivSer",aryTmp,"ser");
$.ajax({type: 'POST',url: 'fAjax.php', dataType: 'json', cache: false, async: false, data: {Key:"otro"},success: function(data) {
        aryTmp=data;
        }
    });
creaRadios("idDivOtr",aryTmp,"otr");
document.querySelectorAll("input[type='radio']").forEach((input) => {
        input.addEventListener('change', calculaPrecio);
    });
document.getElementById("idLogo").style.display = "none";
*/  
}; //Fin de ready0
$(document).ready(ready0);
</script>
</body>
</html>
