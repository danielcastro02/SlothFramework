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
        $stmt = $pdo->prepare("insert into site values (default , :id_cliente , :id_versao , :dominio , :parametros , :nomedb)");
        $stmt->bindValue(":id_cliente", $site->getIdCliente());
        $stmt->bindValue(":id_versao", $site->getIdVersao());
        $stmt->bindValue(":dominio", $site->getDominio());
        $stmt->bindValue(":parametros", "/Parametros/" . $site->getDominio() . ".json");
        $stmt->bindValue(":nomedb", $site->getNomeDb());
        $stmt->execute();
        if (realpath("../../" . $site->getDominio() . "/Modelo/parametros.json")) {
            file_put_contents("../Parametros/" . $site->getDominio() . ".json", file_get_contents("../../" . $site->getDominio() . "/Modelo/parametros.json"));
        } else {
            if (!realpath("../../" . $site->getDominio() . "/index.php")) {
                $this->newDomain($site);
            }
        }
        header('location: ../Tela/listagemSite.php');
    }

    function newDomain(Site $site)
    {
        if (!realpath("../../" . $site->getDominio())) {
            mkdir("../../" . $site->getDominio());
        }
        $versaoPDO = new VersaoPDO();
        $versao = $versaoPDO->selectId_versao($site->getIdVersao());
        $versao = new Versao($versao->fetch());
        $nomeDB = $site->getNomeDb();
        $anterior = clone $versao;
        while ($anterior->getFullSql() == "") {
            $anterior = $versaoPDO->selectId_versao($versao->getIdAnterior());
            $anterior = new Versao($anterior->fetch());
        }
        $fullSQL = file_get_contents(".." . VersaoPDO::REPO_PATH . $anterior->getFullSql());
        $fullSQL = explode(";", $fullSQL);
        $pdo = conexao::getCustomConect($nomeDB);
        foreach ($fullSQL as $command) {
            $stmt = $pdo->prepare($command);
            $stmt->execute();
        }
        if ($anterior->getIdVersao() != $versao->getIdVersao()) {
            $nextVersion = $versaoPDO->getNextVersion($versao->getIdProjeto(), $versao->getIdVersao());
            while ($nextVersion) {
                $proxima = new Versao($nextVersion->fetch());
                if ($proxima->getIdVersao() > $versao->getIdVersao()) {
                    break;
                } else {
                    $sql = file_get_contents(VersaoPDO::REPO_PATH . $proxima->getUpdateSql());
                    $sqlArr = explode(";", $sql);
                    $nomeDb = explode(".", $site->getDominio());

                    $pdo = conexao::getCustomConect($nomeDb);
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
        file_put_contents("../../".$site->getDominio()."/Modelo/parametros.json" , json_encode(array("nome_db" => $site->getNomeDb())));
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


    function selectSiteIdCliente($id_cliente)
    {
        $pdo = conexao::getConexao();
        $stmt = $pdo->prepare("select * from site where id_cliente = :id_cliente");
        $stmt->bindValue(":id_cliente", $id_cliente);
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
            if ($proxima->getIdVersao() > $_POST['id_versao']) {
                break;
            } else {
                if ($proxima->getUpdateSql() != ".") {
                    $sql = file_get_contents(".." . VersaoPDO::REPO_PATH . $proxima->getUpdateSql());
                    $sqlArr = explode(";", $sql);
                    if($site->getNomeDb() == "" || $site->getNomeDb() == null) {
                        if (realpath("../../" . $site->getDominio() . "/Modelo/parametros.json")) {
                            $parametros = json_decode(file_get_contents("../../" . $site->getDominio() . "/Modelo/parametros.json"), true);
                            $nomeDb = $parametros['nome_db'];
                            $pdo = conexao::getCustomConect($nomeDb);
                            $this->addToast("Banco selecionado: " . $nomeDb);
                        } else {
                            $nomeDb = explode(".", $site->getDominio());
                            $pdo = conexao::getCustomConect($nomeDb[0]);
                            $this->addToast("Banco selecionado: " . $nomeDb[0]);
                        }
                    }else{
                        $nomeDb = $site->getNomeDb();
                        $pdo = conexao::getCustomConect($nomeDb);
                        $this->addToast("Banco selecionado: " . $nomeDb);
                    }
                    foreach ($sqlArr as $comand) {
                        $this->log("Comando de atualização: " . $comand);
                        $pdo->exec($comand);
                    }
                }
                $nextVersion = $versaoPDO->getNextVersion($proxima->getIdProjeto(), $proxima->getIdVersao());
                $this->addToast("Atualizando banco para: " . $proxima->getNomeVersao());
                $this->addToast("Versão final: " . $proxima->getNomeVersao());
                $zip = new ZipArchive();
                $zip->open(".." . VersaoPDO::REPO_PATH . $proxima->getZipFile());
                $zip->extractTo("../../" . $site->getDominio());
            }
        }
        if ($proxima) {
            $this->addToast("Versão final: " . $proxima->getNomeVersao());
            $zip = new ZipArchive();
            $zip->open(".." . VersaoPDO::REPO_PATH . $proxima->getZipFile());
            $zip->extractTo("../../" . $site->getDominio());
        }
        if (realpath("../Parametros/" . $site->getDominio() . ".json")) {
            file_put_contents("../../" . $site->getDominio() . "/Modelo/parametros.json", file_get_contents("../Parametros/" . $site->getDominio() . ".json"));
        }
        $pdo = conexao::getConexao();
        $stmt = $pdo->prepare("update site set id_versao = :id_versao where id_site = :id_site");
        $stmt->bindValue(":id_versao", $proxima->getIdVersao());
        $stmt->bindValue(":id_site", $site->getIdSite());
        $stmt->execute();
        header("location: ../Tela/detalheSite.php?id_site=" . $site->getIdSite());
    }

    function excluir(){
        $this->requerLogin();
        $pdo = conexao::getConexao();
        $stmt = $pdo->prepare("delete from site where id_site = :id_site");
        $stmt->bindValue(":id_site" , $_GET['id_site']);
        $stmt->execute();
        header('location: ../Tela/listagemSite.php');
    }

}