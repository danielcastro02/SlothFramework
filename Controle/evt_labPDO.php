<?php

if (realpath('./index.php')) {
    include_once './Controle/conexao.php';
    include_once './Modelo/Evt_lab.php';
} else {
    if (realpath('../index.php')) {
        include_once '../Controle/conexao.php';
        include_once '../Modelo/Evt_lab.php';
    } else {
        if (realpath('../../index.php')) {
            include_once '../../Controle/conexao.php';
            include_once '../../Modelo/Evt_lab.php';
        }
    }
}


class Evt_labPDO{
    /*inserir*/
    function inserirEvt_lab() {
        $evt_lab = new evt_lab($_POST);
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('insert into Evt_lab values(:id , :lab , :nome , :hora , :status);' );

        $stmt->bindValue(':id', $evt_lab->getId());    
        
        $stmt->bindValue(':lab', $evt_lab->getLab());    
        
        $stmt->bindValue(':nome', $evt_lab->getNome());    
        
        $stmt->bindValue(':hora', $evt_lab->getHora());    
        
        $stmt->bindValue(':status', $evt_lab->getStatus());    
        
        if($stmt->execute()){ 
            header('location: ../index.php?msg=evt_labInserido');
        }else{
            header('location: ../index.php?msg=evt_labErroInsert');
        }
    }
    /*inserir*/
    

            

    public function selectEvt_lab(){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from evt_lab ;');
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    

                    
    public function selectEvt_labId($id){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from evt_lab where id = :id;');
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    

                    
    public function selectEvt_labLab($lab){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from evt_lab where lab = :lab;');
        $stmt->bindValue(':lab', $lab);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    

                    
    public function selectEvt_labNome($nome){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from evt_lab where nome = :nome;');
        $stmt->bindValue(':nome', $nome);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    

                    
    public function selectEvt_labHora($hora){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from evt_lab where hora = :hora;');
        $stmt->bindValue(':hora', $hora);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    

                    
    public function selectEvt_labStatus($status){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from evt_lab where status = :status;');
        $stmt->bindValue(':status', $status);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    
 
    public function updateEvt_lab(Evt_lab $evt_lab){        
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('update evt_lab set lab = :lab , nome = :nome , hora = :hora , status = :status where id = :id;');
        $stmt->bindValue(':lab', $evt_lab->getLab());
        
        $stmt->bindValue(':nome', $evt_lab->getNome());
        
        $stmt->bindValue(':hora', $evt_lab->getHora());
        
        $stmt->bindValue(':status', $evt_lab->getStatus());
        
        $stmt->bindValue(':id', $evt_lab->getId());
        $stmt->execute();
        return $stmt->rowCount();
    }            
    
    public function deleteEvt_lab($definir){
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('delete from evt_lab where definir = :definir ;');
        $stmt->bindValue(':definir', $definir);
        $stmt->execute();
        return $stmt->rowCount();
    }
    
    public function deletar(){
        $this->deleteEvt_lab($_GET['id']);
        header('location: ../Tela/listarEvt_lab.php');
    }


/*chave*/}
