<?php

if (realpath('./index.php')) {
    include_once './Controle/conexao.php';
    include_once './Modelo/Aplicativo.php';
} else {
    if (realpath('../index.php')) {
        include_once '../Controle/conexao.php';
        include_once '../Modelo/Aplicativo.php';
    } else {
        if (realpath('../../index.php')) {
            include_once '../../Controle/conexao.php';
            include_once '../../Modelo/Aplicativo.php';
        }
    }
}

class AplicativoPDO {

    const REPO_KEYS = "/Repo/Chaves/";
    const REPO_VERSION = "/Repo/Versions/";
    const REPO_FIREBASE = "/Repo/Firebase/";
    /* inserir */

    function inserirAplicativo() {
        $aplicativo = new Aplicativo($_POST);
        print_r($aplicativo);
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('insert into aplicativo values(default , :cliente, :id_versao, :id_site, :nome_pacote , :chave , :arquivo_firebase);');

        $stmt->bindValue(':cliente', $aplicativo->getIdCliente());
        $stmt->bindValue(':id_versao', $aplicativo->getIdVersao());
        $stmt->bindValue(':id_site', $aplicativo->getIdSite());
        $stmt->bindValue(':nome_pacote', $aplicativo->getNomePacote());

        $nome = hash_file('md5', $_FILES['chave']['tmp_name']);
        $ext = explode('.', $_FILES['chave']['name']);
        $extensao = "." . $ext[(count($ext) - 1)];
        $extensao = strtolower($extensao);
        move_uploaded_file($_FILES['chave']["tmp_name"], '..' . self::REPO_KEYS . $nome . $extensao);
        $stmt->bindValue(':chave', $nome . $extensao);


        $nome = hash_file('md5', $_FILES['arquivo_firebase']['tmp_name']);
        $ext = explode('.', $_FILES['arquivo_firebase']['name']);
        $extensao = "." . $ext[(count($ext) - 1)];
        $extensao = strtolower($extensao);
        move_uploaded_file($_FILES['arquivo_firebase']["tmp_name"], '..' . self::REPO_FIREBASE . $nome . $extensao);
        $stmt->bindValue(':arquivo_firebase', $nome . $extensao);

        $stmt->execute();
//            header('location: ../Tela/home.php?msg=aplicativoInserido');
//        } else {
//            header('location: ../Tela/home.php?msg=aplicativoErroInsert');
//        }
    }

    /* inserir */

    public function selectAplicativo() {

        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from aplicativo ;');
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }

    public function selectAplicativoId_aplicativo($id_aplicativo) {

        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from aplicativo where id_aplicativo = :id_aplicativo;');
        $stmt->bindValue(':id_aplicativo', $id_aplicativo);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }

    public function selectAplicativoCliente($cliente) {

        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from aplicativo where cliente = :cliente;');
        $stmt->bindValue(':cliente', $cliente);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }

    public function selectAplicativoNome_pacote($nome_pacote) {

        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from aplicativo where nome_pacote = :nome_pacote;');
        $stmt->bindValue(':nome_pacote', $nome_pacote);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }

    public function selectAplicativoChave($chave) {

        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from aplicativo where chave = :chave;');
        $stmt->bindValue(':chave', $chave);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }

    public function selectAplicativoDominio($dominio) {

        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from aplicativo where dominio = :dominio;');
        $stmt->bindValue(':dominio', $dominio);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }

    public function selectAplicativoArquivo_firebase($arquivo_firebase) {

        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from aplicativo where arquivo_firebase = :arquivo_firebase;');
        $stmt->bindValue(':arquivo_firebase', $arquivo_firebase);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }

    public function updateAplicativo(Aplicativo $aplicativo) {
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('update aplicativo set cliente = :cliente , nome_pacote = :nome_pacote , chave = :chave , dominio = :dominio , arquivo_firebase = :arquivo_firebase where id_aplicativo = :id_aplicativo;');
        $stmt->bindValue(':cliente', $aplicativo->getCliente());

        $stmt->bindValue(':nome_pacote', $aplicativo->getNome_pacote());

        $stmt->bindValue(':chave', $aplicativo->getChave());

        $stmt->bindValue(':dominio', $aplicativo->getDominio());

        $stmt->bindValue(':arquivo_firebase', $aplicativo->getArquivo_firebase());

        $stmt->bindValue(':id_aplicativo', $aplicativo->getId_aplicativo());
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function deleteAplicativo($definir) {
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('delete from aplicativo where id_aplicativo = :definir ;');
        $stmt->bindValue(':definir', $definir);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function deletar() {
        $this->deleteAplicativo($_GET['id']);
        header('location: ../Tela/listarAplicativo.php');
    }

    /* editar */

    function editar() {
        $aplicativo = new Aplicativo($_POST);
        if ($this->updateAplicativo($aplicativo) > 0) {
            header('location: ../index.php?msg=aplicativoAlterado');
        } else {
            header('location: ../index.php?msg=aplicativoErroAlterar');
        }
    }

    /* editar */
    /* chave */
}
