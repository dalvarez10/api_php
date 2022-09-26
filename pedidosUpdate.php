<?php

include "./DB/database.php";

$db = new DATABASE();

$con = $db->getConnection();

//verificar si existe el usuario
$sql = $con->prepare("SELECT * FROM pedidos where ID= ?");
$sql->execute([
    $_POST['id']
]);
$result = $sql->rowCount();

if ($result<=0) {
   $res = array("ID ". $_POST['id'] => "no exite registro");

  echo json_encode($res);

} else {
  
   $dato =$sql->fetch(PDO::FETCH_OBJ);

    $sql = "UPDATE pedidos SET DIRECCION = ?,DESTINATARIO = ?,FECHA_PEDIDO = ?,FECHA_ENTREGA = ?,CARGO = ?,COD_POSTAL = ?,EMAIL = ?,FK_PRODUCTO = ?  WHERE id= ? ";

    $statement = $con->prepare($sql);
    $statement->execute([
        $_POST['direccion'],
        $_POST['destinatario'],
        $_POST['fecha_pedido'],
        $_POST['fecha_entrega'],
        $_POST['cargo'],
        $_POST['cod_postal'],
        $_POST['email'],
        $_POST['fk_producto'],
        $_POST['id'],
    ]);

    header("HTTP/1.1 200 OK");
    
    //busca el los datos del fk 
    $sql1 = $con->prepare("SELECT * FROM productos where id= ?");
    $sql1->execute([$_POST['fk_producto']]);

    $fk =$sql1->fetch(PDO::FETCH_OBJ);

    $res = array(
        'mensaje'=> 'Registro Actualizado satisfactoriamente',
        'data' => array(
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

echo json_encode($res);
exit();
}
