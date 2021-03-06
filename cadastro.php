<div class="container">
  <div class="text-center">
    <h1><i class="fas fa-user-plus"></i></h1>
    <h2>Cadastrar</h2>
  </div>

  <div class="row ">

    <div class="col-md-12 order-md-1">
      <h4 class="mb-3"><i class="fas fa-address-card"></i> Informações do Cliente</h4>
      <form class="needs-validation" id="cadast" novalidate method="post" action="cadastrar.php">
        <div class="row">
          <div class="col-md-12 mb-3">
            <label for="firstName">Nome <span class="text-muted">(Obrigatório)</span></label>
            <input type="text" class="form-control" name="firstName" id="firstName" placeholder="" value="" required>
            <div class="invalid-feedback">
              É necessário um nome válido.
            </div>
          </div>
        </div>

        <div class="mb-3">
          <label for="email">E-mail </label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">@</span>
            </div>
            <input type="email" class="form-control" id="email" name="email" placeholder="nome@exemplo.com">
            <div class="invalid-feedback" style="width: 100%;">
              Digite um endereço de e-mail válido.
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-4 mb-3">
            <label for="celular1">Celular <span class="text-muted">( 1 )</span></label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
              </div>
              <input type="tel" class="form-control celular" id="celular1" name="celular1" placeholder="(00) 0 000-000">
              <div class="invalid-feedback" style="width: 100%;">
                Digite um endereço de celular válido.
              </div>
            </div>
          </div>

          <div class="col-md-4 mb-3">
            <label for="celular2">Celular <span class="text-muted">( 2 )</span></label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
              </div>
              <input type="tel" class="form-control" id="celular2" name="celular2" placeholder="">
              <div class="invalid-feedback" style="width: 100%;">
                Digite um endereço de celular válido.
              </div>
            </div>
          </div>

          <div class="col-md-4 mb-3">
            <label for="telefone">Telefone Fixo</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-phone-alt"></i></span>
              </div>
              <input type="tel" class="form-control telefone" id="telefone" name="telefone" placeholder="(00) 000-000">
              <div class="invalid-feedback" style="width: 100%;">
                Digite um endereço de celular válido.
              </div>
            </div>
          </div>

        </div>

        <hr class="mb-4">
        <div class="row">
          <div class="col-md-12 mb-3">
            <h4 class="mb-3"><i class="fas fa-birthday-cake"></i> Aniversário</h4>
            <div class="row">
              <div class="col-md-4 mb-3">
                <label for="mes">Mês</label>
                <select class="custom-select d-block w-100" id="mes" name="mes">
                  <option value="0">Escolher...</option>
                  <option value="01">(1) Janeiro</option>
                  <option value="02">(2) Fevereiro</option>
                  <option value="03">(3) Março</option>
                  <option value="04">(4) Abril</option>
                  <option value="05">(5) Maio</option>
                  <option value="06">(6) Junho</option>
                  <option value="07">(7) Julho</option>
                  <option value="08">(8) Agosto</option>
                  <option value="09">(9) Stembro</option>
                  <option value="10">(10) Outubro</option>
                  <option value="11">(11) Novembro</option>
                  <option value="12">(12) Dezembro</option>
                </select>
                <div class="invalid-feedback">
                  Selecione um mês válido.
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <label for="dia">Dia</label>
                <input type="text" class="form-control" id="dia" name="dia" value="">
                <div class="invalid-feedback">
                  Digite um dia válido.
                </div>
              </div>
            </div>


          </div>

        </div>

        <hr class="mb-4">
        <div class="row">
          <div class="col-md-12 order-md-1">
            <h4 class="mb-3"><i class="fas fa-cut"></i> Serviço Prestado</h4>
            <div class="row">
              <div class="col-md-6 md-3">
                <label for="data">Data</label>
                <input type="text" class="form-control" id="data" name="data" placeholder="__/__/____" value="">
              </div>
              <div class="col-md-6 md-3">
                <label for="servico">Descrição</label>
                <input type="text" class="form-control" id="servico" name="servico" placeholder="" value="">
              </div>
            </div>

          </div>

        </div>
        <hr class="mb-4">

        <button type="button" class="btn btn-success btn-lg btn-block" data-toggle="modal" data-target="#confirmarModal">Pronto</button>
        
        <!-- modal confirmar cadastro -->
        <div class="modal fade" id="confirmarModal" tabindex="-1" role="dialog" aria-labelledby="confirmarModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="confirmarModalLabel"><i class="fas fa-user-plus"></i> &nbsp; Confirmar</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="container">
                  <div class="row">
                    <h5 class="msg-confirma"></h5>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <button type="button" id="submitButton" class="btn btn-success">Cadastrar</button>
              </div>
            </div>
          </div>
        </div>

      </form>
    </div>
  </div>

</div>

<script>
  // Example starter JavaScript for disabling form submissions if there are invalid fields
  (function() {
    'use strict';

    window.addEventListener('load', function() {
      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      var forms = document.getElementsByClassName('needs-validation');

      // Loop over them and prevent submission
      var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
          if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
          }
          form.classList.add('was-validated');
        }, false);
      });
    }, false);
  })();

  $(document).ready(function() {
    $('.celular').mask('(00) 0 0000-0000');
    $('#data').mask('00/00/0000');
    $('#dia').mask('00');
    $('.telefone').mask('(00) 0000-0000');
  });

  //modal confirmar cadastro
  $('#confirmarModal').on('shown.bs.modal', function(event) {
    var modal = $(this);
    var nome = document.getElementById("firstName").value;
    modal.find('.msg-confirma').text('Deseja confirmar o cadastro do usuário " ' + nome + ' "?');
    document.getElementById("submitButton").type = "submit";
  });

  $('#confirmarModal').on('hide.bs.modal', function(event) {
    var modal = $(this);
    document.getElementById("submitButton").type = "button";
  });

  //confirmar cadastro com a tecla enter
  $('#cadast').keypress(function(event) {
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if (keycode == '13') {
      //chamar modal confirmar cadastro
      $('#confirmarModal').modal('show')
    }
  });

</script>