<?php

include "./DB/database.php";

$db = new DATABASE();

//$dbConn =  connect($db);


//Mostrar lista de post
$sql =$db->getConnection()->prepare("SELECT * FROM productos");
$sql->execute([]);
$sql->setFetchMode(PDO::FETCH_ASSOC);
header("HTTP/1.1 200 OK");
echo json_encode( $sql->fetchAll()  );
exit();
