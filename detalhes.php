<?php
include "lib/fw.php";

$id = $_GET["det"];
$dado = array (
  "id" => $id
);
$row = sqlSelectFirst("info_cliente", $dado);
$ultimoServico = getUltimoServ($row["id"]);
if (is_null($row["niver_dia"])) {
  $niver = "";
}else {
  $niver = $row["niver_dia"]."/".$row["niver_mes"];
}

echo <<<EOT
<div class="modal-header">
  <h4 class="modal-title" id="detalhesModalLabel"><i class="fas fa-info-circle"></i> &nbsp; Informações do Cliente</h4>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="modal-body">
  <div class="container-fluid">
    <form>
      <div class="form-group row">
        <div class="col">
          <label for="nome" class="col-form-label"><i class="fas fa-id-card"></i> Nome</label>
          <input type="text" class="form-control" name="nome" placeholder="Não informado" value="{$row["nome"]}" readonly>
        </div>
      </div>
      <hr>
      <div class="form-group row">
        <div class="col">
          <label for="email" class="col-form-label"><i class="fas fa-at"></i> E-mail</label>
          <input type="text" class="form-control" name="email" placeholder="Não informado" value="{$row["email"]}" readonly>
        </div>
      </div>
      <hr>
      <div class="form-group row">
        <div class="col">
          <label for="cell1"><i class="fas fa-mobile-alt"></i> Celular (1)</label>
          <input class="form-control" type="tell" name="cell1" placeholder="Não informado" value="{$row["cell1"]}" readonly>
        </div>
        <div class="col">
          <label for="cell2"><i class="fas fa-mobile-alt"></i> Celular (2)</label>
          <input class="form-control" type="text" name="cell2" placeholder="Não informado" value="{$row["cell2"]}" readonly>
        </div>
        <div class="col">
          <label for="tell"><i class="fas fa-phone-alt"></i> Telefone Fixo</label>
          <input class="form-control" type="text" name="tell" placeholder="Não informado" value="{$row["tell_fixo"]}" readonly>
        </div>
      </div>
      <hr>
      <div class="form-group row">
        <div class="col">
          <label for="niver"><i class="fas fa-birthday-cake"></i> Aniversário</label>
          <input class="form-control" type="text" name="niver" value="{$niver}" placeholder="Não informado" readonly>
        </div>
      </div>
      <hr>
      <div class="form-group row">
        <div class="col">
          <label for="servico"><i class="fas fa-cut"></i> Ultimo Serviço</label>
          <input class="form-control-plaintext" type="text" name="servico" value="{$ultimoServico}" placeholder="Não informado" readonly>
        </div>
      </div>
      <div class="form-group row">
        <div class="col">
          <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#servicosModal" data-whatever="{$row["id"]}">Ver Todos os Serviços</button>
        </div>
      </div>

    </form>
  </div>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
  <button type="button" class="btn btn-primary"><i class="fas fa-user-cog"></i> Editar</button>
  <button type="button" class="btn btn-danger"><i class="fas fa-user-slash"></i> Deletar</button>
</div>

EOT;

 ?>
