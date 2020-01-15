<?php

include_once __DIR__."/./conexao.php";
include_once __DIR__."/./PDOBase.php";
include_once __DIR__."/../Modelo/Site.php";

class SitePDO extends PDOBase
{
    function inserirSite(){
        $site = new Site($_POST);
        $pdo = conexao::getConexao();
        $stmt = $pdo->prepare("insert into site values (default , :id_cliente , :id_versao , :dominio , :parametros)");
        $stmt->bindValue(":id_cliente" , $site->getIdCliente());
        $stmt->bindValue(":id_versao" , $site->getIdVersao());
        $stmt->bindValue(":dominio" , $site->getDominio());
        $stmt->bindValue(":parametros" , "/Parametros/".$site->getDominio().".json");
        $stmt->execute();
        file_put_contents("../Parametros/".$site->getDominio().".json",file_get_contents("../../".$site->getDominio()."/Modelo/parametros.json"));
        header('location: ../Tela/listagemSite.php');
    }

    function selectSite(){
        $pdo = conexao::getConexao();
        $stmt = $pdo->prepare("select * from site");
        $stmt->execute();
        if($stmt->rowCount()>0){
            return $stmt;
        }else{
            return false;
        }
    }

    function selectSiteIdSite($id_site){
        $pdo = conexao::getConexao();
        $stmt = $pdo->prepare("select * from site where id_site = :id_site");
        $stmt->bindValue(":id_site" , $id_site);
        $stmt->execute();
        if($stmt->rowCount()>0){
            return $stmt;
        }else{
            return false;
        }
    }

}