<?php

include_once '../Modelo/Gerador.php';

try {
    include_once './conexao.php';
} catch (Exception $ex) {
    
}

class geradorPDO {

    public function criaConexao() {
        $conteudo = "<?php \n
                class conexao { \n
                \n
                public function getConexao(){\n
                \n
                    \$con = new PDO('mysql:host=" . $_POST['host'] . ";dbname=" . $_POST['nome'] . "','" . $_POST['usuario'] . "','" . $_POST['senha'] . "');\n
                     return \$con;\n
                \n
                    }\n
                }";
        file_put_contents("./conexao.php", $conteudo);

        $con = new PDO("mysql:host=" . $_POST['host'] . ";", $_POST['usuario'], $_POST['senha']);
        $sql = $con->prepare("create database if not exists " . $_POST['nome']);
        $sql->execute();

        header('location: ../index.php?msg=sucesso');
    }

    public function gerarTabela() {

        $semente = new gerador($_POST);
        $con = new conexao();
        $pdo = $con->getConexao();
        $att = $semente->getAtributo();
        $tipos = $semente->getTipo();
        $regras = $semente->getRegra();
        $preSql = "create table if not exists ".$semente->getNome()." (\n";
        $q = (count($att)-1);
        for ($i = 0; $i < (count($att) - 1); $i++) {
            $preSql = $preSql .  $att[$i] . " " . $tipos[$i] . " " . $regras[$i] . " ,\n";
        }
        $preSql = $preSql .  $att[$q] . " " . $tipos[$q] . " " . $regras[$q] . "\n);";

        $sql = $pdo->prepare($preSql);

        echo $preSql;
        if ($sql->execute()) {



            $conteudo = "<?php \n"
                    . "\n"
                    . "class " . $semente->getNome() . "{\n\n";

            for ($i = 0; $i < count($att); $i++) {
                $conteudo = $conteudo . "private \$" . $att[$i] . ";\n";
            }
            $conteudo = $conteudo . "\n\n"
                    . "public function __construct() {
    if (func_num_args() != 0) {
        \$atributos = func_get_args()[0];
        foreach (\$atributos as \$atributo => \$valor) {
                if (isset(\$valor)) {
                    \$this->\$atributo = \$valor;
                }
            }
        }
    }

    function atualizar(\$vetor) {
        foreach (\$vetor as \$atributo => \$valor) {
            if (isset(\$valor)) {
                \$this->\$atributo = \$valor;
            }
        }
    }"
                    . "\n\n";
            for ($i = 0; $i < count($att); $i++) {
                $conteudo = $conteudo . "     public function get" . ucfirst($att[$i]) . "(){\n"
                        . "         return \$this->" . $att[$i] . ";\n"
                        . "     }\n\n"
                        . "     function set" . ucfirst($att[$i]) . "($" . $att[$i] . "){\n"
                        . "          \$this->" . $att[$i] . " = $" . $att[$i] . ";\n"
                        . "     }\n\n"
                        ;
            }
            $conteudo = $conteudo. "}";
            
            file_put_contents("../Modelo/". ucfirst($semente->getNome()).".php", $conteudo);
            
        }else{
        }
    }

}
