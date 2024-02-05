<?php

include_once "../conexion/conexion.php";


$sent4 = $base_de_datos->prepare("SELECT year(vigente) fechy, MONTH(vigente) fechx, MONTHNAME(vigente) fecham, YEAR(vigente) fechaa, vigente,  date_add(vigente, interval 1 month) nuevocierre, date_add(vigente, interval 0 month) cierref,  date_sub(vigente, interval 1 month) cierrei from empresa WHERE 1;");    
$sent4->execute([]);
$sentencia_4 = $sent4->fetch(PDO::FETCH_OBJ);

$vigencia=$sentencia_4->cierref;

$sent41 = $base_de_datos->prepare("SELECT usuarios.cedula, aportes.cuenta_id, sum(valor1) sumanom from aportes, cuentas, usuarios WHERE aportes.pagado='SI' and usuarios.cedula=cuentas.propietario and aportes.cuenta_id=cuentas.id AND corte BETWEEN '$sentencia_4->cierrei' AND '$sentencia_4->cierref' group by usuarios.cedula order by usuarios.cedula desc ;");    
$sent41->execute([]);
$sentencia_41 = $sent41->fetchAll(PDO::FETCH_OBJ);

$sent42 = $base_de_datos->prepare("SELECT usuarios.cedula, sum(valor1) sumanom from aportes, cuentas, usuarios WHERE aportes.pagado='SI' and usuarios.cedula=cuentas.propietario and aportes.cuenta_id=cuentas.id AND corte BETWEEN '$sentencia_4->cierrei' AND '$sentencia_4->cierref'  order by usuarios.cedula desc ;");    
$sent42->execute([]);
$sentencia_42 = $sent42->fetch(PDO::FETCH_OBJ);

$sent43 = $base_de_datos->prepare("SELECT sum(valor) as ganar from pagos WHERE pagos.realizado=1 and fecha BETWEEN '$sentencia_4->cierrei' AND '$sentencia_4->cierref';");    
$sent43->execute([]);
$sentencia_43 = $sent43->fetch(PDO::FETCH_OBJ);

$producto;
?>
<?php foreach($sentencia_41 as $s1){ ?>
    <BR> <BR><BR>
<span>propietario es <?php echo $s1->cedula?>, cuenta es <?php echo $s1->cuenta_id?>, El periodo vigente es: <?php echo $s1->sumanom?></span>
<BR>
<span>el total <?php echo $sentencia_42->sumanom?></span>
<BR>
<span>corresponde a <?php echo ($s1->sumanom)/($sentencia_42->sumanom/100)?></span>
<BR>
<span>total ganancias <?php echo $sentencia_43->ganar?></span>
<br>
<span>total ganancias <?php $fechaliquidar=$sentencia_4->fechy.$sentencia_4->fechx?> <?php echo $fechaliquidar?></span>

<br>
<span>valor a liquidar <?php $abonos2=(($sentencia_43->ganar/100)*(($s1->sumanom)/($sentencia_42->sumanom/100)))?> <?php echo ($sentencia_43->ganar/100)*(($s1->sumanom)/($sentencia_42->sumanom/100))?></span>

<?php 

            $sent43 = $base_de_datos->prepare("INSERT INTO `liquidacion`(`cuenta_id`, `valorn`, `id_pago`) VALUES ($s1->cuenta_id,$abonos2,$fechaliquidar)");    
            $resultado = $sent43->execute([]);

            $sente1 = $base_de_datos->prepare("UPDATE `empresa` SET `vigente`='$sentencia_4->nuevocierre' WHERE 1");    
            $resultado = $sente1->execute([]);
           
            header("Location: liq1.php");

?>
<BR>
<?php


}

?>

<BR>
<BR>
<span>ini <?php echo $sentencia_4->cierrei?></span>
<br>
<span>fin <?php echo $sentencia_4->cierref?></span>

<a href="liq2.php">Cerrar mes</a>
<?php
    //if($producto==$c1){
     // header("Location: tabla_usuarios.php");
    //}else{

  
   // header("Location: ../personal.php");
    //}

      
?>




