<?php

if (realpath('./index.php')) {
    include_once './Controle/conexao.php';
    include_once './Modelo/Softwares.php';
} else {
    if (realpath('../index.php')) {
        include_once '../Controle/conexao.php';
        include_once '../Modelo/Softwares.php';
    } else {
        if (realpath('../../index.php')) {
            include_once '../../Controle/conexao.php';
            include_once '../../Modelo/Softwares.php';
        }
    }
}


class SoftwaresPDO{
    /*inserir*/
    function inserirSoftwares() {
        $softwares = new softwares($_POST);
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('insert into Softwares values(:id , :lab , :nome , :descricao , :instalacao);' );

        $stmt->bindValue(':id', $softwares->getId());    
        
        $stmt->bindValue(':lab', $softwares->getLab());    
        
        $stmt->bindValue(':nome', $softwares->getNome());    
        
        $stmt->bindValue(':descricao', $softwares->getDescricao());    
        
        $stmt->bindValue(':instalacao', $softwares->getInstalacao());    
        
        if($stmt->execute()){ 
            header('location: ../index.php?msg=softwaresInserido');
        }else{
            header('location: ../index.php?msg=softwaresErroInsert');
        }
    }
    /*inserir*/
    

            

    public function selectSoftwares(){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from softwares ;');
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    

                    
    public function selectSoftwaresId($id){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from softwares where id = :id;');
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    

                    
    public function selectSoftwaresLab($lab){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from softwares where lab = :lab;');
        $stmt->bindValue(':lab', $lab);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    

                    
    public function selectSoftwaresNome($nome){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from softwares where nome = :nome;');
        $stmt->bindValue(':nome', $nome);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    

                    
    public function selectSoftwaresDescricao($descricao){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from softwares where descricao = :descricao;');
        $stmt->bindValue(':descricao', $descricao);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    

                    
    public function selectSoftwaresInstalacao($instalacao){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from softwares where instalacao = :instalacao;');
        $stmt->bindValue(':instalacao', $instalacao);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    
 
    public function updateSoftwares(Softwares $softwares){        
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('update softwares set lab = :lab , nome = :nome , descricao = :descricao , instalacao = :instalacao where id = :id;');
        $stmt->bindValue(':lab', $softwares->getLab());
        
        $stmt->bindValue(':nome', $softwares->getNome());
        
        $stmt->bindValue(':descricao', $softwares->getDescricao());
        
        $stmt->bindValue(':instalacao', $softwares->getInstalacao());
        
        $stmt->bindValue(':id', $softwares->getId());
        $stmt->execute();
        return $stmt->rowCount();
    }            
    
    public function deleteSoftwares($definir){
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('delete from softwares where definir = :definir ;');
        $stmt->bindValue(':definir', $definir);
        $stmt->execute();
        return $stmt->rowCount();
    }
    
    public function deletar(){
        $this->deleteSoftwares($_GET['id']);
        header('location: ../Tela/listarSoftwares.php');
    }


/*chave*/}
