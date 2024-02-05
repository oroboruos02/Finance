<?php
error_reporting(0);
include_once "conexion.php";

#Se comprueba si inicio sesion
session_start();
if(isset($_SESSION['sess_user_id']) ){
  echo ($_SESSION['sess_user_id']);
}else{ 
  echo '<script language="javascript">alert("Ingrese a su cuenta");</script>';
  echo '<script type="text/javascript">'
   , 'window.top.location.href = "entrar.html";'
   , '</script>';
}

$producto=$_SESSION['sess_user_id'];
include_once "conexion/conexion.php";
    $sent1 = $base_de_datos->prepare("SELECT * from aportes;");
    $sent1->execute([]);
    $sentencia_1 = $sent1->fetchAll(PDO::FETCH_OBJ);

    $sent2 = $base_de_datos->prepare("SELECT sum(valor) as suma from aportes;");
    $sent2->execute([]);
    $sentencia_2 = $sent2->fetch(PDO::FETCH_OBJ);
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
</style>
</head>
<body style="height: 27px; width: 30px;">

<div class="item"></div>


    <table style="width: 100%;" >
        <tr>
            <td class="titulo1">Recibo</td>
            <td class="titulo1">N° Cuenta</td>
            <td class="titulo1">Fecha de pago</td>
            <td class="titulo1">Valor</td>
            <td class="titulo1">Pagado</td>

            </tr>
        <?php foreach($sentencia_1 AS $s1){ ?>
        <tr>
            
                <td>000<?php echo $s1->id?></td>  
                <td>00-000<?php echo $s1->cuenta_id?></td>  
                <td><?php echo $s1->corte?></td>
                <td>$ <?php echo $s1->valor?></td>
                <td><?php echo $s1->pagado?></td>
        </tr>
            <?php


            }

            ?>

    </table>   
    

</body>

</head>
</html>