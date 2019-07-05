<?php

if (realpath('./index.php')) {
    include_once './Controle/conexao.php';
    include_once './Modelo/Evt_rotina.php';
} else {
    if (realpath('../index.php')) {
        include_once '../Controle/conexao.php';
        include_once '../Modelo/Evt_rotina.php';
    } else {
        if (realpath('../../index.php')) {
            include_once '../../Controle/conexao.php';
            include_once '../../Modelo/Evt_rotina.php';
        }
    }
}


class Evt_rotinaPDO{
    /*inserir*/
    function inserirEvt_rotina() {
        $evt_rotina = new evt_rotina($_POST);
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('insert into Evt_rotina values(:id , :id_us , :hora , :nome , :descricao , :status);' );

        $stmt->bindValue(':id', $evt_rotina->getId());    
        
        $stmt->bindValue(':id_us', $evt_rotina->getId_us());    
        
        $stmt->bindValue(':hora', $evt_rotina->getHora());    
        
        $stmt->bindValue(':nome', $evt_rotina->getNome());    
        
        $stmt->bindValue(':descricao', $evt_rotina->getDescricao());    
        
        $stmt->bindValue(':status', $evt_rotina->getStatus());    
        
        if($stmt->execute()){ 
            header('location: ../index.php?msg=evt_rotinaInserido');
        }else{
            header('location: ../index.php?msg=evt_rotinaErroInsert');
        }
    }
    /*inserir*/
    

            

    public function selectEvt_rotina(){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from evt_rotina ;');
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    

                    
    public function selectEvt_rotinaId($id){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from evt_rotina where id = :id;');
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    

                    
    public function selectEvt_rotinaId_us($id_us){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from evt_rotina where id_us = :id_us;');
        $stmt->bindValue(':id_us', $id_us);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    

                    
    public function selectEvt_rotinaHora($hora){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from evt_rotina where hora = :hora;');
        $stmt->bindValue(':hora', $hora);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    

                    
    public function selectEvt_rotinaNome($nome){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from evt_rotina where nome = :nome;');
        $stmt->bindValue(':nome', $nome);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    

                    
    public function selectEvt_rotinaDescricao($descricao){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from evt_rotina where descricao = :descricao;');
        $stmt->bindValue(':descricao', $descricao);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    

                    
    public function selectEvt_rotinaStatus($status){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from evt_rotina where status = :status;');
        $stmt->bindValue(':status', $status);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    
 
    public function updateEvt_rotina(Evt_rotina $evt_rotina){        
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('update evt_rotina set id_us = :id_us , hora = :hora , nome = :nome , descricao = :descricao , status = :status where id = :id;');
        $stmt->bindValue(':id_us', $evt_rotina->getId_us());
        
        $stmt->bindValue(':hora', $evt_rotina->getHora());
        
        $stmt->bindValue(':nome', $evt_rotina->getNome());
        
        $stmt->bindValue(':descricao', $evt_rotina->getDescricao());
        
        $stmt->bindValue(':status', $evt_rotina->getStatus());
        
        $stmt->bindValue(':id', $evt_rotina->getId());
        $stmt->execute();
        return $stmt->rowCount();
    }            
    
    public function deleteEvt_rotina($definir){
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('delete from evt_rotina where definir = :definir ;');
        $stmt->bindValue(':definir', $definir);
        $stmt->execute();
        return $stmt->rowCount();
    }
    
    public function deletar(){
        $this->deleteEvt_rotina($_GET['id']);
        header('location: ../Tela/listarEvt_rotina.php');
    }


/*chave*/}
