<?php

include_once __DIR__ . "/conexao.php";
include_once __DIR__ . "/PDOBase.php";
include_once __DIR__ . "/../Modelo/Versao.php";

class VersaoPDO extends PDOBase
{
    const TEST_VERSION = 0;
    const PROD_VERSION = 1;
    const FIX_VERSION = 2;
    const REPO_PATH = "/Repo/Versions/";

    function inserir()
    {
        $versao = new Versao($_POST);
        $pdo = conexao::getConexao();
        $stmt = $pdo->prepare("insert into versao values (default, :id_projeto ,:id_anterior, :nome_versao, :descricao_versao , :nivel , :zip_file , :update_sql , :full_sql);");
        $stmt->bindValue(":id_projeto", $versao->getIdProjeto());
        $stmt->bindValue(":nome_versao", $versao->getNomeVersao());
        $stmt->bindValue(":descricao_versao", $versao->getDescricaoVersao());
        $stmt->bindValue(":nivel", $versao->getNivel());
        if($versao->getIdAnterior()==0){
            $stmt->bindValue(":id_anterior" , null);
        }else{
            $stmt->bindValue(":id_anterior" , $versao->getIdAnterior());
        }
        $nome = hash_file('md5', $_FILES['arquivo']['tmp_name']);
        $nomesql = hash_file('md5', $_FILES['sql']['tmp_name']);
        $ext = explode('.', $_FILES['arquivo']['name']);
        $extsql = explode('.', $_FILES['sql']['name']);
        $extensao = "." . $ext[(count($ext) - 1)];
        $extensaosql = "." . $extsql[(count($extsql) - 1)];
        $extensao = strtolower($extensao);
        $extensaosql = strtolower($extensaosql);
        move_uploaded_file($_FILES['arquivo']["tmp_name"], '..' . self::REPO_PATH . $nome . $extensao);
        move_uploaded_file($_FILES['sql']["tmp_name"], '..' . self::REPO_PATH . $nomesql . $extensaosql);
        if(isset($_FILES['full_sql'])) {
            $nomefullsql = hash_file('md5', $_FILES['full_sql']['tmp_name']);
            $extfullsql = explode('.', $_FILES['full_sql']['name']);
            $extensaofullsql = "." . $extfullsql[(count($extfullsql) - 1)];
            $extensaofullsql = strtolower($extensaofullsql);
            move_uploaded_file($_FILES['full_sql']["tmp_name"], '..' . self::REPO_PATH . $nomefullsql . $extensaofullsql);
            $stmt->bindValue(':full_sql', $nomefullsql . $extensaofullsql);
        }else{
            $stmt->bindValue(':full_sql', "");
        }
        $stmt->bindValue(':zip_file', $nome . $extensao);
        $stmt->bindValue(':update_sql', $nomesql . $extensaosql);
        $stmt->execute();
        header("location: ../Tela/detalheProjeto.php?id_projeto=" . $versao->getIdProjeto());
    }

    function getUnlinkedVesions($id_projeto){
        $pdo = conexao::getConexao();
        $stmt = $pdo->prepare("select * from versao where id_projeto = :id and id_versao not in(SELECT id_anterior from versao where id_anterior is not null)");
        $stmt->bindValue(":id", $id_projeto);
        $stmt->execute();
        return $stmt;
    }

    function selectId_projeto($id_projeto)
    {
        $pdo = conexao::getConexao();
        $stmt = $pdo->prepare("select * from versao where id_projeto = :id");
        $stmt->bindValue(":id", $id_projeto);
        $stmt->execute();
        return $stmt;
    }

    function getPrevVersion($id_versao){
        $pdo = conexao::getConexao();
        $stmt = $pdo->prepare("select * from versao where id_versao = :id");
        $stmt->bindValue(":id", $id_versao);
        $stmt->execute();
        return $stmt;
    }

    function selectId_versao($id_versao)
    {
        $pdo = conexao::getConexao();
        $stmt = $pdo->prepare("select * from versao where id_versao = :id");
        $stmt->bindValue(":id", $id_versao);
        $stmt->execute();
        return $stmt;
    }

