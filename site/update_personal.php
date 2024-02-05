
<?php

error_reporting(0);

include_once "conexion.php";

#Se comprueba si inicio sesion
session_start();
if(isset($_SESSION['sess_user_id']) ){
  
}else{ 
  echo '<script language="javascript">alert("Ingrese a su cuenta");</script>';
  echo '<script type="text/javascript">'
   , 'window.top.location.href = "/entrar.html";'
   , '</script>'
;


}

include_once "conexion/conexion.php";


$s1=$_POST[id];
$s2=$_POST[nombres];
$s3=$_POST[apellidos];
$s4=$_POST[telefono];
$s5=$_POST[pass1];
$s6=$_POST[municipio];
$s7=$_POST[correo];


    $sent1 = $base_de_datos->prepare("UPDATE set ");
    $sent1->execute([]);




?>