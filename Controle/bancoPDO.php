<?php

include_once __DIR__.'/../Base/requerLogin.php';
include_once __DIR__.'/../Modelo/Parametros.php';

if (realpath("./index.php") && realpath("./conexao.php")) {
    include_once "./Modelo/Gerador.php";
    include_once "./Controle/conexao.php";
    include_once "./Controle/geradorPDO.php";
} else {
    if (realpath("../index.php") && realpath("../Controle/conexao.php")) {
        include_once "../Modelo/Gerador.php";
        include_once "../Controle/conexao.php";
        include_once "../Controle/geradorPDO.php";
    } else {
        if (realpath("../../index.php") && realpath("../../Controle/conexao.php")) {
            include_once "../../Modelo/Gerador.php";
            include_once "../../Controle/conexao.php";
            include_once "../../Controle/geradorPDO.php";
        } else {
            header('location: ../Tela/criaConexao.php');
        }
    }
}

class bancoPDO {

    function criarTudo() {
        $geradorPDO = new geradorPDO();
        $parametros = new Parametros();
        $pdo = conexao::getCustomConect($parametros->getNomeDb());
        $stmt = $pdo->prepare("show tables");
        $stmt->execute();
        while ($linha = $stmt->fetch()) {
            $stmt2 = $pdo->prepare("show columns from " . $linha[0]);
            $stmt2->execute();
            $semente = new gerador();
            $semente->setNome($linha[0]);
            $atrib = [];
            while ($atributos = $stmt2->fetch()) {
                $atrib[] = $atributos[0];
            }
            $semente->setAtributo($atrib);
            $geradorPDO->geraModelo($semente);
        }
    }

    function criarEspecifico() {
        $nomeTabela = $_POST['nome'];
        $geradorPDO = new geradorPDO();
        $parametros = new Parametros();
        $pdo = conexao::getCustomConect($parametros->getNomeDb());
        $stmt2 = $pdo->prepare("show columns from " . $nomeTabela);
        $stmt2->execute();
        $semente = new gerador();
        $semente->setNome($nomeTabela);
        $atrib = [];
        while ($atributos = $stmt2->fetch()) {
            $atrib[] = $atributos[0];
        }
        $semente->setAtributo($atrib);
        $geradorPDO->geraModelo($semente);
    }
    
    function selectTables(){
        $parametros = new Parametros();
        $pdo = conexao::getCustomConect($parametros->getNomeDb());
        $stmt = $pdo->prepare("show tables");
        $stmt->execute();
        return $stmt;
    }
    
    function selectColunas($tabela){
        $parametros = new Parametros();
        $pdo = conexao::getCustomConect($parametros->getNomeDb());
        $stmt = $pdo->prepare("show columns from " . $tabela);
        $stmt->execute();
        return $stmt;
    }
    
}
