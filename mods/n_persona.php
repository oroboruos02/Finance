<?php

include_once "../conexion/conexion.php";

 
  $s1 = $_POST["id"];
  $s2 = $_POST["nombres"];
  $s3 = $_POST["apellidos"];
  $s4 = $_POST["telefono"];
  $s5 = $_POST["email"];
  $s6 = $_POST["pass1"];
  $s7 = $_POST["ciudad"];
  $s8 = $_POST["rol"];
 



    $sentencia2=$base_de_datos->prepare("INSERT INTO `usuarios`(`cedula`, `nombres`, `apellidos`, `telefono`, `email`, `pass`, `municipio`, `rol`) 
              VALUES (?,?,?,?,?,?,?,?);");
              
    $resultado = $sentencia2->execute([$s1,$s2,$s3,$s4,$s5,$s6,$s7,$s8]);
    
    
    $producto=$_SESSION['sess_user_id'];
    if($producto==$c1){
      header("Location: tabla_usuarios.php");
    }else{

  
    header("Location: ../personal.php");
    }

      
?>




