<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Kuster Coiffeur</title>
  <link rel="shortcut icon" href="lib/imagens/icon.png">
  <link rel="stylesheet" href="lib\bootstrap-4.4.1-dist\css\bootstrap.min.css">
  <link rel="stylesheet" href="lib\estilos.css">
  <script src="lib/jquery-3.4.1.min.js"></script>
  <script src="https://kit.fontawesome.com/4456f97d4f.js" crossorigin="anonymous"></script>
</head>

<body id="body-log" onload="listarClientes(1)">
  <?php
  $_SESSION['status'] = false;
  ?>

  <div class="wrapper">
    <!-- sidebar -->
    <nav id="sidebar">
      <div class="sidebar-header">
        <h3>Kuster Coiffeur</h3>
      </div>
      <ul class="list-unstyled components">
        <li>
          <a href="content.php?_location=inicio"><i class="fas fa-home"></i> &nbsp; Inicio</a>
        </li>
        <li>
          <a href="content.php?_location=cadastro"><i class="fas fa-pen"></i> &nbsp; Cadastrar Cliente</a>
        </li>
        <li>
          <a href="content.php?_location=listar-clientes"><i class="far fa-address-book"></i> &nbsp; Lista de Clientes</a>
        </li>
        <li>
          <a href="content.php?_location=niver"><i class="fas fa-birthday-cake"></i> &nbsp; Aniversários &nbsp;<span class="badge badge-dark"> <?php contNiverDia(date('d'), date('m')); ?> </span></a>
        </li>
      </ul>
      <ul class="list-unstyled CTAs">
        <li>
          <a href="#" class="gerenciar">Gerenciar</a>
        </li>
        <li>
          <a href="#" class="ajuda">Ajuda</a>
        </li>
      </ul>
    </nav>

    <!-- conteudo da pagina -->
    <div id="content">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">

          <button type="button" id="sidebarCollapse" class="btn btn-info">
            <i class="fas fa-bars"></i>
            <span></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav navbar-nav ml-auto">
              <?php if ($_SESSION["status"] == true) : ?>
                <li class="nav-item">
                  <a class="nav-link" href="content.php?_location=profile">
                    <i id="img-profile" class="fas fa-user-circle"></i>
                  </a>
                </li>
              <?php else : ?>
                <li class="nav-item">
                  <a class="nav-link" href="content.php?_location=login">Entrar</a>
                </li>
              <?php endif; ?>
            </ul>
          </div>

        </div>
      </nav>


      <?php mainContent(); //index -> content -> main-template(mainContent(include)) 
      ?>

    </div>

  </div>

  <!-- <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script> -->
  <script src="lib\bootstrap-4.4.1-dist\js\bootstrap.min.js"></script>
  <script src="lib\malihu-custom-scrollbar-plugin-master\jquery.mCustomScrollbar.concat.min.js"></script>
  <script src="lib\jQuery-Mask-Plugin-master\dist\jquery.mask.min.js"></script>

</body>

</html>
<script type="text/javascript">
  $(document).ready(function() {
    $("#sidebar").mCustomScrollbar({
      theme: "minimal"
    });

    $('#sidebarCollapse').on('click', function() {
      $('#sidebar, #content').toggleClass('active');
      $('.collapse.in').toggleClass('in');
      $('a[aria-expanded=true]').attr('aria-expanded', 'false');
    });
  });
</script>