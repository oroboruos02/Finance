
<?php

error_reporting(0);

include_once "conexion.php";

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
include_once "conexion/conexion.php";
    $sent1 = $base_de_datos->prepare("SELECT * from usuarios Where cedula=?;");
    $sent1->execute([$producto]);
    $sentencia_1 = $sent1->fetch(PDO::FETCH_OBJ);?>

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
        background-color:#cccc ;
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
</style>
</head>
<body>

<div class="item"></div>


    <form action="mods/actualizar_persona.php" method="POST">
         <span class="p1">Identificación</span>
        <input name="id"class="p2" value="<?php echo $sentencia_1->cedula?>" readonly></input>
        <br>
        <span class="p1">Nombres</span>
        <input name="nombres" class="p2" value="<?php echo $sentencia_1->nombres?>"></input>
        <br>
        <span class="p1">Apellidos</span>
        <input name="apellidos" class="p2" value="<?php echo $sentencia_1->apelidos?>"></input>
        <br>
        <span class="p1">Telefono</span>
        <input name="telefono" class="p2"  value="<?php echo $sentencia_1->Telefono?>"></input>
        <br>
        <span class="p1">Email</span>
        <input name="email" class="p2" value="<?php echo $sentencia_1->email?>"></input>
        <br>
        <span class="p1">Contraseña</span>
        <input type="password"name="pass1" class="p2" value="<?php echo $sentencia_1->pass?>"></input>
        <br>
        <span class="p1">Ciudad</span>
        <select name="ciudad" CLASS="p2">
            <option CLASS="p2" value="<?php echo $sentencia_1->municipio?>"><?php echo $sentencia_1->municipio?></option>
            <option CLASS="p2" value="BOGOTA">BOGOTA</option>
            <option CLASS="p2" value="NEIVA">NEIVA</option>
        </select>
        <br>
        <br>        
        <input type="submit" class="enviar"></input>

    

        
    </form>   
    

</body>

</head>
</html>