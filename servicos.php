<?php
include "lib/fw.php";

$id = $_GET["serv"];

$clienteNome = getNomeById($id);

$sql = "SELECT * FROM servico WHERE id_cliente = '$id'";
$conn = getConnection();
$resultado = $conn->query($sql);

echo <<<EOT
<div class="modal-header">
  <h5 class="modal-title" id="servicosModalLabel"><i class="fas fa-cut"></i> Mostrando Todos os Serviços de <b> {$clienteNome} </b></h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="modal-body">
<div class="container">
<table class="table table-striped">
  <thead class="thead-light">
    <tr>
      <th scope="col">Data</th>
      <th scope="col">Descrição</th>
    </tr>
  </thead>
  <tbody>
EOT;

if ($resultado !== false) {
  foreach ($resultado as $row) {
    echo <<<EOT
    <tr>
      <th scope="row">{$row["data"]}</th>
      <td>{$row["descricao"]}</td>
    </tr>
EOT;
  }
}
$conn = null;

echo <<<EOT
</tbody>
</table>
</div>
</div>
<div class="modal-footer">
  <button type="button" onclick="voltarModalS()" class="btn btn-secondary" data-toggle="modal" data-target="#detalhesModal" data-whatever="{$id}">Voltar</button>
</div>

EOT;



 ?>
