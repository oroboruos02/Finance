<?php

include_once "../conexion/conexion.php";


$sent4 = $base_de_datos->prepare("SELECT MONTHNAME(vigente) fecham, YEAR(vigente) fechaa, vigente, date_add(vigente, interval 0 month) cierref, date_sub(vigente, interval 1 month) cierrei from empresa WHERE 1;");    
$sent4->execute([]);
$sentencia_4 = $sent4->fetch(PDO::FETCH_OBJ);

$vigencia=$sentencia_4->cierref;

$sent41 = $base_de_datos->prepare("SELECT sum(valor1) as aportest from aportes WHERE aportes.pagado='SI' and corte BETWEEN '$sentencia_4->cierrei' AND '$sentencia_4->cierref';");    
$sent41->execute([]);
$sentencia_41 = $sent41->fetch(PDO::FETCH_OBJ);

$sent42 = $base_de_datos->prepare("SELECT sum(capital) as capital from prestamos WHERE Desem <= '$sentencia_4->cierref' AND aprobacion=1;");    
$sent42->execute([]);
$sentencia_42 = $sent42->fetch(PDO::FETCH_OBJ);
 
$sent43 = $base_de_datos->prepare("SELECT sum(valor) as ganar from pagos WHERE pagos.realizado=1 and fecha BETWEEN '$sentencia_4->cierrei' AND '$sentencia_4->cierref';");    
$sent43->execute([]);
$sentencia_43 = $sent43->fetch(PDO::FETCH_OBJ);


$producto;
?>
<span>El periodo vigente es: <?php echo $sentencia_4->fecham?> <?php echo $sentencia_4->fechaa?></span>
<BR>
<BR>
<span>El total de aportes para el periodo son: $<?php echo number_format(($sentencia_41->aportest),0)?></span>
<BR>
<BR>
<span>El total de capital vigente invertido es: $<?php echo number_format(($sentencia_42->capital),0)?></span>
<BR>
<BR>
<span>El total de rendimientos a repartir es: $<?php echo number_format(($sentencia_43->ganar),0)?></span>
<BR>
<BR>
<span>Recuerde que va a realizar la liquidación definitiva del periodo</span>
<a href="liq2.php">Cierre Definitivo</a>
<?php
    //if($producto==$c1){
     // header("Location: tabla_usuarios.php");
    //}else{

  
   // header("Location: ../personal.php");
    //}

      
?>




