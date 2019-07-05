<?php

if (realpath('./index.php')) {
    include_once './Controle/conexao.php';
    include_once './Modelo/Patrimonio.php';
} else {
    if (realpath('../index.php')) {
        include_once '../Controle/conexao.php';
        include_once '../Modelo/Patrimonio.php';
    } else {
        if (realpath('../../index.php')) {
            include_once '../../Controle/conexao.php';
            include_once '../../Modelo/Patrimonio.php';
        }
    }
}

class PatrimonioPDO {
    /* inserir */

    function inserirPatrimonio() {
        $patrimonio = new patrimonio($_POST);
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('insert into Patrimonio values(:pat , :nome , :id_desc , :localizacao , :estado);');

        $stmt->bindValue(':pat', $patrimonio->getPat());

        $stmt->bindValue(':nome', $patrimonio->getNome());

        $stmt->bindValue(':id_desc', $patrimonio->getId_desc());

        $stmt->bindValue(':localizacao', $patrimonio->getLocalizacao());

        $stmt->bindValue(':estado', $patrimonio->getEstado());

        if ($stmt->execute()) {
            header('location: ../index.php?msg=patrimonioInserido');
        } else {
            header('location: ../index.php?msg=patrimonioErroInsert');
        }
    }

    /* inserir */

    public function selectPatrimonio() {

        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from patrimonio ;');
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }

    public function selectPatrimonioPat($pat) {

        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from patrimonio where pat = :pat;');
        $stmt->bindValue(':pat', $pat);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }

    public function selectPatrimonioNome($nome) {

        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from patrimonio where nome = :nome;');
        $stmt->bindValue(':nome', $nome);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }

    public function selectPatrimonioId_desc($id_desc) {

        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from patrimonio where id_desc = :id_desc;');
        $stmt->bindValue(':id_desc', $id_desc);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }

    public function selectPatrimonioLocalizacao($localizacao) {

        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from patrimonio where localizacao = :localizacao;');
        $stmt->bindValue(':localizacao', $localizacao);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }

    public function selectPatrimonioEstado($estado) {

        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from patrimonio where estado = :estado;');
        $stmt->bindValue(':estado', $estado);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }

    public function updatePatrimonio(Patrimonio $patrimonio) {
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('update patrimonio set nome = :nome , id_desc = :id_desc , localizacao = :localizacao , estado = :estado where pat = :pat;');
        $stmt->bindValue(':nome', $patrimonio->getNome());

        $stmt->bindValue(':id_desc', $patrimonio->getId_desc());

        $stmt->bindValue(':localizacao', $patrimonio->getLocalizacao());

        $stmt->bindValue(':estado', $patrimonio->getEstado());

        $stmt->bindValue(':pat', $patrimonio->getPat());
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function deletePatrimonio($definir) {
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('delete from patrimonio where definir = :definir ;');
        $stmt->bindValue(':definir', $definir);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function deletar() {
        $this->deletePatrimonio($_GET['id']);
        header('location: ../Tela/listarPatrimonio.php');
    }

    /* editar */

    function editar() {
        $patrimonio = new Patrimonio($_POST);
        if ($this->updatePatrimonio($patrimonio) > 0) {
            header('location: ../index.php?msg=patrimonioAlterado');
        } else {
            header('location: ../index.php?msg=patrimonioErroAlterar');
        }
    }

    /* editar */

    /* chave */
}

             /*inserir*/
    function inserirPatrimonio() {
        $patrimonio = new patrimonio($_POST);
            $con = new conexao();
            $pdo = $con->getConexao();
            $stmt = $pdo->prepare('insert into Patrimonio values(default , :nome , :id_desc , :localizacao , :estado);' );

            $stmt->bindValue(':nome', $patrimonio->getNome());    
        
            $stmt->bindValue(':id_desc', $patrimonio->getId_desc());    
        
            $stmt->bindValue(':localizacao', $patrimonio->getLocalizacao());    
        
            $stmt->bindValue(':estado', $patrimonio->getEstado());    
        
            if($stmt->execute()){ 
                header('location: ../index.php?msg=patrimonioInserido');
            }else{
                header('location: ../index.php?msg=patrimonioErroInsert');
            }
    }
    /*inserir*/
                