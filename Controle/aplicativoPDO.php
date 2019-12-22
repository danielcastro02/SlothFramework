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
    /* inserir */

    function inserirAplicativo() {
        $aplicativo = new aplicativo($_POST);
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('insert into aplicativo values(default , :cliente , :nome_pacote , :chave , :dominio , :arquivo_firebase);');

        $stmt->bindValue(':cliente', $aplicativo->getCliente());

        $stmt->bindValue(':nome_pacote', $aplicativo->getNome_pacote());
        mkdir("../Img/Chaves/".$aplicativo->getCliente());
        $stmt->bindValue(':chave', "Img/Chaves/" . $aplicativo->getCliente() . "/" . $_FILES['chave']['name']);
        move_uploaded_file($_FILES['chave']['tmp_name'], "../Img/Chaves/" . $aplicativo->getCliente() . "/" . $_FILES['chave']['name']);
        move_uploaded_file($_FILES['arquivo_firebase']['tmp_name'], "../Img/Chaves/" . $aplicativo->getCliente() . "/" . $_FILES['arquivo_firebase']['name']);
        $stmt->bindValue(':dominio', $aplicativo->getDominio());

        $stmt->bindValue(':arquivo_firebase', "Img/Chaves/" . $aplicativo->getCliente() . "/" . $_FILES['arquivo_firebase']['name']);
        if ($stmt->execute()) {
            header('location: ../Tela/home.php?msg=aplicativoInserido');
        } else {
            header('location: ../Tela/home.php?msg=aplicativoErroInsert');
        }
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
