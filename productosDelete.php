<?php
include "./DB/database.php";

$db = new DATABASE();

$sql =$db->getConnection()->prepare("INSERT INTO productos (PRODUCTO,DESCRIPCION,PRECIO) VALUES (?,?,?)");


 //verificar si existe el usuario
 $sql = $db->getConnection()->prepare("SELECT * FROM productos where id= ?");
 $sql->execute(
    [
        $_POST['id']
]);

 $result = $sql->rowCount();

 if ($result<=0) {
    $res = array("ID ". $_POST['id'] => "no exite registro");

   echo json_encode($res);

 } else {
   
    $dato =$sql->fetch(PDO::FETCH_OBJ);

    
$statement = $db->getConnection()->prepare("DELETE FROM productos where id= ? ");

$statement->execute([
    $_POST['id']
]);

header("HTTP/1.1 200 OK");

$res = array(
    'mensaje'=> 'Registro eliminado satisfactoriamente',
    'data' => array(
        'id' =>  $dato->ID ,
        'producto' =>  $dato->PRODUCTO,
        'descripcion' =>  $dato->DESCRIPCION ,
        'precio' =>  $dato->PRECIO
    )
);
   echo json_encode($res);
   exit();
 }