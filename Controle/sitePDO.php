<?php

include_once __DIR__ . "/./conexao.php";
include_once __DIR__ . "/./versaoPDO.php";
include_once __DIR__ . "/./PDOBase.php";
include_once __DIR__ . "/../Modelo/Site.php";
include_once __DIR__ . "/../Modelo/Versao.php";

class SitePDO extends PDOBase
{
    function inserirSite()
    {
        $site = new Site($_POST);
        $pdo = conexao::getConexao();
        $stmt = $pdo->prepare("insert into site values (default , :id_cliente , :id_versao , :dominio , :parametros)");
        $stmt->bindValue(":id_cliente", $site->getIdCliente());
        $stmt->bindValue(":id_versao", $site->getIdVersao());
        $stmt->bindValue(":dominio", $site->getDominio());
        $stmt->bindValue(":parametros", "/Parametros/" . $site->getDominio() . ".json");
        $stmt->execute();
        if(realpath("../../".$site->getDominio()."/index.php")) {
            file_put_contents("../Parametros/" . $site->getDominio() . ".json", file_get_contents("../../" . $site->getDominio() . "/Modelo/parametros.json"));
        }else{
            $this->newDomain($site);
        }

        header('location: ../Tela/listagemSite.php');
    }

    function newDomain(Site $site){
        if(!realpath("../../".$site->getDominio())) {
            mkdir("../../" . $site->getDominio());
        }
        $versaoPDO = new VersaoPDO();
        $versao = $versaoPDO->selectId_versao($site->getIdVersao());
        $versao = new Versao($versao->fetch());
        $nomeDB = explode("." , $site->getDominio());
        $anterior = clone $versao;
        while($anterior->getFullSql()==""){
            $anterior = $versaoPDO->selectId_versao($versao->getIdAnterior());
            $anterior = new Versao($anterior->fetch());
        }
        $fullSQL = file_get_contents(".." . VersaoPDO::REPO_PATH . $anterior->getFullSql());
        $fullSQL = explode(";" , $fullSQL);
        $pdo = conexao::getCustomConect($nomeDB[0]);
        foreach ($fullSQL as $command){
            $stmt = $pdo->prepare($command);
            $stmt->execute();
        }
        if($anterior->getIdVersao()!=$versao->getIdVersao()){
            $nextVersion = $versaoPDO->getNextVersion($versao->getIdProjeto(), $versao->getIdVersao());
            while ($nextVersion) {
                $proxima = new Versao($nextVersion->fetch());
                if($proxima->getIdVersao()>$versao->getIdVersao()){
                    break;
                }else {
                    $sql = file_get_contents(VersaoPDO::REPO_PATH . $proxima->getUpdateSql());
                    $sqlArr = explode(";", $sql);
                    $nomeDb = explode(".", $site->getDominio());

                    $pdo = conexao::getCustomConect($nomeDb[0]);
                    foreach ($sqlArr as $command) {
                        $stmt = $pdo->prepare($command);
                        $stmt->execute();
                    }
                    $nextVersion = $versaoPDO->getNextVersion($proxima->getIdProjeto(), $proxima->getIdVersao());
                    $this->addToast("Atualizando banco para: " . $proxima->getNomeVersao());
                }
            }
        }
        $zip = new ZipArchive();
        $zip->open(".." . VersaoPDO::REPO_PATH . $versao->getZipFile());
        $zip->extractTo("../../" . $site->getDominio());
        header("location: ../Tela/listagemSite.php");

    }

    function selectSite()
    {
        $pdo = conexao::getConexao();
        $stmt = $pdo->prepare("select * from site");
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }

    function selectSiteIdSite($id_site)
    {
        $pdo = conexao::getConexao();
        $stmt = $pdo->prepare("select * from site where id_site = :id_site");
        $stmt->bindValue(":id_site", $id_site);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }

    function atualizar()
    {
        $site = $this->selectSiteIdSite($_GET['id_site']);
        $site = new Site($site->fetch());
        $versaoPDO = new VersaoPDO();
        $versao = $versaoPDO->selectId_versao($site->getIdVersao());
        $versao = new Versao($versao->fetch());
        $nextVersion = $versaoPDO->getNextVersion($versao->getIdProjeto(), $versao->getIdVersao());
        $proxima = false;
        while ($nextVersion) {
            $proxima = new Versao($nextVersion->fetch());
            if($proxima->getIdVersao()>$_POST['id_versao']){
                break;
            }else {
                $sql = file_get_contents(VersaoPDO::REPO_PATH . $proxima->getUpdateSql());
                $sqlArr = explode(";", $sql);
                $nomeDb = explode(".", $site->getDominio());

                $pdo = conexao::getCustomConect($nomeDb[0]);
                foreach ($sqlArr as $comand) {
                    $pdo->exec($comand);
                }
                $nextVersion = $versaoPDO->getNextVersion($proxima->getIdProjeto(), $proxima->getIdVersao());
                $this->addToast("Atualizando banco para: " . $proxima->getNomeVersao());
            }
        }
        $this->addToast("Versão final: " . $proxima->getNomeVersao());
        if ($proxima) {
            $zip = new ZipArchive();
            $zip->open(".." . VersaoPDO::REPO_PATH . $proxima->getZipFile());
            $zip->extractTo("../../" . $site->getDominio());
        }
        header("location: ../Tela/detalheSite.php?id_site=".$site->getIdVersao());
    }

}