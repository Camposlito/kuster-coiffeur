<?php
include "lib/fw.php";

$id = $_POST["id_edit_serv"];
$data = $_POST["data_edit_serv"];
$desc = $_POST["desc_edit_serv"];

$dataDMA = explode("/", $data);
if (strlen($dataDMA[2]) < 4) {
  $dataDMA[2] = "20" . $dataDMA[2];
  $data = $dataDMA[0] . "/" . $dataDMA[1] . "/" . $dataDMA[2];
}

$dados = array(
  "data" => $data,
  "descricao" => $desc
);
$key = array(
  "id_servico" => $id
);

if (strlen($data) == 10) {
  sqlUpdate("servico", $dados, $key);
}

header("location:content.php?_location=listar-clientes");
