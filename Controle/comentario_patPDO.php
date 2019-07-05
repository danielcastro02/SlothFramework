<?php

if (realpath('./index.php')) {
    include_once './Controle/conexao.php';
    include_once './Modelo/Comentario_pat.php';
} else {
    if (realpath('../index.php')) {
        include_once '../Controle/conexao.php';
        include_once '../Modelo/Comentario_pat.php';
    } else {
        if (realpath('../../index.php')) {
            include_once '../../Controle/conexao.php';
            include_once '../../Modelo/Comentario_pat.php';
        }
    }
}


class Comentario_patPDO{
    /*inserir*/
    function inserirComentario_pat() {
        $comentario_pat = new comentario_pat($_POST);
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('insert into Comentario_pat values(:id , :pat , :id_user , :comentario , :hora);' );

        $stmt->bindValue(':id', $comentario_pat->getId());    
        
        $stmt->bindValue(':pat', $comentario_pat->getPat());    
        
        $stmt->bindValue(':id_user', $comentario_pat->getId_user());    
        
        $stmt->bindValue(':comentario', $comentario_pat->getComentario());    
        
        $stmt->bindValue(':hora', $comentario_pat->getHora());    
        
        if($stmt->execute()){ 
            header('location: ../index.php?msg=comentario_patInserido');
        }else{
            header('location: ../index.php?msg=comentario_patErroInsert');
        }
    }
    /*inserir*/
    

            

    public function selectComentario_pat(){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from comentario_pat ;');
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    

                    
    public function selectComentario_patId($id){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from comentario_pat where id = :id;');
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    

                    
    public function selectComentario_patPat($pat){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from comentario_pat where pat = :pat;');
        $stmt->bindValue(':pat', $pat);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    

                    
    public function selectComentario_patId_user($id_user){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from comentario_pat where id_user = :id_user;');
        $stmt->bindValue(':id_user', $id_user);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    

                    
    public function selectComentario_patComentario($comentario){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from comentario_pat where comentario = :comentario;');
        $stmt->bindValue(':comentario', $comentario);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    

                    
    public function selectComentario_patHora($hora){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from comentario_pat where hora = :hora;');
        $stmt->bindValue(':hora', $hora);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    
 
    public function updateComentario_pat(Comentario_pat $comentario_pat){        
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('update comentario_pat set pat = :pat , id_user = :id_user , comentario = :comentario , hora = :hora where id = :id;');
        $stmt->bindValue(':pat', $comentario_pat->getPat());
        
        $stmt->bindValue(':id_user', $comentario_pat->getId_user());
        
        $stmt->bindValue(':comentario', $comentario_pat->getComentario());
        
        $stmt->bindValue(':hora', $comentario_pat->getHora());
        
        $stmt->bindValue(':id', $comentario_pat->getId());
        $stmt->execute();
        return $stmt->rowCount();
    }            
    
    public function deleteComentario_pat($definir){
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('delete from comentario_pat where definir = :definir ;');
        $stmt->bindValue(':definir', $definir);
        $stmt->execute();
        return $stmt->rowCount();
    }
    
    public function deletar(){
        $this->deleteComentario_pat($_GET['id']);
        header('location: ../Tela/listarComentario_pat.php');
    }


/*chave*/}
