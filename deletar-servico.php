<?php
include "lib/fw.php";

$id = $_POST["id_del_serv"];

$sqlServ = "DELETE FROM servico WHERE id_servico = $id";
$conn = getConnection();
$resultado = $conn->query($sqlServ);
$conn = null;

header("location:content.php?_location=listar-clientes");

 ?>
