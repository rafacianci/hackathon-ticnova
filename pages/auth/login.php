<?php
require_once '../../config.php';
require_once '../../query.php';

if ($_POST) {
    $idAluno = (isset($_POST['login'])) ? $_POST['login'] : null;
    $senha = (isset($_POST['senha'])) ? $_POST['senha'] : null;

    Query::login($idAluno, md5($senha));
}
?>

<div class="col-lg-4 col-lg-offset-4">
    <div class="login-panel panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Login</h3>
        </div>
        <div class="panel-body">
            <form id="frmLogin" role="form">
                <fieldset>
                    <div class="form-group">
                        <input id="login" class="form-control" placeholder="login" name="login" type="email" autofocus>
                    </div>
                    <div class="form-group">
                        <input id="senha" class="form-control" placeholder="senha" name="senha" type="password">
                    </div>
                    <!-- Change this to a button or input when using this as a form -->
                    <input type="submit" class="btn btn-lg btn-success btn-block" value="Login" />
                    <!--<a href="#" class="btn btn-lg btn-primary btn-block">Cadastre-se</a>-->
                </fieldset>
            </form>
        </div>
    </div>
</div>
<script src="js/auth/auth.js"></script>