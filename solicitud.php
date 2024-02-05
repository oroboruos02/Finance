
<?php

//error_reporting(0);

include_once "conexion/conexion.php";

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


include_once "conexion/conexion.php";
    $sent1 = $base_de_datos->prepare("SELECT * from cuentas Where propietario=?;");
    $sent1->execute([$producto]);
    $sentencia_1 = $sent1->fetchAll(PDO::FETCH_OBJ);?>

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
            <td colspan="4" class="titulo1"><b>Mis productos</b></td>
        </tr>
        <tr>
            <td class="titulo1"><b>Tipo</b></td>
            <td class="titulo1"><b>N° Cuenta</b></td>
            <td class="titulo1"><b>Fecha de creacion</b></td>
            <td class="titulo1"><b>Cupos</b></td>
        </tr>
        <?php foreach($sentencia_1 AS $s1){ ?>
        <tr>
                <td>Inversión</td>     
                <td>00-000<?php echo $s1->id?></td>  
                <td><?php echo $s1->fecha?></td>
                <td><?php echo $s1->cupos?></td>
        </tr>
            <?php


            }

            ?>

    </table>   
    <br>
    <br>
    <form class="formularios" style="" action="mods/actualizar_persona.php" method="POST">
        <span class="p1">Solicitante:</span>
        <input name="id"class="p2" value="<?php echo $producto?> - <?php echo $producto2?>" readonly></input>
        <br>
        <span class="p1">Monto Prestamo:</span>
        <input name="monto" class="p2" value="" type="number"></input>
        <br>
        <span class="p1">Fecha solicitud:</span>
        <input name="fecha" class="p2" value="<?php echo date("d/m/Y")?>" type="date"></input>
        <br>
        <br>        
        <input type="submit" class="enviar"></input>
        
    </form>   
    

</body>

</head>
</html>