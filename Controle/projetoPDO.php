<?php

include_once __DIR__ . "/PDOBase.php";
include_once __DIR__ . "/conexao.php";
include_once __DIR__ . "/../Modelo/Projeto.php";

class ProjetoPDO extends PDOBase
{

    function inserir()
    {
        $projeto = new Projeto($_POST);
        $pdo = conexao::getConexao();
        $stmt = $pdo->prepare("insert into projeto values (default , :nome_projeto , :descricao)");
        $stmt->bindValue(":nome_projeto", $projeto->getNomeProjeto());
        $stmt->bindValue(":descricao", $projeto->getDescricaoProjeto());
        $stmt->execute();
        header('location: ../Tela/listagemProjeto.php');
    }

    function selectAll(): PDOStatement
    {
        $pdo = conexao::getConexao();
        $stmt = $pdo->prepare("select * from projeto");
        $stmt->execute();
        return $stmt;
    }

    function selectId_projeto($id){
        $pdo = conexao::getConexao();
        $stmt = $pdo->prepare("select * from projeto where id_projeto = :id");
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        return new Projeto($stmt->fetch());
    }

    function editar(){
        $projeto = new Projeto($_POST);
        $pdo = conexao::getConexao();
        $stmt = $pdo->prepare("update projeto set nome_projeto = :nome_projeto , descricao_projeto = :descricao where id_projeto = :id_projeto");
        $stmt->bindValue(":nome_projeto", $projeto->getNomeProjeto());
        $stmt->bindValue(":descricao", $projeto->getDescricaoProjeto());
        $stmt->bindValue(":id_projeto", $projeto->getIdProjeto());
        $stmt->execute();
        header('location: ../Tela/listagemProjeto.php');
    }

}