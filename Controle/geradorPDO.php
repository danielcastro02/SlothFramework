<?php

class geradorPDO {

    public function criaConexao() {
        $conteudo = "<?php \n"
                . "class conexao { \n"
                . "\n"
                . "public function getConexao(){"
                . "\n"
                . "\$con = new PDO('mysql:host=" . $_POST['host'] . ";dbname=" . $_POST['nome'] . "','" . $_POST['usuario'] . "','" . $_POST['senha'] . "');"
                . "\n return \$con;"
                . "\n"
                . "}"
                . "\n }";
        file_put_contents("./conexao.php", $conteudo);
        
        $con = new PDO("mysql:host=" . $_POST['host'] . ";",  $_POST['usuario'] ,  $_POST['senha']);
        $sql = $con->prepare("create database if not exists ".$_POST['nome']);
        $sql->execute();
        
        header('location: ../index.php?msg=sucesso');
    }

}