    function editar()
    {
        $versao = new Versao($_POST);
        $oldVersao = new Versao($this->selectId_versao($versao->getIdVersao())->fetch());
        $pdo = conexao::getConexao();
        $stmt = $pdo->prepare("update versao 
                                            set id_projeto = :id_projeto ,nome_versao = :nome_versao ,
                                                descricao_versao = :descricao_versao ,nivel = :nivel , zip_file = :zip_file , update_sql = :update_sql
, full_sql = :full_sql
                                            where id_versao = :id_versao;");
        $stmt->bindValue(":id_projeto", $versao->getIdProjeto());
        $stmt->bindValue(":id_versao", $versao->getIdVersao());
        $stmt->bindValue(":nome_versao", $versao->getNomeVersao());
        $stmt->bindValue(":descricao_versao", $versao->getDescricaoVersao());
        $stmt->bindValue(":nivel", $versao->getNivel());
        $stmt->execute();
        if (isset($_FILES['arquivo'])) {
            unlink(".." . self::REPO_PATH . $oldVersao->getZipFile());
            $nome = hash_file('md5', $_FILES['arquivo']['tmp_name']);
            $ext = explode('.', $_FILES['arquivo']['name']);
            $extensao = "." . $ext[(count($ext) - 1)];
            $extensao = strtolower($extensao);
            move_uploaded_file($_FILES['arquivo']["tmp_name"], '..' . self::REPO_PATH . $nome . $extensao);
            $stmt->bindValue(':zip_file', $nome . $extensao);
        } else {
            $stmt->bindValue(':zip_file', $oldVersao->getZipFile());
        }
        if (isset($_FILES['sql'])) {
            unlink(".." . self::REPO_PATH . $oldVersao->getZipFile());
            $nome = hash_file('md5', $_FILES['sql']['tmp_name']);
            $ext = explode('.', $_FILES['sql']['name']);
            $extensao = "." . $ext[(count($ext) - 1)];
            $extensao = strtolower($extensao);
            move_uploaded_file($_FILES['sql']["tmp_name"], '..' . self::REPO_PATH . $nome . $extensao);
            $stmt->bindValue(':update_sql', $nome . $extensao);
        } else {
            $stmt->bindValue(':update_sql', $oldVersao->getUpdateSql());
        }
        if (isset($_FILES['full_sql'])) {
            unlink(".." . self::REPO_PATH . $oldVersao->getZipFile());
            $nome = hash_file('md5', $_FILES['full_sql']['tmp_name']);
            $ext = explode('.', $_FILES['full_sql']['name']);
            $extensao = "." . $ext[(count($ext) - 1)];
            $extensao = strtolower($extensao);
            move_uploaded_file($_FILES['full_sql']["tmp_name"], '..' . self::REPO_PATH . $nome . $extensao);
            $stmt->bindValue(':full_sql', $nome . $extensao);
        } else {
            $stmt->bindValue(':full_sql', $oldVersao->getFullSql());
        }
        header("location: ../Tela/detalheProjeto.php?id_projeto=" . $versao->getIdProjeto());
    }

    function excluir(){
        $this->requerLogin();
        $versao = new Versao($this->selectId_versao($_GET['id_versao'])->fetch());
        $pdo = conexao::getConexao();
        $stmt = $pdo->prepare("delete from versao where id_versao = :id_versao;");
        $stmt->bindValue(':id_versao' , $_GET['id_versao']);
        $stmt->execute();
        if($stmt->rowCount()==0){
            $this->addToast("Não é possível excluir!");
        }else{
            unlink("..".self::REPO_PATH.$versao->getZipFile());
            $this->addToast("Exluido!");
        }
        header("location: ../Tela/detalhesProjeto.php?id_projeto=".$versao->getIdProjeto());
    }

    function selectNextVersions($id_projeto , $id_versao){
        $pdo = conexao::getConexao();
        $stmt = $pdo->prepare("select * from versao where id_versao > :id and id_projeto = :id_projeto");
        $stmt->bindValue(":id", $id_versao);
        $stmt->bindValue(":id_projeto", $id_projeto);
        $stmt->execute();
        if($stmt->rowCount()>0) {
            return $stmt;
        }else{
            return false;
        }
    }

    function getNextVersion($id_projeto , $id_versao){
        $pdo = conexao::getConexao();
        $stmt = $pdo->prepare("select * from versao where id_anterior = :id and id_projeto = :id_projeto");
        $stmt->bindValue(":id", $id_versao);
        $stmt->bindValue(":id_projeto", $id_projeto);
        $stmt->execute();
        if($stmt->rowCount()>0) {
            return $stmt;
        }else{
            return false;
        }
    }

}