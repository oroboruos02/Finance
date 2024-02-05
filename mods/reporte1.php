
<?php

//error_reporting(0);

include_once "../conexion/conexion.php";

#Se comprueba si inicio sesion
session_start();
if(isset($_SESSION['sess_user_id']) ){
  
}else{ 
  echo '<script language="javascript">alert("Ingrese a su cuenta");</script>';
  echo '<script type="text/javascript">'
   , 'window.top.location.href = "entrar.html";'
   , '</script>'
;


}

$producto=$_SESSION['sess_user_id'];
$producto2=$_SESSION['sess_name'];


include_once "../conexion/conexion.php";
    $sent1 = $base_de_datos->prepare("SELECT * from cuentas, usuarios Where usuarios.cedula=cuentas.propietario;");
    $sent1->execute([]);
    $sentencia_1 = $sent1->fetchAll(PDO::FETCH_OBJ);
    
    $sent2 = $base_de_datos->prepare("SELECT (sum(valor1)+(valor_nom*cupos)) suma from aportes, cuentas WHERE aportes.cuenta_id=cuentas.id ;");    
    $sent2->execute([]);
    $sentencia_2 = $sent2->fetch(PDO::FETCH_OBJ);
    
    $sent21 = $base_de_datos->prepare("SELECT (sum(valor1)) suma from aportes, cuentas WHERE aportes.cuenta_id=cuentas.id ;");    
    $sent21->execute([]);
    $sentencia_21 = $sent21->fetch(PDO::FETCH_OBJ);

    $sent3 = $base_de_datos->prepare("SELECT (sum(capital)) suma from prestamos WHERE 1;");    
    $sent3->execute([]);
    $sentencia_3 = $sent3->fetch(PDO::FETCH_OBJ);
    
   
    $sent4 = $base_de_datos->prepare("SELECT MONTHNAME(vigente) fecham, YEAR(vigente) fechaa from empresa WHERE 1;");    
    $sent4->execute([]);
    $sentencia_4 = $sent4->fetch(PDO::FETCH_OBJ);
    ?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta name="description" content="Ejemplo de HTML5" /> 
<meta name="keywords" content="HTML5, CSS3, JavaScript" /> 
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" type="text/css" href="estilos.css">

<style>
    .titulo1{
        background-color:#3498DB ;
        text-align:center;
                
    }
    .p1{

        border-radius: 5px;
        float:left;
        width:200px;
    }
    .p2{
        border: 2px solid black;
        border-radius: 5px;
        background-color:gray;

        width:100%;
        max-width:280px;

    }
    .enviar{
        border: 2px solid black;
        border-radius: 5px;
        background-color:red;
        width:100%;
        max-width:480px;

    }
    .formularios{
        margin-left:38%
    }


    @media (max-width:745px){
        .formularios{
        margin-left:8%}
    }
</style>
</head>
<body>

<table style="width:100%">
        <tr>
            <td colspan="3" class="titulo1"><b><h1>REPORTES CAPITUM</h1></b></td>
        </tr>
        <tr>
            <td colspan="5" class="titulo1"><b>Resumen General</b></td>
        </tr>
        <tr>
            <td class="titulo1"><b>Aporte Total</b></td>
            <td class="titulo1"><b>Ganancia Total</b></td>
            <td class="titulo1"><b>% Ganancia Total</b></td>

            </tr>
        <?php foreach($sentencia_1 AS $s1){ ?>
        <tr>
            
                <td></td>  
                <td></td>  
                <td></td>
      
        </tr>
            <?php

            }

            ?>

    </table>  

    <table style="width:100%">
        <tr>
            <td colspan="5" class="titulo1"><b>Repórte Mensual</b></td>
        </tr>
        <tr>
            <td class="titulo1"><b>Mes</b></td>
            <td class="titulo1"><b>Aportes</b></td>
            <td class="titulo1"><b>Ganancia</b></td>
            <td class="titulo1"><b>% Ganancia</b></td>

            </tr>
        <?php foreach($sentencia_1 AS $s1){ ?>
        <tr>
            
                <td></td>  
                <td></td>  
                <td></td>
                <td></td>
      
        </tr>
            <?php

            }

            ?>

    </table>  
    
    <table style="width:100%">
        <tr>
            <td colspan="5" class="titulo1"><b>Detalles por Usuario</b></td>
        </tr>

        <tr>
            <td class="titulo1"><b>Usuario</b></td>
            <td class="titulo1"><b>Aportes</b></td>
            <td class="titulo1"><b>Ganancia</b></td>
            <td class="titulo1"><b>% Aportes</b></td>
            <td class="titulo1"><b>% Ganancia</b></td>

            </tr>
        <?php foreach($sentencia_1 AS $s1){ ?>
        <tr>
            
                <td></td>  
                <td></td>  
                <td></td>
                <td></td>
                <td></td>
      
        </tr>
            <?php


            }

            ?>

    </table>  

</body>

</head>
</html>