<?php
include "lib/fw.php";

$nome = $_POST["nome"];
$email = $_POST["email"];
$cell1 = $_POST["cell1"];
$cell2 = $_POST["cell2"];
$tell = $_POST["tell"];
$id = $_POST["id_user"];
$niver = $_POST["niver"];

$data = explode("/", $niver);
$dia = $data[0];
$mes = $data[1];

$dados = array(
  "nome" => $nome,
  "email" => $email,
  "cell1" => $cell1,
  "cell2" => $cell2,
  "tell_fixo" => $tell,
  "niver_mes" => $mes,
  "niver_dia" => $dia
);
$key = array(
  "id" => $id
);
sqlUpdate("info_cliente", $dados, $key);

header("location:content.php?_location=listar-clientes");
?>
