<?php

if (realpath('./index.php')) {
    include_once './Controle/conexao.php';
    include_once './Modelo/Users.php';
} else {
    if (realpath('../index.php')) {
        include_once '../Controle/conexao.php';
        include_once '../Modelo/Users.php';
    } else {
        if (realpath('../../index.php')) {
            include_once '../../Controle/conexao.php';
            include_once '../../Modelo/Users.php';
        }
    }
}


class UsersPDO{
    /*inserir*/
    function inserirUsers() {
        $users = new users($_POST);
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('insert into Users values(:id , :user , :password , :nome , :nivel);' );

        $stmt->bindValue(':id', $users->getId());    
        
        $stmt->bindValue(':user', $users->getUser());    
        
        $stmt->bindValue(':password', $users->getPassword());    
        
        $stmt->bindValue(':nome', $users->getNome());    
        
        $stmt->bindValue(':nivel', $users->getNivel());    
        
        if($stmt->execute()){ 
            header('location: ../index.php?msg=usersInserido');
        }else{
            header('location: ../index.php?msg=usersErroInsert');
        }
    }
    /*inserir*/
    

            

    public function selectUsers(){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from users ;');
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    

                    
    public function selectUsersId($id){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from users where id = :id;');
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    

                    
    public function selectUsersUser($user){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from users where user = :user;');
        $stmt->bindValue(':user', $user);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    

                    
    public function selectUsersPassword($password){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from users where password = :password;');
        $stmt->bindValue(':password', $password);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    

                    
    public function selectUsersNome($nome){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from users where nome = :nome;');
        $stmt->bindValue(':nome', $nome);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    

                    
    public function selectUsersNivel($nivel){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from users where nivel = :nivel;');
        $stmt->bindValue(':nivel', $nivel);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    
 
    public function updateUsers(Users $users){        
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('update users set user = :user , password = :password , nome = :nome , nivel = :nivel where id = :id;');
        $stmt->bindValue(':user', $users->getUser());
        
        $stmt->bindValue(':password', $users->getPassword());
        
        $stmt->bindValue(':nome', $users->getNome());
        
        $stmt->bindValue(':nivel', $users->getNivel());
        
        $stmt->bindValue(':id', $users->getId());
        $stmt->execute();
        return $stmt->rowCount();
    }            
    
    public function deleteUsers($definir){
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('delete from users where definir = :definir ;');
        $stmt->bindValue(':definir', $definir);
        $stmt->execute();
        return $stmt->rowCount();
    }
    
    public function deletar(){
        $this->deleteUsers($_GET['id']);
        header('location: ../Tela/listarUsers.php');
    }


/*chave*/}
