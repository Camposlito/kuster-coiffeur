<?php
include "lib/fw.php";

$id = $_GET["det"];
$dado = array (
  "id" => $id
);
$row = sqlSelectFirst("info_cliente", $dado);
echo $row["nome"];
 ?>
