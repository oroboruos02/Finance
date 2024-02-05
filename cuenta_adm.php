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
<meta name="Usuario" content="Informacion" /> 
<meta name="keywords" content="HTML5, CSS3, JavaScript" /> 
<script src="https://cdn.tailwindcss.com"></script>
<script src="app.js"></script>
<link rel="stylesheet" type="text/css" href="estilos.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" crossorigin="anonymous">

<style>

    .mobile1{
      color:black;
      
    }

    .lateral{

      background-color:white;
      border-width: 3px;
      border-color: rgb(0, 0, 0);
      border-style: inset;
      border-top:none;
      height:100vh;
      width:53px;
    }
    .cuerpo{
      background-color:white;
      width:95%;
    }
    .cabecera{
      background-color:white;
      border-bottom: 1px;
      border-color: rgb(0, 0, 0);
      border-style: dashed; 
      width: 90%;
    }
    .tablas{
      height:600px;
      width:70%;
    }
    .hello{
      width:230px;
      float:left;
    }

    .icons1{
      width: 20px;
      float: left;
    }
    .icons2{
      width: 14px;
      float: left;
    }

  @media (max-width:745px){
    .lateral{
      width:40px;
      background-color:white;
      border-width: 1px;
      border-color: rgb(0, 0, 0);
      border-style: inset;
      border-top:none;
      height:130vh;
      padding right: 1px;
      padding left: 1px;
      content:35px 811px;
}
    .cuerpo{
      background-color:white;
      width:88%;
    }
    .mobile1{
      width:120px;
      overflow:hidden;
      height:20px;
      padding:auto;
      display: flex;
      flex-wrap: wrap;
    }
    .icons1{
      margin-left:-10px;
      height:20px;
      width:20px;
    }
    li{
      height:30px;
      width:1500px;
    }
    .respmenu {
      padding-top: 48px;
      min-height: initial;
      width:100px;
      color: white;
      position: relative;
      min-height: 48px;
    }  
    .tablas{
        height:600px;
        width:100%;         
    }
    .hello{
      width:150px;
      float:left;
    }
    }

</style>
<style>
  
    .respmenu a {
        
        text-decoration: none;
        display: block;
        padding: 10px 20px;
        border-bottom: 2px #3498DB;
        max-width: 200px;
        background: white;
        font-variant: small-caps;
        
        }
      .respmenu input[type="checkbox"], .respmenu .fa-bars, .respmenu .fa-times {
        position: absolute;
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        right: 0;
        top: 0;
        width: 30px;
        height: 30px;
        
        }
      .respmenu .fa-bars, .respmenu .fa-times {
        font-size: 30px;
        pointer-events: none;
        }
      .respmenu input[type="checkbox"] {
        opacity: 0;
        }
      .respmenu nav {
        display: none;
        }
      .respmenu input:checked ~ nav {
        display: block;
        }
      .respmenu input:checked ~ .fa-bars {
        display: none;
        }
      .respmenu input:not(:checked) ~ .fa-times {
        display: none;
        }
      .respmenu input[type="checkbox"], .respmenu .fa-bars, .respmenu .fa-times {
        right: initial;
        left: 0;
        }
      .respmenu {
        padding-top: 48px;
        min-height: initial;
        width:170px;
        position: relative;
        min-height: 48px;
        color: black;
              
        }

</style>
</head>

<body> 

    <div class="lateral">
    <div class="respmenu">
        <input type="checkbox">
        <i class="fas fa-bars"></i>
        <i class="fas fa-times"></i>
        <nav>
          <ul>
            <a href=><img class="icons1" src="images/icons/dashboard.png">Dashboard</a>
            <li><a href="tabla1.php" target="frame1"><img class="icons1" src="images/icons/cuenta.png"><div class="mobile1">Mis cuentas</div></a></li>
            <li><a href="mods/tabla_cuentas.php" target="frame1"><img class="icons1" src="images/icons/mis_productos.png"><div class="mobile1">Productos</div></a></li>
            <li><a href="mods/tabla_usuarios.php" target="frame1"><img class="icons1" src="images/icons/usuario.png"><div class="mobile1">Usuarios</div></a></li>
            <li><a href="personal.php" target="frame1"><img class="icons1" src="images/icons/solicitud.png"><div class="mobile1">Solicitudes</div></a></li>
            <li><a href="mods/reporte1.php" target="frame1"><img class="icons1" src="images/icons/reporte.png"><div class="mobile1">Reportes</div></a></li>
            <a href="conexion/out.php"><img class="icons1" src="images/icons/cerrar_sesion.png">Cerrar sesion</a>
         
          </ul>
        </nav>
      </div>
    </div>

    <div class="cabecera">

        <div class="hello">
          <span class="negrita" style="font-weight:700;">Hello <?php echo $sentencia_1->nombres; $sentencia_1->apellidos ?>!</span><br>
          <span class="tamaño-texto" style="font-size:.7em;">Bienvenido Administrador</span>
        </div>
         
    </div>

    <div class="cuerpo">

            <iframe name="frame1" target="" src="tabla1.php" style="background-color: white; width: 100%; font-family: 'Times New Roman', Times, serif; height: 100%;"></iframe>
          
    </div>

</body>
</html>