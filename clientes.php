<?php
include "lib/fw.php";

$pag = $_GET["pag"];
$max = $pag * 7;
$min = $max - 7;
$sql = "SELECT * FROM info_cliente";
$conn = getConnection();
$resultado = $conn->query($sql);
if ($resultado !== false) {
  foreach ($resultado as $row) {
    if (($row["id"] <= $max) && ($row["id"] > $min)) {
      echo '<tr>';
      echo '  <td class="text-left">';
      echo $row["nome"];
      echo '</td>';
      echo '  <td>';
      echo $row["email"];
      echo '</td>';
      echo '  <td>';
      echo $row["cell1"];
      echo '</td>';
      echo '  <td>';
      echo $row["cell2"];
      echo '</td>';
      echo '  <td> <button type="button" class="btn btn-link" data-toggle="modal" data-target="#detalhesModal" data-whatever="';
      echo $row["id"];
      echo '"><i class="fas fa-bars"></i></button> </td>';
      echo '</tr>';
    }
  }
}
$conn = null;

 ?>
