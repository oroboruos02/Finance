<?php 
session_start(); 
include("db.php");
$mensaje="Err";

if(isset($_POST['email']) && $_POST['email'] != '' && isset($_POST['password']) && $_POST['password'] != '') {
  $username = trim($_POST['email']);
  $password = trim($_POST['password']);
  if($username != "" && $password != "") {
    try {
      $query = "select * from usuarios where `email`=:email and `pass`=:password" ;
      $stmt = $db->prepare($query);
      $stmt->bindParam('email', $username, PDO::PARAM_STR);
      $stmt->bindValue('password', $password, PDO::PARAM_STR);
      $stmt->execute();
      $count = $stmt->rowCount();
      $row   = $stmt->fetch(PDO::FETCH_ASSOC);

      $_SESSION['sess_user_id'];
      if($count == 1 && !empty($row)) {
        /******************** Your code ***********************/
        $_SESSION['sess_user_id']   = $row['cedula'];
        $_SESSION['sess_name'] = $row['nombres'];
        $_SESSION['sess_rol'] = $row['rol'];

        if($_SESSION['sess_rol'] ==2){
          header('location:../cuenta.php');
        }else{
          header('location:../cuenta_adm.php');
        }
 
      } else {
        echo "invalid";
        header("location:../Entrar.html?Err=$mensaje");
       
      }
    } catch (PDOException $e) {
      echo "Error : ".$e->getMessage();
      header('location:login.php');
    }
  } else {
    echo "Both fields are required!";
  }
} else {
  header("location:login.php/$mensaje");
}
?>