<!DOCTYPE html>
<?php
error_reporting(0);
include_once "conexion.php";
error_reporting();
$producto = $_GET["area"];


$sentencia_3 = $base_de_datos->prepare("SELECT count(id) as nombre FROM articulo WHERE inventario=?;");
$sentencia_3->execute([$producto]);
$sentencia_33 = $sentencia_3->fetch(PDO::FETCH_OBJ);

$sentencia_1 = $base_de_datos->prepare("SELECT * FROM articulo where inventario=?");
$sentencia_1->execute([$producto]);
$sentencia_11 = $sentencia_1->fetchAll(PDO::FETCH_OBJ);

  ?>

<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta name="description" content="Ejemplo de HTML5" /> 
  <meta name="keywords" content="HTML5, CSS3, JavaScript" /> 
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.cdnfonts.com/css/poppins" rel="stylesheet">
  <style>
    @import url('https://fonts.cdnfonts.com/css/poppins');
  </style>
</head>
<body style="background-color: white; height:100%;">

  <div style="position:absolute; left:24%; width:1000px;">
    <br>
 
    <table style="border: 1px solid blue; font-family: Georgia, serif; font-size:18px; color: #224891; width:100%; font-family: 'Poppins', sans-serif;">
      <tr>
        <td style="height:100%; padding-right: 35px;
            padding-left: 27px;
            margin-right: 2px;
            line-height: 48px;
            width:230px">Área:</td>
        <td style="height:100%; padding-right: 35px;
            padding-left: 27px;
            padding-top: 10px;
            margin-right: 2px;
            line-height: 18px;
            width:400px;
            max-width:400px"><?php echo $producto ?></td>
        <td style="height:100%; padding-right: 35px;
            padding-left: 27px;
            margin-right: 2px;
            line-height: 18px;
            width:50px">Equipos computo:</td>
        <td style="height:100%; padding-right: 35px;
            padding-left: 27px;
            margin-right: 2px;
            line-height: 18px;
            width:90x;
            max-width:90px"><?php echo $sentencia_33->nombre ?></td>
            
      </tr>
    </table>

    <br>
    <br>
    <br>

    <table style="border: 1px solid blue; font-family: Georgia, serif; font-size:18px; color: #224891; width:100%; font-family: 'Poppins', sans-serif;">
      <tr>
        <td style="background-color:#224891; width:100%; text-align: center; color: white" colspan="8">Inventario</td>
      </tr> 

      <tr>
      <td style="width: 10px"></td>
        <td style="height:100%; padding-right: 35px;
            padding-left: 12px;
            margin-right: 2px;
            line-height: 48px;
            width:10px">Placa:</td>
        <td style="height:100%; padding-right: 35px;
            padding-left: 20px;
            margin-right: 2px;
            line-height: 48px;
            width:180px">Tipo:</td>
        <td style="height:100%; padding-right: 35px;
            padding-left: 10px;
            margin-right: 2px;
            line-height: 48px;
            width:340px">Activo:</td>
        <td style="height:100%; padding-right: 35px;
            padding-left: 17px;
            margin-right: 2px;
            line-height: 48px;
            width:230px">Procesador:</td>
        <td style="height:100%; padding-right: 35px;
            padding-left: 27px;
            margin-right: 2px;
            line-height: 48px;
            width:230px">RAM:</td>
        <td style="height:100%; padding-right: 35px;
            padding-left: 27px;
            margin-right: 2px;
            line-height: 48px;
            width:30px"></td>
        <td style="height:100%; padding-right: 35px;
            padding-left: 27px;
            margin-right: 2px;
            line-height: 48px;
            width:30px"></td>

      </tr>
      <?php foreach($sentencia_11 as $sent1){ ?>
      <tr style="border: 1px solid blue;">
      <td style="width:10px">              
              <div title="<?php echo $sent1->comentario ?>"> 
              <img  style="cursor:pointer; width:20px; heigth:16px; border:0; margin-left:10px; margin-top:-3px" src="images/<?php echo $sent1->a ?>.gif" >  </div>
              
            </a>  
              
            
            </td>
        <td style="height:100%; padding-right: 35px;
              padding-left: 20px;
              margin-right: 2px;
              line-height: 48px;
              width:30px">              
              <a href="search.php?placa=<?php echo urlencode("$sent1->id");?>">   
              <?php echo $sent1->id ?> 

              
            </a>  
              
            
            </td>

        <td style="height:100%; padding-right: 35px;
              padding-left: 12px;
              margin-right: 2px;
              line-height: 48px;
              width:180px"><?php echo $sent1->tipo ?></td>      
        <td style="height:100%; padding-right: 35px;
              padding-left: 10px;
              margin-right: 2px;
              line-height: 28px;
              width:340px"><?php echo $sent1->nombre ?></td> 
        <td style="height:100%; padding-right: 35px;
              padding-left: 17px;
              margin-right: 2px;
              line-height: 28px;
              width:230px"><?php echo $sent1->procesador ?></td> 
        <td style="height:100%; padding-right: 35px;
              padding-left: 27px;
              margin-right: 2px;
              line-height: 28px;
              width:230px"><?php echo $sent1->ram ?></td> 

        <td>
          <a href="placas/<?php echo $sent1->id?>.pdf" target="_blank"><img style="width:40px" src="images/pre.png"></a>
         </td>

        <td>
          <a href="placas/<?php echo $sent1->id?>.pdf" download="ACTIVO-<?php echo $sent1->id?>.pdf"><img style="width:40px" src="images/pdf.png"></a>
        </td>
            
  


 
  

      </tr>  
      <?php } ?>  


    </table> 
  </div>  

</body>


</html>