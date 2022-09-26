<?php

include "./DB/database.php";

$db = new DATABASE();

$con = $db->getConnection();

if (isset($_GET['id']))
{

//verificar si existe el usuario
 $sql = $con->prepare("SELECT * FROM productos where id= ?");

 $sql->execute(
  [$_GET['id']
]);

 $result = $sql->rowCount();

 if ($result<=0) {
    $res = array("ID ". $_GET['id'] => "no exite");

   echo json_encode($res);

 }else{
    
  //Mostrar un post
  $sql = $con->prepare("SELECT * FROM productos where id= ?");

  $sql->execute([
    $_GET['id']
  ]);
  
  header("HTTP/1.1 200 OK");
  echo json_encode(  $sql->fetch(PDO::FETCH_ASSOC)  );
  exit();
 }
  
}
