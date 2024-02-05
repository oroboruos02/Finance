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
   , '</script>';
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
        
        <form>
            <label for="nombre">Subir mi recibo recivo</label>
            <input type="file" id="nombre" name="nombre">

        </form>