<?php

include_once __DIR__."/conexao.php";
include_once __DIR__."/../Modelo/Versao.php";

class VersaoPDO extends PDOBase{
    const TEST_VERSION = 0;
    const PROD_VERSION = 1;
    const FIX_VERSION = 2;
    const REPO_PATH = "/Repo/Versions/";
    function inserir(){
        $versao = new Versao($_POST);
        $pdo = conexao::getConexao();
        $stmt = $pdo->prepare("insert into versao values (default, :id_projeto , :nome_versao , :descricao_versao , :nivel , :zip_file);");
        $stmt->bindValue(":id_projeto" , $versao->getIdProjeto());
        $stmt->bindValue(":nome_versao" , $versao->getNomeVersao());
        $stmt->bindValue(":descricao_versao" , $versao->getDescricaoVersao());
        $stmt->bindValue(":nivel" , $versao->getNivel());
        $nome = hash_file('md5', $_FILES['arquivo']['tmp_name']);
        $ext = explode('.', $_FILES['foto']['name']);
        $extensao = "." . $ext[(count($ext) - 1)];
        $extensao = strtolower($extensao);
        move_uploaded_file($_FILES['arquivo']["tmp_name"] , '..'.self::REPO_PATH.$nome.$extensao);
        $stmt->bindValue(':zip_file' , $nome.$extensao);
        $stmt->execute();
        header("location: ../Tela/detalheProjeto.php?id_projeto=".$versao->getIdProjeto());
    }

    function selectId_projeto($id_projeto){
        $pdo = conexao::getConexao();
        $stmt = $pdo->prepare("select * from versao where id_projeto = :id");
        $stmt->bindValue(":id", $id_projeto);
        $stmt->execute();
        return $stmt;
    }

}