<?php

include_once "../conexion/conexion.php";

 
  $s1 = $_POST["id"];
  $s2 = $_POST["nombres"];
  $s3 = $_POST["apellidos"];
  $s4 = $_POST["telefono"];
  $s5 = $_POST["email"];
  $s6 = $_POST["pass1"];
  $s7 = $_POST["ciudad"];
 



    $sentencia2=$base_de_datos->prepare("UPDATE `usuarios` SET `nombres`=?, `apellidos`=?, `telefono`=?, `email`=?, `pass`=?, `municipio`=? WHERE `cedula`=?;");
    $resultado = $sentencia2->execute([$s2,$s3,$s4,$s5,$s6,$s7,$s1]);
    header("Location: ../personal.php");

      
?>




