<?php
include "lib/fw.php";

$nome = $_POST["firstName"];
$email = $_POST["email"];
$cell1 = $_POST["celular1"];
$cell2 = $_POST["celular2"];
$tell = $_POST["telefone"];

$mes = $_POST["mes"];
$dia = $_POST["dia"];
$dia = (int) $dia + 0;

$data = $_POST["data"];
$descricao = $_POST["servico"];

$dados = array(
  "nome" => $nome,
  "email" => $email,
  "cell1" => $cell1,
  "cell2" => $cell2,
  "tell_fixo" => $tell,
  "niver_mes" => $mes,
  "niver_dia" => $dia
);

 sqlInsert("info_cliente", $dados);

 if ($data != "" || $descricao != "") {
   $id = getLastId();
   addServico($id, $data, $descricao);
 }

header("location:content.php?_location=cadastro");
