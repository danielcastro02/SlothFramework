<?php
include_once __DIR__ . '/../Base/requerLogin.php';
include_once __DIR__ . "/../Modelo/Gerador.php";
include_once __DIR__ . "/../Controle/conexao.php";
include_once __DIR__ . "/../Controle/interfacesPDO.php";

class geradorPDO
{

    public function criaConexao()
    {
        $conteudo = "<?php
class conexao {
    private static \$con;
    public static function getConexao(): PDO {
        \$parametros = new Parametros();
        try{
            if (is_null(selff::\$con)) {
                self::\$con = new PDO('mysql:host=localhost; dbname='\$parametros->getNomeDb(), \$parametros->getNomeDb(), '', array(PDO::MYSQ_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
            }
            return self::\$con;
        } catch (Exception $\e) {
            echo 'FALHA GERAL CONTATE O SUPORTE contato@markeyvip.com';
            exit(0);
        }
    }
    public static function getTransactConnetion(): PDO {
        \$parametros = new Parametros();
        try {
            return new PDO('mysql:host=localhost;dbname='.\$parametros->getNomeDb(), \$parametros->getNomeDb(), '', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
        } catch (Exception \$e) {
            echo 'FALHA GERAL CONTATE O SUPORTE contato@markeyvip.com';
            exit(0);
        }
    }
}
    ";
        $parametros = new Parametros();
        file_put_contents(__DIR__."/../".$parametros->getDestino()."Controle/conexao.php", $conteudo);

        $con = new PDO("mysql:host=" . $_POST['host'] . ";", $_POST['usuario'], $_POST['senha']);
        $sql = $con->prepare("create database if not exists " . $_POST['nome']);
        $sql->execute();

        header('location: ../Tela/home.php?msg=sucesso');
    }

    public function gerarTabela()
    {
        $parametros = new Parametros();
        $semente = new gerador($_POST);
        $pdo = conexao::getCustomConect($parametros->getNomeDb());
        $att = $semente->getAtributo();
        $tipos = $semente->getTipo();
        $regras = $semente->getRegra();
        $preSql = "create table if not exists " . $semente->getNome() . " (\n";
        $q = (count($att) - 1);
        for ($i = 0; $i < $q; $i++) {
            $preSql = $preSql . $att[$i] . " " . $tipos[$i] . " " . $regras[$i] . " ,\n";
        }
        $preSql = $preSql . $att[$q] . " " . $tipos[$q] . " " . $regras[$q] . "\n);";

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
                    . "     }\n\n";
            }
            $conteudo = $conteudo . "}";

            file_put_contents("../Modelo/" . ucfirst($semente->getNome()) . ".php", $conteudo);
            $this->gerarPDO($semente);
        } else {
            header('location: ../Tela/home.php?msg=ERRO');
        }
    }

    public function geraModelo(gerador $semente)
    {
        $att = $semente->getAtributo();
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
                . "     }\n\n";
        }
        $conteudo = $conteudo . "}";
        $parametros = new Parametros();
        file_put_contents(__DIR__ . "/../" . $parametros->getDestino() . "/Modelo/" . ucfirst($semente->getNome()) . ".php", $conteudo);
        $interfacePDO = new interfacesPDO();
        if (!realpath("../Base/navBar.php")) {
            $interfacePDO->criarNavBar();
            $interfacePDO->adicionaObjetoNav($semente);
        } else {
            $interfacePDO->adicionaObjetoNav($semente);
        }
        $this->gerarPDO($semente);
    }

