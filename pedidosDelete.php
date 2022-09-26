<?php

include "./DB/database.php";

$db = new DATABASE();

$con = $db->getConnection();

 //verificar si existe el usuario
 $sql = $con->prepare("SELECT * FROM pedidos where ID= ?");
 $sql->execute([$_POST['id']]);
 $result = $sql->rowCount();

 if ($result<=0) {
    $res = array("ID ". $_POST['id'] => "no exite registro");

   echo json_encode($res);

 } else {
   
    $dato =$sql->fetch(PDO::FETCH_OBJ);

    //busca el los datos del fk 
    $sql1 = $con->prepare("SELECT * FROM productos where id= ?");
    $sql1->execute(
      [
        $dato->FK_PRODUCTO
      ]
    );

    $fk =$sql1->fetch(PDO::FETCH_OBJ);

    
$id = $_POST['id'];
$statement = $con->prepare("DELETE FROM pedidos where id= ? ");

$statement->execute([
  $_POST['id']
]);
header("HTTP/1.1 200 OK");

$res = array(
  'mensaje'=> 'Registro eliminado satisfactoriamente',
    'id' =>  $dato->ID ,
    'direccion' =>  $dato->DIRECCION,
    'destinario' =>  $dato->DESTINATARIO,
    'email' =>  $dato->EMAIL, 
    'cargo' =>  $dato->CARGO,
    'cod_postal' =>  $dato->COD_POSTAL,
    'fecha_entrega' =>  $dato->FECHA_ENTREGA,
    'fecha_pedido' =>  $dato->FECHA_PEDIDO, 
    "data_fk"=> array(
      'id' =>  $fk->ID ,
      'producto' =>  $fk->PRODUCTO,
      'descripcion' =>  $fk->DESCRIPCION ,
      'precio' =>  $fk->PRECIO
    )
);
   echo json_encode($res);
   exit();
 }