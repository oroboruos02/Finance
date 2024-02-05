
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

    $sent3 = $base_de_datos->prepare("SELECT (sum(capital)) suma from prestamos WHERE aprobacion=1;");    
    $sent3->execute([]);
    $sentencia_3 = $sent3->fetch(PDO::FETCH_OBJ);

    $sent31 = $base_de_datos->prepare("SELECT (sum(valor)) suma from pagos WHERE realizado=1;");    
    $sent31->execute([]);
    $sentencia_31 = $sent31->fetch(PDO::FETCH_OBJ);
    
   
    $sent4 = $base_de_datos->prepare("SELECT MONTHNAME(vigente) fecham, YEAR(vigente) fechaa from empresa WHERE 1;");    
    $sent4->execute([]);
    $sentencia_4 = $sent4->fetch(PDO::FETCH_OBJ);


    $invsent1 = $base_de_datos->prepare("SELECT * from prestamos, usuarios, estados_prestamos 
                    Where usuarios.cedula=prestamos.usuario AND estados_prestamos.id_estado=prestamos.aprobacion
                    ORDER BY estados_prestamos.id_estado;");
    $invsent1->execute([]);
    $invsentencia_1 = $invsent1->fetchAll(PDO::FETCH_OBJ);
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



<div class= "item1"><br>Recaudo total
        <b><br>$<?php echo  number_format(($sentencia_2->suma),0)?></b></div>
        <div class= "item2"><br>Prestamos 
        <b><br>$<?php echo number_format(($sentencia_3->suma),0)?></b></div>
        <div class= "item3"><br>Ganancias 
        <b><br>$<?php echo number_format(($sentencia_31->suma),0)?></b></div>


        <span>El mes vigente es: <?php echo $sentencia_4->fechaa?> - <?php echo $sentencia_4->fecham?></span>

    <BR>
    <BR>

<a href="liq1.php">Cerrar mes</a>


<table style="width:100%">
        <tr>
            <td colspan="6" class="titulo1"><b>Cuentas</b></td>
        </tr>
        <tr>
            <td class="titulo1"><b>Tipo</b></td>
            <td class="titulo1"><b>N° Cuenta</b></td>
            <td colspan="2" class="titulo1"><b>Propietario</b></td>
            <td class="titulo1"><b>Fecha de creacion</b></td>
            <td class="titulo1"><b>Cupos</b></td>


            </tr>
        <?php foreach($sentencia_1 AS $s1){ ?>
        <tr>
                <td>Inversión</td>     
                <td>00-000<?php echo $s1->id?></td>  
                <td><?php echo $s1->nombres?></td>
                <td><?php echo $s1->apellidos?></td>
                <td><?php echo $s1->fecha?></td>
                <td><?php echo $s1->cupos?></td>

      
        </tr>
            <?php


            }

            ?>

    </table>   
    <br>
    <br>
    <table style="width:100%">
        <tr>
            <td colspan="6" class="titulo1"><b>Inversiones</b></td>
        </tr>
        <tr>
     
            <td colspan="2" class="titulo1"><b>Propietario</b></td>
            <td class="titulo1"><b>Fecha de desembolso</b></td>
            <td class="titulo1"><b>Capital</b></td>
            <td class="titulo1"><b>Estado</b></td>


            </tr>
        <?php foreach($invsentencia_1 AS $invs1){ ?>
        <tr>
      
                <?php
                    if($invs1->id_estado==1){ 
                        ?>

                        <td><?php echo $invs1->nombres?></td>
                        <td><?php echo $invs1->apellidos?></td>
                        <td><?php echo $invs1->Desem?></td>
                        <td>$ <?php echo number_format(($invs1->capital),0)?></td>
                        <td style="color:green"><?php echo $invs1->estado?></td>

                 <?php
                    }else{
                        ?>
                        <td style="background-color:gray"><?php echo $invs1->nombres?></td>
                        <td style="background-color:gray"><?php echo $invs1->apellidos?></td>
                        <td style="background-color:gray"><?php echo $invs1->Desem?></td>
                        <td style="background-color:gray">$ <?php echo number_format(($invs1->capital),0)?></td>
                        <td style="background-color:gray"><?php echo $invs1->estado?></td>
                        <?php
                    }
                ?>
           

      
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