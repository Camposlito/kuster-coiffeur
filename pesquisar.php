<?php
include "lib/fw.php";

if (isset($_GET["pesquisa"])) {
  $nome = $_GET["pesquisa"];
  $conn = getConnection();
  if (empty($nome)) {
    $sql = "SELECT * FROM info_cliente";
  }else {
    $nome .= "%";
    $sql = "SELECT * FROM info_cliente WHERE nome LIKE '$nome'";
  }
  $resultado = $conn->query($sql);
  if ($resultado !== false) {
    foreach ($resultado as $row) {
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
      echo '  <td><i class="fas fa-bars"></i></td>';
      echo '</tr>';
    }
  }else {
    echo '<h3>Sem resultados</h3>';
  }
  $conn = null;
}
 ?>
