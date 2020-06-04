<?php
include "lib/fw.php";

$id = $_POST["id_edit_serv"];
$data = $_POST["data_edit_serv"];
$desc = $_POST["desc_edit_serv"];

echo $id;
echo $data;
echo $desc;

$dados = array(
  "data" => $data,
  "descricao" => $desc
);
$key = array(
  "id_servico" => $id
);
sqlUpdate("servico", $dados, $key);

header("location:content.php?_location=listar-clientes");
?>