<?php

if (realpath('./index.php')) {
    include_once './Controle/conexao.php';
    include_once './Modelo/Descricao.php';
} else {
    if (realpath('../index.php')) {
        include_once '../Controle/conexao.php';
        include_once '../Modelo/Descricao.php';
    } else {
        if (realpath('../../index.php')) {
            include_once '../../Controle/conexao.php';
            include_once '../../Modelo/Descricao.php';
        }
    }
}


class DescricaoPDO{
    /*inserir*/
    function inserirDescricao() {
        $descricao = new descricao($_POST);
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('insert into Descricao values(:id , :nome , :descricao);' );

        $stmt->bindValue(':id', $descricao->getId());    
        
        $stmt->bindValue(':nome', $descricao->getNome());    
        
        $stmt->bindValue(':descricao', $descricao->getDescricao());    
        
        if($stmt->execute()){ 
            header('location: ../index.php?msg=descricaoInserido');
        }else{
            header('location: ../index.php?msg=descricaoErroInsert');
        }
    }
    /*inserir*/
    

            

    public function selectDescricao(){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from descricao ;');
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    

                    
    public function selectDescricaoId($id){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from descricao where id = :id;');
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    

                    
    public function selectDescricaoNome($nome){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from descricao where nome = :nome;');
        $stmt->bindValue(':nome', $nome);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    

                    
    public function selectDescricaoDescricao($descricao){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from descricao where descricao = :descricao;');
        $stmt->bindValue(':descricao', $descricao);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    
 
    public function updateDescricao(Descricao $descricao){        
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('update descricao set nome = :nome , descricao = :descricao where id = :id;');
        $stmt->bindValue(':nome', $descricao->getNome());
        
        $stmt->bindValue(':descricao', $descricao->getDescricao());
        
        $stmt->bindValue(':id', $descricao->getId());
        $stmt->execute();
        return $stmt->rowCount();
    }            
    
    public function deleteDescricao($definir){
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('delete from descricao where definir = :definir ;');
        $stmt->bindValue(':definir', $definir);
        $stmt->execute();
        return $stmt->rowCount();
    }
    
    public function deletar(){
        $this->deleteDescricao($_GET['id']);
        header('location: ../Tela/listarDescricao.php');
    }


/*chave*/}
