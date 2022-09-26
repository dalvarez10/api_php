<?php

include "./DB/database.php";

$db = new DATABASE();

$con = $db->getConnection();


//Mostrar lista de post
$sql = $con->prepare("SELECT * FROM pedidos");
$sql->execute();

$res =array();

foreach ($sql->fetchAll(PDO::FETCH_OBJ) as $key => $dato) {
  
//busca el los datos del fk 
$sql1 = $con->prepare("SELECT * FROM productos where id= ?");
$sql1->execute(
  [
    $dato->FK_PRODUCTO
  ]);
$fk =$sql1->fetch(PDO::FETCH_OBJ);

array_push($res,array(
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
  ))
);

}

header("HTTP/1.1 200 OK");
echo json_encode( $res  );
exit();