    function geraEsqueleto(){
        $parametros = new Parametros();
        mkdir(__DIR__."/../".$parametros->getDestino()."Base" , 0777 , true);
        mkdir(__DIR__."/../".$parametros->getDestino()."Controle" , 0777 , true);
        mkdir(__DIR__."/../".$parametros->getDestino()."css" , 0777 , true);
        mkdir(__DIR__."/../".$parametros->getDestino()."fonts" , 0777 , true);
        mkdir(__DIR__."/../".$parametros->getDestino()."Img" , 0777 , true);
        mkdir(__DIR__."/../".$parametros->getDestino()."js" , 0777 , true);
        mkdir(__DIR__."/../".$parametros->getDestino()."Modelo" , 0777 , true);
        mkdir(__DIR__."/../".$parametros->getDestino()."Tela" , 0777 , true);
        mkdir(__DIR__."/../".$parametros->getDestino()."Tela" , 0777 , true);
        copy(__DIR__."/../Moldes/PDOBase.php" , __DIR__."/../".$parametros->getDestino()."Controle/PDOBase.php");
        copy(__DIR__."/../composer.phar" , __DIR__."/../".$parametros->getDestino()."/composer.phar");
        copy(__DIR__."/../composer.json" , __DIR__."/../".$parametros->getDestino()."/composer.json");
        $this->copyr(__DIR__."/../fonts" , __DIR__."/../".$parametros->getDestino()."fonts");
        $this->copyr(__DIR__."/../css" , __DIR__."/../".$parametros->getDestino()."css");
        $this->copyr(__DIR__."/../js" , __DIR__."/../".$parametros->getDestino()."js");
    }

