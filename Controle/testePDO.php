<?php

if (realpath('./index.php')) {
    include_once './Controle/conexao.php';
    include_once './Modelo/Teste.php';
} else {
    if (realpath('../index.php')) {
        include_once '../Controle/conexao.php';
        include_once '../Modelo/Teste.php';
    } else {
        if (realpath('../../index.php')) {
            include_once '../../Controle/conexao.php';
            include_once '../../Modelo/Teste.php';
        }
    }
}


class TestePDO{
    function inserirTeste() {
        $teste = new teste($_POST);
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('insert into Teste values(default , :preco , :email);' );

        $stmt->bindValue(':preco', $teste->getPreco());    
        
        $stmt->bindValue(':email', $teste->getEmail());    
        
        if($stmt->execute()){ 
            header('location: ../index.php?msg=testeInserido');
        }else{
            header('location: ../index.php?msg=testeErroInsert');
        }
    }
    

            

    public function selectTeste(){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from teste ;');
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    

                    
    public function selectTesteTeste($teste){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from teste where teste = :teste;');
        $stmt->bindValue(':teste', $teste);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    

                    
    public function selectTestePreco($preco){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from teste where preco = :preco;');
        $stmt->bindValue(':preco', $preco);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    

                    
    public function selectTesteEmail($email){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from teste where email = :email;');
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    
 
    public function updateTeste(Teste $Teste){        
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('updatetesteset preco = :preco , email = :email where teste = :teste;');
        $stmt->bindValue(':preco', $teste->getPreco());
        
        $stmt->bindValue(':email', $teste->getEmail());
        
        $stmt->bindValue(':teste', $teste->getTeste());
        $stmt->execute();
        return $stmt->rowCount();
    }            
    
    public function deleteTeste($definir){
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('delete from teste where definir = :definir ;');
        $stmt->bindValue(':definir', $definir);
        $stmt->execute();
        return $stmt->rowCount();
    }
}
