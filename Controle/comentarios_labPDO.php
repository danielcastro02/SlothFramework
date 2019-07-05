<?php

if (realpath('./index.php')) {
    include_once './Controle/conexao.php';
    include_once './Modelo/Comentarios_lab.php';
} else {
    if (realpath('../index.php')) {
        include_once '../Controle/conexao.php';
        include_once '../Modelo/Comentarios_lab.php';
    } else {
        if (realpath('../../index.php')) {
            include_once '../../Controle/conexao.php';
            include_once '../../Modelo/Comentarios_lab.php';
        }
    }
}


class Comentarios_labPDO{
    /*inserir*/
    function inserirComentarios_lab() {
        $comentarios_lab = new comentarios_lab($_POST);
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('insert into Comentarios_lab values(:id , :id_evento , :id_user , :comentario , :hora);' );

        $stmt->bindValue(':id', $comentarios_lab->getId());    
        
        $stmt->bindValue(':id_evento', $comentarios_lab->getId_evento());    
        
        $stmt->bindValue(':id_user', $comentarios_lab->getId_user());    
        
        $stmt->bindValue(':comentario', $comentarios_lab->getComentario());    
        
        $stmt->bindValue(':hora', $comentarios_lab->getHora());    
        
        if($stmt->execute()){ 
            header('location: ../index.php?msg=comentarios_labInserido');
        }else{
            header('location: ../index.php?msg=comentarios_labErroInsert');
        }
    }
    /*inserir*/
    

            

    public function selectComentarios_lab(){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from comentarios_lab ;');
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    

                    
    public function selectComentarios_labId($id){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from comentarios_lab where id = :id;');
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    

                    
    public function selectComentarios_labId_evento($id_evento){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from comentarios_lab where id_evento = :id_evento;');
        $stmt->bindValue(':id_evento', $id_evento);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    

                    
    public function selectComentarios_labId_user($id_user){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from comentarios_lab where id_user = :id_user;');
        $stmt->bindValue(':id_user', $id_user);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    

                    
    public function selectComentarios_labComentario($comentario){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from comentarios_lab where comentario = :comentario;');
        $stmt->bindValue(':comentario', $comentario);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    

                    
    public function selectComentarios_labHora($hora){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from comentarios_lab where hora = :hora;');
        $stmt->bindValue(':hora', $hora);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    
 
    public function updateComentarios_lab(Comentarios_lab $comentarios_lab){        
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('update comentarios_lab set id_evento = :id_evento , id_user = :id_user , comentario = :comentario , hora = :hora where id = :id;');
        $stmt->bindValue(':id_evento', $comentarios_lab->getId_evento());
        
        $stmt->bindValue(':id_user', $comentarios_lab->getId_user());
        
        $stmt->bindValue(':comentario', $comentarios_lab->getComentario());
        
        $stmt->bindValue(':hora', $comentarios_lab->getHora());
        
        $stmt->bindValue(':id', $comentarios_lab->getId());
        $stmt->execute();
        return $stmt->rowCount();
    }            
    
    public function deleteComentarios_lab($definir){
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('delete from comentarios_lab where definir = :definir ;');
        $stmt->bindValue(':definir', $definir);
        $stmt->execute();
        return $stmt->rowCount();
    }
    
    public function deletar(){
        $this->deleteComentarios_lab($_GET['id']);
        header('location: ../Tela/listarComentarios_lab.php');
    }


/*chave*/}
