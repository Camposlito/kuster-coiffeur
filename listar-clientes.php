<div class="container">
  <div class="text-center">
    <h1><i class="fas fa-users"></i></h1>
    <h2>Clientes</h2>
  </div>
  <div class="row">
    <div class="col">
      <h6> <i class="fas fa-stream"></i> Mostrando de <span id="min">1</span> até <span id="max">7</span> de <b id="totClientes"> <?php echo contClientes(); ?> </b> registros</h6>
    </div>
    <div class="col">

    </div>
    <div class="col text-right">
      <div class="input-group">
        <div class="input-group-prepend">
          <button type="button" name="enviar-pesquisa" class="btn btn-primary" onclick="getDados()"><i class="fas fa-search"></i></button>
        </div>
        <input type="text" name="pesquisa" id="pesquisa" value="" class="form-control" placeholder="Pesquisar">
      </div>
    </div>
  </div>
  <br>

  <!-- Tabela de clientes -->
  <table class="table table-striped table-bordered">
    <thead class="text-center">
      <tr>
        <th scope="col" class="text-left">Nome</th>
        <th scope="col">E-mail</th>
        <th scope="col">Celular (1)</th>
        <th scope="col">Celular (2)</th>
        <th scope="col">Detalhes</th>
      </tr>
    </thead>
    <tbody class="text-center" id="Resultado">

    </tbody>
  </table>

  <div class="row" id="navPag">
    <div class="col">
    </div>
    <div class="col">
    </div>
    <div class="col">
    </div>
    <div class="col">
      <div class="input-group">
        <div class="input-group-prepend">
          <button type="button" class="btn btn-dark" onclick="antePag()">Anterior</button>
        </div>
        <input type="text" class="text-center form-control" value="1" id="numPag" readonly>
        <div class="input-group-append">
          <button type="button" class="btn btn-dark" onclick="proxPag()">Proximo</button>
        </div>
      </div>
    </div>
  </div>

  <!-- modal info_cliente -->
  <div class="modal fade" id="detalhesModal" tabindex="-1" role="dialog" aria-labelledby="detalhesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content" id="detalhes">

      </div>
    </div>
  </div>

  <!-- modal serviços -->
  <div class="modal fade" id="servicosModal" tabindex="-1" role="dialog" aria-labelledby="servicosModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content" id="showServicos">

      </div>
    </div>
  </div>

  <!-- modal addServico -->
  <div class="modal fade" id="addServicoModal" tabindex="-1" role="dialog" aria-labelledby="addServicoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="addServicoModalLabel"><i class="fas fa-folder-plus"></i> Novo Serviço</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form class="needs-validation" novalidate action="novo-servico.php" method="post">
          <div class="modal-body">
            <div class="container">
              <div class="row">
                <h5><i class="fas fa-id-badge"></i> &nbsp; </h5>
                <h5 class="msg-add"></h5>
              </div>
              <input type="hidden" name="id_addS" id="id_addS" class="addId_cliente form-control" value="">
              <hr>
              <div class="row">
                <div class="col">
                  <label for="data">Data</label>
                  <input type="text" class="form-control" name="addData" id="addData" placeholder="__/__/____" value="" required>
                </div>
                <div class="col">
                  <label for="servico">Descrição</label>
                  <input type="text" class="form-control" name="addServico" id="addServico" placeholder="" value="" required>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-success">Concluir</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- modal deletar user -->
  <div class="modal fade" id="deletarModal" tabindex="-1" role="dialog" aria-labelledby="deletarModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="deletarModalLabel"><i class="fas fa-user-slash"></i> Deletar</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="deletar.php" method="post">
          <div class="modal-body">
            <div class="msg-delete"></div>
            <input type="hidden" name="id_deletar" value="">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-success" data-dismiss="modal">Manter</button>
            <button type="submit" class="btn btn-danger">Excluir</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- modal deletar servico -->
  <div class="modal fade" id="delServModal" tabindex="-1" role="dialog" aria-labelledby="delServModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="delServModalLabel"><i class="fas fa-user-slash"></i> Deletar</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="deletar-servico.php" method="post">
          <div class="modal-body">
            <div class="msg-delete"></div>
            <input type="hidden" name="id_del_serv" value="">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-success" data-dismiss="modal">Manter</button>
            <button type="submit" class="btn btn-danger">Excluir</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- modal editar servico -->
  <div class="modal fade" id="editServModal" tabindex="-1" role="dialog" aria-labelledby="editServModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="editServModalLabel"><i class="fas fa-user-cog"></i> Editar Serviço</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form class="needs-validation" novalidate action="editar-servico.php" method="post">
          <div class="modal-body">
            <div class="container-fluid">
              <div class="form-group row msg-data">
                <label class="col-form-label" for="data_edit_serv">Data</label>
                <input class="form-control" type="text" id="data_edit_serv" name="data_edit_serv" placeholder="__/__/____" value="" required>
              </div>
              <div class="form-group row msg-desc">
                <label class="col-form-label" for="desc_edit_serv">Descrição</label>
                <input class="form-control" type="text" name="desc_edit_serv" value="" required>
              </div>
              <div class="form-group msg-id">
                <input class="form-control" type="hidden" name="id_edit_serv" value="">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-success">Salvar</button>
          </div>
        </form>
      </div>
    </div>
  </div>

