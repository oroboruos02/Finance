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
   , '</script>';
}

$producto=$_SESSION['sess_user_id'];
include_once "conexion/conexion.php";
    $sent1 = $base_de_datos->prepare("SELECT * from aportes, cuentas WHERE aportes.cuenta_id=cuentas.id AND cuentas.propietario=? ORDER BY corte desc;");
    $sent1->execute([$producto]);
    $sentencia_1 = $sent1->fetchAll(PDO::FETCH_OBJ); 

    $sent2 = $base_de_datos->prepare("SELECT (sum(valor1)+(valor_nom*cupos)) suma from aportes, cuentas WHERE aportes.cuenta_id=cuentas.id AND cuentas.propietario=?;");    
    $sent2->execute([$producto]);
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
        width:10%
        
    }

    .item1{
    background-color: rgb(255, 255, 255);            
    margin: 50px;
    padding:auto;
    width: 13%;
    height: 100px;
    display: inline-block;
    border-left: 1px;
    border-color: rgb(0, 0, 0);
    border-style:solid;
    margin-top: 5%;
    
        
    
    }

    @media (max-width:745px){ 
    
    .item1{
    background-color: rgb(255, 255, 255);            
    margin: 30px;
    margin-bottom:50px;
    padding: 10px;
    width: 15%;
    height: 100px;
    display: flex;
    border-left: 1px;
    border-color: rgb(0, 0, 0);
    border-style: solid;   
    
    }

    .item2{
    background-color: white;            
    margin: 30px;
    padding: 8px 12px;
    width: 15%;
    height: 100px;
    display: flex;
    border-left: 1px;
    border-color: rgb(0, 0, 0);
    border-style: solid;       
}

    .item3{
    background-color: white;            
    margin: 30px;
    padding: 10px;
    width: 15%;
    height: 100px;
    display: flex;
    border-left: 1px;
    border-color: rgb(0, 0, 0);
    border-style: solid;
}
    }

</style>
</head>
<body> 

        <div class= "item1"><br>Total Ingresos
        <b><br>$<?php echo  number_format(($sentencia_2->suma),0)?></b></div>
        <div class= "item2"><br>Abonos 
        <b><br>$<?php echo number_format(($sentencia_2->suma),0)?></b></div>
        <div class= "item3"><br>Ganancias 
        <b><br>$<?php echo number_format(($sentencia_2->suma),0)?></b></div>

    <table style="width:100%">
        <tr>
            <td colspan="5" class="titulo1"><b>Transacciones</b></td>
        </tr>
        <tr>
            <td class="titulo1"><b>Recibo</b></td>
            <td class="titulo1"><b>N° Cuenta</b></td>
            <td class="titulo1"><b>Fecha de pago</b></td>
            <td class="titulo1"><b>Valor</b></td>
            <td class="titulo1"><b>Estado</b></td>

            </tr>
        <?php foreach($sentencia_1 AS $s1){ ?>
        <tr>
            
                <td>000<?php echo $s1->id_aportes?></td>  
                <td>00-000<?php echo $s1->cuenta_id?></td>  
                <td><?php echo $s1->corte?></td>
                <td>$<?php echo number_format(($s1->valor1),0)?></td>

                <?php 
                    if ($s1->pagado=="NO"){
                    ?>
                      <td><a href="subida_comprobante.php"><img style="width:20px"src="images/icons/carga.png"></a></td>
      
                    <?php
                    }else{
                        ?>
                        <td></Td>
                        <?php

                    }
                ?>
                      


        </tr>
            <?php

            }

            ?>

    </table>   
    

</body>

</head>
</html>