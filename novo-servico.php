<?php
include "lib/fw.php";

$id = $_POST["id_addS"];
$data = $_POST["addData"];
$descricao = $_POST["addServico"];

addServico($id, $data, $descricao);
header("location:content.php?_location=listar-clientes");

 ?>