    function copyr($source, $dest)
    {
        // COPIA UM ARQUIVO
        if (is_file($source)) {
            return copy($source, $dest);
        }

        // CRIA O DIRETÓRIO DE DESTINO
        if (!is_dir($dest)) {
            mkdir($dest);
            echo "DIRET&Oacute;RIO $dest CRIADO<br />";
        }

        // FAZ LOOP DENTRO DA PASTA
        $dir = dir($source);
        while (false !== $entry = $dir->read()) {
            // PULA "." e ".."
            if ($entry == '.' || $entry == '..') {
                continue;
            }

            // COPIA TUDO DENTRO DOS DIRETÓRIOS
            if ($dest !== "$source/$entry") {
                copyr("$source/$entry", "$dest/$entry");
                echo "COPIANDO $entry de $source para $dest <br />";
            }
        }

        $dir->close();
        return true;

    }
    public function gerarPDO(gerador $semente)
    {
        $parametros = new Parametros();
        $nome = ucfirst($semente->getNome());
        $nomeNormal = $semente->getNome();
        $atributos = $semente->getAtributo();
        $conteudo = "<?php

    include_once __DIR__ . '/Controle/conexao.php';
    include_once __DIR__ . '/Modelo/" . $nome . ".php';
    include_once __DIR__ . '/PDOBase.php';

class " . $nome . "PDO extends PDOBase{
    /*inserir*/
    function inserir" . $nome . "() {
        \$" . $nomeNormal . " = new " . $nomeNormal . "(\$_POST);
        \$pdo = \$conexao::getConexao();
        \$stmt = \$pdo->prepare('insert into " . $nomeNormal . " values(";

        $buscaRegra = explode(" ", $semente->getRegra()[0]);
        $verificaDefault = false;
        if (in_array("auto_increment", $buscaRegra) || in_array("AUTO_INCREMENT", $buscaRegra)) {
            $conteudo = $conteudo . "default , ";
            $verificaDefault = true;
        } else {
            $conteudo = $conteudo . ":" . $semente->getAtributo()[0] . " , ";
        }

        for ($i = 1; $i < (count($atributos) - 1); $i++) {
            $conteudo = $conteudo . ":" . $atributos[$i] . " , ";
        }
        $conteudo = $conteudo . ":" . $atributos[$i] . ");' ";
        $conteudo = $conteudo . ");\n";
        if ($verificaDefault) {
            for ($i = 1; $i < count($atributos); $i++) {
                $conteudo = $conteudo . "
        \$stmt->bindValue(':" . $atributos[$i] . "', \$" . $nomeNormal . "->get" . ucfirst($atributos[$i]) . "());    
        ";
            }
        } else {
            for ($i = 0; $i < count($atributos); $i++) {
                $conteudo = $conteudo . "
        \$stmt->bindValue(':" . $atributos[$i] . "', \$" . $nomeNormal . "->get" . ucfirst($atributos[$i]) . "());    
        ";
            }
        }

        $conteudo = $conteudo . "
        if(\$stmt->execute()){ 
            header('location: ../index.php?msg=" . $nomeNormal . "Inserido');
        }else{
            header('location: ../index.php?msg=" . $nomeNormal . "ErroInsert');
        }
    }
    /*inserir*/
    
";
        $parametros = new Parametros();
        file_put_contents(__DIR__ . "/../" . $parametros->getDestino() . "/Controle/" . $nomeNormal . "PDO.php", $conteudo);

        $conteudo = "
            
";

        $conteudo = $conteudo . "
    public function select" . $nome . "(){
        \$pdo = conexao::getConexao();
        \$stmt = \$pdo->prepare('select * from " . $nomeNormal . " ;');
        \$stmt->execute();
        if (\$stmt->rowCount() > 0) {
            return \$stmt;
        } else {
            return false;
        }
    }
    
";
        file_put_contents(__DIR__ . "/../" . $parametros->getDestino() . "/Controle/" . $nomeNormal . "PDO.php", $conteudo, FILE_APPEND);

        for ($i = 0; $i < count($atributos); $i++) {

            $conteudo = "
                    
    public function select" . $nome . ucfirst($atributos[$i]) . "(\$" . $atributos[$i] . "){
            
        \$pdo = conexao::getConexao();
        \$stmt = \$pdo->prepare('select * from " . $nomeNormal . " where " . $atributos[$i] . " = :" . $atributos[$i] . ";');
        \$stmt->bindValue(':" . $atributos[$i] . "', \$" . $atributos[$i] . ");
        \$stmt->execute();
        if (\$stmt->rowCount() > 0) {
            return \$stmt;
        } else {
            return false;
        }
    }
    
";
            file_put_contents("./" . $nomeNormal . "PDO.php", $conteudo, FILE_APPEND);
        }


        $conteudo = " 
    public function update" . $nome . "(" . $nome . " $" . $nomeNormal . "){        
         \$pdo = conexao::getConexao();
        \$stmt = \$pdo->prepare('update " . $nomeNormal . " set ";
        for ($i = 1; $i < (count($atributos) - 1); $i++) {
            $conteudo = $conteudo . $atributos[$i] . " = :" . $atributos[$i] . " , ";
        }
        $conteudo = $conteudo . $atributos[$i] . " = :" . $atributos[$i];

        $conteudo = $conteudo . " where " . $atributos[0] . " = :" . $atributos[0] . ";');";

        for ($i = 1; $i < count($atributos); $i++) {
            $conteudo = $conteudo . "
        \$stmt->bindValue(':" . $atributos[$i] . "', \$" . $nomeNormal . "->get" . ucfirst($atributos[$i]) . "());
        ";
        }

        $conteudo = $conteudo . "
        \$stmt->bindValue(':" . $atributos[0] . "', \$" . $nomeNormal . "->get" . ucfirst($atributos[0]) . "());
        ";

        $conteudo = $conteudo . "\$stmt->execute();
        return \$stmt->rowCount();
    }            ";

        file_put_contents(__DIR__ . "/../" . $parametros->getDestino() . "/Controle/" . $nomeNormal . "PDO.php", $conteudo, FILE_APPEND);
        $conteudo = "
    
    public function delete" . $nome . "(\$definir){
         \$pdo = conexao::getConexao();
        \$stmt = \$pdo->prepare('delete from " . $nomeNormal . " where " . $atributos[0] . " = :definir ;');
        \$stmt->bindValue(':definir', \$definir);
        \$stmt->execute();
        return \$stmt->rowCount();
    }
    
    public function deletar(){
        //\$this->delete$nome(\$_GET['id']);
        header('location: ../Tela/listar$nome.php');
    }


/*chave*/}
";
        if (file_put_contents(__DIR__ . "/../" . $parametros->getDestino() . "/Controle/" . $nomeNormal . "PDO.php", $conteudo, FILE_APPEND)) {
            $this->criaControle($semente);
        } else {
            header('location: ../Tela/home.php?msg=erroCriaPDO');
        }
    }

    public function criaControle(gerador $semente)
    {
        $conteudo = "<?php

include_once __DIR__ . '/Controle/" . $semente->getNome() . "PDO.php';

\$classe = new " . $semente->getNome() . "PDO();

if (isset(\$_GET['function'])) {
    \$metodo = \$_GET['function'];
    \$classe->\$metodo();
}

";
        $parametros = new Parametros();
        if (file_put_contents(__DIR__ . "/../" . $parametros->getDestino() . "/Controle/" . $semente->getNome() . "Controle.php", $conteudo)) {
            header('location: ../Tela/home.php?msg=ok');
        } else {
            header('location: ../Tela/home.php?msg=erroCriaControle');
        }
    }

}
