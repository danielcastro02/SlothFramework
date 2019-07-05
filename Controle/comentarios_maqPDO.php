<?php

if (realpath('./index.php')) {
    include_once './Controle/conexao.php';
    include_once './Modelo/Comentarios_maq.php';
} else {
    if (realpath('../index.php')) {
        include_once '../Controle/conexao.php';
        include_once '../Modelo/Comentarios_maq.php';
    } else {
        if (realpath('../../index.php')) {
            include_once '../../Controle/conexao.php';
            include_once '../../Modelo/Comentarios_maq.php';
        }
    }
}


class Comentarios_maqPDO{
    /*inserir*/
    function inserirComentarios_maq() {
        $comentarios_maq = new comentarios_maq($_POST);
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('insert into Comentarios_maq values(:id , :id_evento , :id_user , :comentario , :hora);' );

        $stmt->bindValue(':id', $comentarios_maq->getId());    
        
        $stmt->bindValue(':id_evento', $comentarios_maq->getId_evento());    
        
        $stmt->bindValue(':id_user', $comentarios_maq->getId_user());    
        
        $stmt->bindValue(':comentario', $comentarios_maq->getComentario());    
        
        $stmt->bindValue(':hora', $comentarios_maq->getHora());    
        
        if($stmt->execute()){ 
            header('location: ../index.php?msg=comentarios_maqInserido');
        }else{
            header('location: ../index.php?msg=comentarios_maqErroInsert');
        }
    }
    /*inserir*/
    

            

    public function selectComentarios_maq(){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from comentarios_maq ;');
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    

                    
    public function selectComentarios_maqId($id){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from comentarios_maq where id = :id;');
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    

                    
    public function selectComentarios_maqId_evento($id_evento){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from comentarios_maq where id_evento = :id_evento;');
        $stmt->bindValue(':id_evento', $id_evento);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    

                    
    public function selectComentarios_maqId_user($id_user){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from comentarios_maq where id_user = :id_user;');
        $stmt->bindValue(':id_user', $id_user);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    

                    
    public function selectComentarios_maqComentario($comentario){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from comentarios_maq where comentario = :comentario;');
        $stmt->bindValue(':comentario', $comentario);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    

                    
    public function selectComentarios_maqHora($hora){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from comentarios_maq where hora = :hora;');
        $stmt->bindValue(':hora', $hora);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    
 
    public function updateComentarios_maq(Comentarios_maq $comentarios_maq){        
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('update comentarios_maq set id_evento = :id_evento , id_user = :id_user , comentario = :comentario , hora = :hora where id = :id;');
        $stmt->bindValue(':id_evento', $comentarios_maq->getId_evento());
        
        $stmt->bindValue(':id_user', $comentarios_maq->getId_user());
        
        $stmt->bindValue(':comentario', $comentarios_maq->getComentario());
        
        $stmt->bindValue(':hora', $comentarios_maq->getHora());
        
        $stmt->bindValue(':id', $comentarios_maq->getId());
        $stmt->execute();
        return $stmt->rowCount();
    }            
    
    public function deleteComentarios_maq($definir){
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('delete from comentarios_maq where definir = :definir ;');
        $stmt->bindValue(':definir', $definir);
        $stmt->execute();
        return $stmt->rowCount();
    }
    
    public function deletar(){
        $this->deleteComentarios_maq($_GET['id']);
        header('location: ../Tela/listarComentarios_maq.php');
    }


/*chave*/}