</div>

<script>
  function editar() {
    //toggle botões
    document.getElementById("btn-salvar").disabled = false;
    document.getElementById("btn-editar").disabled = true;
    document.getElementById("btn-vts").disabled = true;
    document.getElementById("btn-addS").disabled = true;
    document.getElementById("btn-del").disabled = true;
    //habilitar formulário 
    document.getElementById("dnome").readOnly = false;
    document.getElementById("demail").readOnly = false;
    document.getElementById("dcell1").readOnly = false;
    document.getElementById("dcell2").readOnly = false;
    document.getElementById("dtell").readOnly = false;
    document.getElementById("dniver").readOnly = false;
  }

  function proxPag() {
    var m = document.getElementById("max").innerHTML;
    var tot = <?php echo contClientes(); ?>;
    if (m < tot) {
      var pag = document.getElementById("numPag").value;
      var prox = parseInt(pag) + 1;
      listarClientes(prox);
      document.getElementById("numPag").value = prox;
    }
  }

  function antePag() {
    var pag = document.getElementById("numPag").value;
    var ante = parseInt(pag) - 1;
    if (ante != 0) {
      listarClientes(ante);
      document.getElementById("numPag").value = ante;
    }
  }

  //pesquisar com a tecla enter
  $('#pesquisa').keypress(function(event) {
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if (keycode == '13') {
      getDados();
    }
  });

  //Modal deletar Cliente
  $('#deletarModal').on('show.bs.modal', function(event) {
    $('#detalhesModal').modal('hide');
    var button = $(event.relatedTarget);
    var str = button.data('whatever');
    var modal = $(this);
    var idNome = str.split("§");
    modal.find('.msg-delete').text('Deseja excluir TODOS os dados de "' + idNome[1] + '" do registro?');
    modal.find('.modal-body input').val(idNome[0]);
  });

  //Modal deletar Servico
  $('#delServModal').on('show.bs.modal', function(event) {
    $('#servicosModal').modal('hide');
    var button = $(event.relatedTarget);
    var str = button.data('whatever');
    var modal = $(this);
    var idData = str.split("§");
    modal.find('.msg-delete').text('Deseja excluir apenas o serviço do dia "' + idData[1] + '" do registro?');
    modal.find('.modal-body input').val(idData[0]);
  });

  //Modal editar Servico
  $('#editServModal').on('show.bs.modal', function(event) {
    $('#servicosModal').modal('hide');
    var button = $(event.relatedTarget);
    var str = button.data('whatever');
    var modal = $(this);
    var idDataDesc = str.split("§");
    modal.find('.msg-data input').val(idDataDesc[1]);
    modal.find('.msg-desc input').val(idDataDesc[2]);
    modal.find('.msg-id input').val(idDataDesc[0]);
  });
  $('#editServModal').on('shown.bs.modal', function() {
    $('#data_edit_serv').mask('00/00/0000');
  });

  //Modal add Serviço
  $('#addServicoModal').on('show.bs.modal', function(event) {
    $('#detalhesModal').modal('hide');
    var button = $(event.relatedTarget);
    var str = button.data('whatever');
    var modal = $(this);
    var idNome = str.split("§");
    modal.find('.msg-add').text('Adicionar serviço ao cliente "' + idNome[1] + '"');
    modal.find('.addId_cliente').val(idNome[0]);
  });
  $('#addServicoModal').on('shown.bs.modal', function() {
    $('#addData').mask('00/00/0000');
  });
  $('#addServicoModal').on('hide.bs.modal', function() {
    document.getElementById('addData').value = "";
    document.getElementById('addServico').value = "";
  });

  //Modal detalhes do cliente + AJAX de info_cliente
  $('#detalhesModal').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget);
    var id = button.data('whatever');
    var result = document.getElementById("detalhes");
    var xmlreq = CriaRequest();
    xmlreq.open("GET", "detalhes.php?det=" + id, true);
    xmlreq.onreadystatechange = function() {
      if (xmlreq.readyState == 4) {
        if (xmlreq.status == 200) {
          result.innerHTML = xmlreq.responseText;
        } else {
          result.innerHTML = "Erro: " + xmlreq.statusText;
        }
      }
    };
    xmlreq.send(null);

    var modal = $(this);

  });

  $('#detalhesModal').on('shown.bs.modal', function(event) {
    $('#dcell1').mask('(00) 0 0000-0000');
    $('#dniver').mask('00/00');
    $('#dtell').mask('(00) 0000-0000');

    var forms = document.getElementsByClassName('needs-validation');
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });

  });

  //cria objeto AJAX Request
  function CriaRequest() {
    try {
      request = new XMLHttpRequest();
    } catch (IEAtual) {
      try {
        request = new ActiveXObject("Msxml2.XMLHTTP");
      } catch (IEAntigo) {
        try {
          request = new ActiveXObject("Microsoft.XMLHTTP");
        } catch (falha) {
          request = false;
        }
      }
    }
    if (!request)
      alert("Seu Navegador não suporta Ajax!");
    else
      return request;
  }

  function listarClientes(pag) {
    var min = (pag * 7) - 6;
    var max = pag * 7;
    document.getElementById("max").innerHTML = max;
    document.getElementById("min").innerHTML = min;
    var result = document.getElementById("Resultado");
    var xmlreq = CriaRequest();
    xmlreq.open("GET", "clientes.php?pag=" + pag, true);
    xmlreq.onreadystatechange = function() {
      if (xmlreq.readyState == 4) {
        if (xmlreq.status == 200) {
          result.innerHTML = xmlreq.responseText;
        } else {
          result.innerHTML = "Erro: " + xmlreq.statusText;
        }
      }
    };
    xmlreq.send(null);
  }

  //Função para enviar os dados AJAX de pesquisa
  function getDados() {
    var nome = document.getElementById("pesquisa").value;
    if (nome != "") {
      var result = document.getElementById("Resultado");
      var xmlreq = CriaRequest();
      xmlreq.open("GET", "pesquisar.php?pesquisa=" + nome, true);
      // Atribui uma função para ser executada sempre que houver uma mudança de estado
      xmlreq.onreadystatechange = function() {
        // Verifica se foi concluído com sucesso e a conexão fechada (readyState=4)
        if (xmlreq.readyState == 4) {
          // Verifica se o arquivo foi encontrado com sucesso
          if (xmlreq.status == 200) {
            result.innerHTML = xmlreq.responseText;
          } else {
            result.innerHTML = "Erro: " + xmlreq.statusText;
          }
        }
      };
      xmlreq.send(null);
      $('#navPag').hide();
    } else {
      listarClientes(1);
      $('#navPag').show();
    }
  }

  //modal + AJAX serviços
  $('#servicosModal').on('show.bs.modal', function(event) {
    $('#detalhesModal').modal('toggle');
    var button = $(event.relatedTarget);
    var id = button.data('whatever');
    var result = document.getElementById("showServicos");
    var xmlreq = CriaRequest();
    xmlreq.open("GET", "servicos.php?serv=" + id, true);
    xmlreq.onreadystatechange = function() {
      if (xmlreq.readyState == 4) {
        if (xmlreq.status == 200) {
          result.innerHTML = xmlreq.responseText;
        } else {
          result.innerHTML = "Erro: " + xmlreq.statusText;
        }
      }
    };
    xmlreq.send(null);
    var modal = $(this);

  });

  function voltarModalS() {
    $('#servicosModal').modal('hide');
  }
</script>