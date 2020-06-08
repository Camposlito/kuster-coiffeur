<?php
include "lib/fw.php";

$id = $_GET["det"];
$dado = array(
  "id" => $id
);
$row = sqlSelectFirst("info_cliente", $dado);
$ultimoServico = getUltimoServ($row["id"]);
if (is_null($row["niver_dia"]) || $row["niver_dia"] == 0) {
  $niver = "";
} else {
  if (strlen($row["niver_dia"]) > 1) {
    $niver = $row["niver_dia"] . "/" . $row["niver_mes"];
  } else {
    $niver = "0" . $row["niver_dia"] . "/" . $row["niver_mes"];
  }
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
    <form class="needs-validation" novalidate method="post" action="editar.php">
      <div class="form-group row">
        <div class="col">
          <label for="nome" class="col-form-label" id="labelNomeEdit"><i class="fas fa-id-card"></i> Nome</label>
          <input type="text" class="form-control" name="nome" id="dnome" placeholder="Não informado" value="{$row["nome"]}" readonly required>
          <div class="invalid-feedback">
            É necessário um nome válido.
          </div>
        </div>
      </div>
      <hr>
      <div class="form-group row">
        <div class="col">
          <label for="email" class="col-form-label"><i class="fas fa-at"></i> E-mail</label>
          <input type="email" class="form-control" name="email" id="demail" placeholder="Não informado" value="{$row["email"]}" readonly>
        </div>
      </div>
      <hr>
      <div class="form-group row">
        <div class="col">
          <label for="cell1"><i class="fas fa-mobile-alt"></i> Celular (1)</label>
          <input class="form-control" type="tell" name="cell1" id="dcell1" placeholder="Não informado" value="{$row["cell1"]}" readonly>
        </div>
        <div class="col">
          <label for="cell2"><i class="fas fa-mobile-alt"></i> Celular (2)</label>
          <input class="form-control" type="text" name="cell2" id="dcell2" placeholder="Não informado" value="{$row["cell2"]}" readonly>
        </div>
        <div class="col">
          <label for="tell"><i class="fas fa-phone-alt"></i> Telefone Fixo</label>
          <input class="form-control" type="text" name="tell" id="dtell" placeholder="Não informado" value="{$row["tell_fixo"]}" readonly>
        </div>
      </div>
      <hr>
      <div class="form-group row">
        <div class="col">
          <label for="niver"><i class="fas fa-birthday-cake"></i> Aniversário</label>
          <input class="form-control" type="text" name="niver" id="dniver" value="{$niver}" placeholder="Não informado" readonly>
        </div>
      </div>
      <hr>
      <div class="form-group row">
        <div class="col">
          <label for="servico"><i class="fas fa-cut"></i> Ultimo Serviço</label>
          <input class="form-control-plaintext" type="text" name="servico" value="{$ultimoServico}" placeholder="Não informado" readonly>
          <input type="hidden" name="id_user" value="{$row["id"]}">
        </div>
      </div>
      <div class="form-group row">
        <div class="col">
          <button type="button" id="btn-vts" class="btn btn-dark" data-toggle="modal" data-target="#servicosModal" data-whatever="{$row["id"]}"><i class="fas fa-clipboard-list"></i> Ver Todos os Serviços</button>
          <button type="button" id="btn-addS" class="btn btn-info" data-toggle="modal" data-target="#addServicoModal" data-whatever="{$row["id"]}§{$row["nome"]}"><i class="fas fa-plus-circle"></i> Adicionar Serviço</button>
        </div>
      </div>

      <div class="form-group row div-salvar">
        <div class="col text-right">
          <button type="submit" class="btn btn-success" disabled id="btn-salvar"><i class="fas fa-user-check"></i> Salvar</button>
        </div>
      </div>

    </form>
  </div>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
  <button type="button" class="btn btn-primary" id="btn-editar" onclick="editar()"><i class="fas fa-user-cog"></i> Editar</button>
  <button type="button" id="btn-del" class="btn btn-danger" data-toggle="modal" data-target="#deletarModal" data-whatever="{$row["id"]}§{$row["nome"]}"><i class="fas fa-user-slash"></i> Deletar</button>
</div>

EOT;
