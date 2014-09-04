<?php
require_once '../../config.php';
require_once '../../query.php';

if ($_POST) {
    if(isset($_POST['nome'])){
        $nome = (isset($_POST['nome'])) ? $_POST['nome'] : null;        
        $idAluno = (isset($_POST['login'])) ? $_POST['login'] : null;
        $senha = (isset($_POST['senha'])) ? $_POST['senha'] : null;

        Query::cadastrar($nome, $idAluno, md5($senha));        
    }else{
        $idAluno = (isset($_POST['login'])) ? $_POST['login'] : null;
        $senha = (isset($_POST['senha'])) ? $_POST['senha'] : null;

        Query::cadastrar($idAluno, md5($senha));        
    }
}
?>

<div class="col-lg-4 col-lg-offset-4">
    <div class="login-panel panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Login</h3>
        </div>
        <div class="panel-body formulario">
            <form id="frmLogin" role="form">
                <fieldset>
                    <div class="form-group">
                        <input id="login" class="form-control" placeholder="e-mail" name="login" type="email" autofocus required>
                    </div>
                    <div class="form-group">
                        <input id="senha" class="form-control" placeholder="senha" name="senha" type="password" required>
                    </div>
                    <!-- Change this to a button or input when using this as a form -->
                    <a href="#/auth/cadastrar" rel="auth/cadastrar.php" class="cadastrar btn btn-lg btn-primary col-xs-6">Cadastre-se</a>
                    <input type="submit" class="btn btn-lg btn-success col-xs-6" value="Login" />
                </fieldset>
            </form>
            <form id="frmCadastrar" role="form" method="POST">
                <fieldset>
                    <div class="form-group">
                        <input id="nome" class="form-control" placeholder="nome" name="nome" type="text" autofocus required>
                    </div>
                    <div class="form-group">
                        <input id="login" class="form-control" placeholder="e-mail" name="login" type="email" autofocus required>
                    </div>
                    <div class="form-group">
                        <input id="senha" class="form-control" placeholder="senha" name="senha" type="password" required>
                    </div>
                    <!-- Change this to a button or input when using this as a form -->
                    <a href="#/auth/login" rel="auth/login.php" class="cadastrar btn btn-lg btn-primary col-xs-6">Login</a>
                    <input type="submit" class="btn btn-lg btn-success col-xs-6" value="Cadastrar" />
                </fieldset>
            </form>
        </div>
    </div>
</div>
<script src="js/auth/auth.js"></script>