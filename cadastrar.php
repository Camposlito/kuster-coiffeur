<?php
include "lib/fw.php";

$nome = $_POST["firstName"];
$email = $_POST["email"];
$cell1 = $_POST["celular1"];
$cell2 = $_POST["celular2"];
$tell = $_POST["telefone"];

$mes = $_POST["mes"];
$dia = $_POST["dia"];

$data = $_POST["data"];
$descricao = $_POST["servico"];

echo $nome;

addCliente($nome, $email, $cell1, $cell2, $tell, $mes, $dia);
$id_cliente = getIdCliente($nome);
addServico($id_cliente, $data, $descricao);

header("location:content.php?_location=cadastro");
?>
