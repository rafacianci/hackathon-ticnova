<?php

require_once '/db.php';
class Query {

    public static function login($login, $senha) {
        if ((null === $login) or (null === $senha)) {
            throw new Exception('Informe login e senha');
        }
        
        $con = Database::getCon();
        $q = mysqli_query($con, "select * from professor where email = '{$login}' and senha = '{$senha}'");
        $r = mysqli_fetch_array($q);
        
        if (null !== $r) {
             $_SESSION['user'] = array(
                 'id' => $r['idProfessor'],
                 'nome' => $r['nome'],
             );
             
             header('location: /index.php');
        }
    }

}
