<?php
include "lib/fw.php";

$id = $_POST["id_deletar"];

$sqlUser = "DELETE FROM info_cliente WHERE id = $id";
$sqlServ = "DELETE FROM servico WHERE id_cliente = $id";
$conn = getConnection();
$resultado = $conn->query($sqlUser);
$resultado = $conn->query($sqlServ);
$conn = null;

header("location:content.php?_location=listar-clientes");
 ?>
