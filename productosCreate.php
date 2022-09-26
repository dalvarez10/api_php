<?php

include "./DB/database.php";

$db = new DATABASE();

$con = $db->getConnection();

$sql =$con->prepare("INSERT INTO productos (PRODUCTO,DESCRIPCION,PRECIO) VALUES (?,?,?)");

$sql->execute([
      $_POST['producto'],
      $_POST['descripcion'],
      $_POST['precio'],
]);

$id = $con->lastInsertId();

if($id)
{
  $input = array(
      'id' => $id,
      'producto' => $_POST['producto'],
      'descripcion' => $_POST['descripcion'],
      'precio' => $_POST['precio'],
  );

  header("HTTP/1.1 200 OK");
  echo json_encode($input);
  exit();
 }

