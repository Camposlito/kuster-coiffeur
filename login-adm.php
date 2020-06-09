<div id="login">
    <div class="container">
        <div id="login-row" class="row justify-content-center align-items-center">
            <div id="login-column" class="col-md-6">
                <div id="login-box" class="col-md-12">
                    <form id="login-form" class="form needs-validation" novalidate action="conectar-adm.php" method="post">
                        <h3 class="text-center text-info">Conecte-se</h3>
                        <div class="form-group">
                            <label for="username" class="text-info">E-mail:</label><br>
                            <input type="text" name="username" id="username" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="password" class="text-info">Senha:</label><br>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <br>
                            <input type="submit" name="submit" class="btn btn-info btn-md" value="Entrar">
                        </div>
                        <div id="register-link" class="text-right">
                            <a href="#" onclick="registrar()" class="text-info">Registre-se</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="register">
    <div class="container">
        <div id="register-row" class="row justify-content-center align-items-center">
            <div id="register-column" class="col-md-6">
                <div id="register-box" class="col-md-12">
                    <form id="register-form" class="form needs-validation" novalidate action="cadastrar-adm.php" method="post">
                        <h3 class="text-center text-info">Registre-se</h3>
                        <div class="form-group">
                            <label for="username" class="text-info">Nome:</label><br>
                            <input type="text" name="username" id="username" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="username" class="text-info">E-mail:</label><br>
                            <input type="text" name="username" id="username" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="username" class="text-info">CPF:</label><br>
                            <input type="text" name="username" id="username" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="password" class="text-info">Senha:</label><br>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <br>
                            <input type="submit" name="submit" class="btn btn-info btn-md" value="Cadastrar">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    ini();

    function ini() {
        $('#register').hide();
        $('#login').show();
    }

    function registrar() {
        $('#register').show();
        $('#login').hide();
    }

    (function() {
        'use strict';
        window.addEventListener('load', function() {
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
        }, false);
    })();
</script>