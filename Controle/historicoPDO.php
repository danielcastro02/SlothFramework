<?php

if (realpath('./index.php')) {
    include_once './Controle/conexao.php';
    include_once './Modelo/Historico.php';
} else {
    if (realpath('../index.php')) {
        include_once '../Controle/conexao.php';
        include_once '../Modelo/Historico.php';
    } else {
        if (realpath('../../index.php')) {
            include_once '../../Controle/conexao.php';
            include_once '../../Modelo/Historico.php';
        }
    }
}


class HistoricoPDO{
    /*inserir*/
    function inserirHistorico() {
        $historico = new historico($_POST);
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('insert into Historico values(:id , :nome , :maq , :hora , :situacao);' );

        $stmt->bindValue(':id', $historico->getId());    
        
        $stmt->bindValue(':nome', $historico->getNome());    
        
        $stmt->bindValue(':maq', $historico->getMaq());    
        
        $stmt->bindValue(':hora', $historico->getHora());    
        
        $stmt->bindValue(':situacao', $historico->getSituacao());    
        
        if($stmt->execute()){ 
            header('location: ../index.php?msg=historicoInserido');
        }else{
            header('location: ../index.php?msg=historicoErroInsert');
        }
    }
    /*inserir*/
    

            

    public function selectHistorico(){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from historico ;');
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    

                    
    public function selectHistoricoId($id){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from historico where id = :id;');
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    

                    
    public function selectHistoricoNome($nome){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from historico where nome = :nome;');
        $stmt->bindValue(':nome', $nome);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    

                    
    public function selectHistoricoMaq($maq){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from historico where maq = :maq;');
        $stmt->bindValue(':maq', $maq);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    

                    
    public function selectHistoricoHora($hora){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from historico where hora = :hora;');
        $stmt->bindValue(':hora', $hora);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    

                    
    public function selectHistoricoSituacao($situacao){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from historico where situacao = :situacao;');
        $stmt->bindValue(':situacao', $situacao);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    
 
    public function updateHistorico(Historico $historico){        
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('update historico set nome = :nome , maq = :maq , hora = :hora , situacao = :situacao where id = :id;');
        $stmt->bindValue(':nome', $historico->getNome());
        
        $stmt->bindValue(':maq', $historico->getMaq());
        
        $stmt->bindValue(':hora', $historico->getHora());
        
        $stmt->bindValue(':situacao', $historico->getSituacao());
        
        $stmt->bindValue(':id', $historico->getId());
        $stmt->execute();
        return $stmt->rowCount();
    }            
    
    public function deleteHistorico($definir){
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('delete from historico where definir = :definir ;');
        $stmt->bindValue(':definir', $definir);
        $stmt->execute();
        return $stmt->rowCount();
    }
    
    public function deletar(){
        $this->deleteHistorico($_GET['id']);
        header('location: ../Tela/listarHistorico.php');
    }


/*chave*/}
