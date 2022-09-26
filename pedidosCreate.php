<?php

include "./DB/database.php";

$db = new DATABASE();

$con = $db->getConnection();

$input = $_POST;

$statement = $con->prepare("INSERT INTO pedidos
(DIRECCION,DESTINATARIO,FECHA_PEDIDO,FECHA_ENTREGA,CARGO,COD_POSTAL,EMAIL,FK_PRODUCTO) VALUES (?,?,?,?,?,?,?,?)");

$statement->execute([
      $_POST['direccion'],
      $_POST['destinatario'],
      $_POST['fecha_pedido'],
      $_POST['fecha_entrega'],
      $_POST['cargo'],
      $_POST['cod_postal'],
      $_POST['email'],
      $_POST['fk_producto']
]);

$postId = $con->lastInsertId();

//buscamos los campos del registro insertado
$sql = $con->prepare("SELECT * FROM pedidos where id= ?");
$sql->execute(
      [
            $postId
      ]);

$dato = $sql->fetch(PDO::FETCH_OBJ);

 //busca el los datos del fk 
 $sql1 = $con->prepare("SELECT * FROM productos where id= ?");
 $sql1->execute([$dato->FK_PRODUCTO]);

 $fk =$sql1->fetch(PDO::FETCH_OBJ);

 $res =  array(
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

header("HTTP/1.1 200 OK");
echo json_encode($res);


