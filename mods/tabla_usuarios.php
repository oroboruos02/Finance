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
   , '</script>';
}

$producto=$_SESSION['sess_user_id'];

    $sent1 = $base_de_datos->prepare("SELECT * from usuarios WHERE 1;");
    $sent1->execute([]);
    $sentencia_1 = $sent1->fetchAll(PDO::FETCH_OBJ); 

    $sent2 = $base_de_datos->prepare("SELECT (sum(valor1)+(valor_nom*cupos)) suma from aportes, cuentas WHERE aportes.cuenta_id=cuentas.id AND cuentas.propietario=?;");    $sent2->execute([$producto]);
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

        <a href="personal_n.php">Crear nuevo</a>
    <table style="width:70%">
        <tr>
            <td colspan="6" class="titulo1"><b>Usuarios</b></td>
        </tr>
        <tr>
            <td class="titulo1"><b>Cedula</b></td>
            <td class="titulo1"><b>Nombres</b></td>
            <td class="titulo1"><b>Apellidos</b></td>
            <td class="titulo1"><b>Correo</b></td>
            <td class="titulo1"><b>Rol</b></td>
            
            </tr>
        <?php foreach($sentencia_1 AS $s1){ ?>
        <tr>
            
                <td><?php echo $s1->cedula?></td>  
                <td><?php echo $s1->nombres?></td>  
                <td><?php echo $s1->apellidos?></td>
                <td><?php echo $s1->email?></td>
                <td>Rol</td>
                <td><a href="personal2.php?cedula=<?php echo $s1->cedula?>"><img style="width:20px"src="../images/icons/edit.png"></a></td>
      
        </tr>
            <?php


            }

            ?>

    </table>   
    

</body>

</head>
</html>