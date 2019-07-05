<?php

if (realpath('./index.php')) {
    include_once './Controle/conexao.php';
    include_once './Modelo/Laboratorios.php';
} else {
    if (realpath('../index.php')) {
        include_once '../Controle/conexao.php';
        include_once '../Modelo/Laboratorios.php';
    } else {
        if (realpath('../../index.php')) {
            include_once '../../Controle/conexao.php';
            include_once '../../Modelo/Laboratorios.php';
        }
    }
}


class LaboratoriosPDO{
    /*inserir*/
    function inserirLaboratorios() {
        $laboratorios = new laboratorios($_POST);
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('insert into Laboratorios values(:id , :nome , :n_maquinas , :problemas);' );

        $stmt->bindValue(':id', $laboratorios->getId());    
        
        $stmt->bindValue(':nome', $laboratorios->getNome());    
        
        $stmt->bindValue(':n_maquinas', $laboratorios->getN_maquinas());    
        
        $stmt->bindValue(':problemas', $laboratorios->getProblemas());    
        
        if($stmt->execute()){ 
            header('location: ../index.php?msg=laboratoriosInserido');
        }else{
            header('location: ../index.php?msg=laboratoriosErroInsert');
        }
    }
    /*inserir*/
    

            

    public function selectLaboratorios(){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from laboratorios ;');
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    

                    
    public function selectLaboratoriosId($id){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from laboratorios where id = :id;');
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    

                    
    public function selectLaboratoriosNome($nome){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from laboratorios where nome = :nome;');
        $stmt->bindValue(':nome', $nome);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    

                    
    public function selectLaboratoriosN_maquinas($n_maquinas){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from laboratorios where n_maquinas = :n_maquinas;');
        $stmt->bindValue(':n_maquinas', $n_maquinas);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    

                    
    public function selectLaboratoriosProblemas($problemas){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from laboratorios where problemas = :problemas;');
        $stmt->bindValue(':problemas', $problemas);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    
 
    public function updateLaboratorios(Laboratorios $laboratorios){        
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('update laboratorios set nome = :nome , n_maquinas = :n_maquinas , problemas = :problemas where id = :id;');
        $stmt->bindValue(':nome', $laboratorios->getNome());
        
        $stmt->bindValue(':n_maquinas', $laboratorios->getN_maquinas());
        
        $stmt->bindValue(':problemas', $laboratorios->getProblemas());
        
        $stmt->bindValue(':id', $laboratorios->getId());
        $stmt->execute();
        return $stmt->rowCount();
    }            
    
    public function deleteLaboratorios($definir){
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('delete from laboratorios where definir = :definir ;');
        $stmt->bindValue(':definir', $definir);
        $stmt->execute();
        return $stmt->rowCount();
    }
    
    public function deletar(){
        $this->deleteLaboratorios($_GET['id']);
        header('location: ../Tela/listarLaboratorios.php');
    }


/*chave*/}
