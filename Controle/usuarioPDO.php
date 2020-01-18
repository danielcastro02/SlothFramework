<?php

if (realpath('./index.php')) {
    include_once './Controle/conexao.php';
    include_once './Modelo/Usuario.php';
} else {
    if (realpath('../index.php')) {
        include_once '../Controle/conexao.php';
        include_once '../Modelo/Usuario.php';
    } else {
        if (realpath('../../index.php')) {
            include_once '../../Controle/conexao.php';
            include_once '../../Modelo/Usuario.php';
        }
    }
}


class UsuarioPDO{
    
             /*inserir*/
    function inserirUsuario() {
        $usuario = new usuario($_POST);
        if($_POST['senha1'] == $_POST['senha2']){
            $senhamd5 = md5($_POST['senha1']);
            $con = new conexao();
            $pdo = $con->getConexao();
            $stmt = $pdo->prepare('insert into Usuario values(default , :nome , :usuario , :senha);' );

            $stmt->bindValue(':nome', $usuario->getNome());    
        
            $stmt->bindValue(':usuario', $usuario->getUsuario());    
        
            $stmt->bindValue(':senha', $senhamd5);    
        
            if($stmt->execute()){ 
                header('location: ../index.php?msg=usuarioInserido');
            }else{
                header('location: ../index.php?msg=usuarioErroInsert');
            }
        } else{
            header('location: ../Tela/registroUsuario.php?msg=senhaerrada');      
        }
    }
    /*inserir*/
                
    

            

    public function selectUsuario(){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from usuario ;');
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    

                    
    public function selectUsuarioId_usuario($id_usuario){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from usuario where id_usuario = :id_usuario;');
        $stmt->bindValue(':id_usuario', $id_usuario);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    

                    
    public function selectUsuarioNome($nome){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from usuario where nome = :nome;');
        $stmt->bindValue(':nome', $nome);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    

                    
    public function selectUsuarioUsuario($usuario){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from usuario where usuario = :usuario;');
        $stmt->bindValue(':usuario', $usuario);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    

                    
    public function selectUsuarioSenha($senha){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from usuario where senha = :senha;');
        $stmt->bindValue(':senha', $senha);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    
 
    public function updateUsuario(Usuario $usuario){        
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('update usuario set nome = :nome , usuario = :usuario , senha = :senha where id_usuario = :id_usuario;');
        $stmt->bindValue(':nome', $usuario->getNome());
        $stmt->bindValue(':usuario', $usuario->getUsuario());
        $stmt->bindValue(':senha', $usuario->getSenha());
        $stmt->bindValue(':id_usuario', $usuario->getId_usuario());
        $stmt->execute();
        return $stmt->rowCount();
    }            
    
    public function deleteUsuario(){
        $id_usuario = $_GET['id_usuario'];
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('delete from usuario where id_usuario = :definir ;');
        $stmt->bindValue(':definir', $id_usuario);
        if($stmt->execute()) {
            $_SESSION['toast'][] = "Usuario excluido";
            header('location: ../Tela/listagemUsuario.php');
        } else {
            $_SESSION['toast'][] = "Erro ao excluir usuario";
            header('location: ../Tela/listagemUsuario.php');
        }
    }

    function editar() {
        $usuario = new usuario($_POST);
        $oldUser = new usuario($this->selectUsuarioId_usuario($usuario->getId_usuario())->fetch());
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('update usuario set nome = :nome, usuario = :usuario, senha = :senha where id_usuario = :id_usuario');
        if($_POST['senha1'] == ""){
            $stmt->bindValue(":senha", $oldUser->getSenha());
        } else {
            if($_POST['senha1'] == $_POST['senha2']) {
                $senha = md5($_POST['senha1']);
                $stmt->bindValue(":senha", $senha);
            } else {
                $_SESSION['toast'][] = "As senhas não são iguais";
                header("Location: ../Tela/editarUsuario.php?id_usuario=".$usuario->getId_usuario());
            }
        }
        $stmt->bindValue(":nome", $usuario->getNome());
        $stmt->bindValue(":usuario", $usuario->getUsuario());
        $stmt->bindValue(":id_usuario", $usuario->getId_usuario());
        $stmt->execute();
        if($stmt->execute()){
            $_SESSION['toast'][] = "Usuario alterado";
            header("Location: ../Tela/listagemUsuario.php");
        } else {
            $_SESSION['toast'][] = "Erro ao alterar usuario";
            header("Location: ../Tela/editarUsuario.php?id_usuario=".$usuario->getId_usuario());
        }
    }




            /*login*/
    public function login() {
        $con = new conexao();
        $pdo = $con->getConexao();
        $senha = md5($_POST['senha']);
        $stmt = $pdo->prepare("SELECT * FROM usuario WHERE usuario LIKE :usuario AND senha LIKE :senha");
        $stmt->bindValue(":usuario", $_POST['usuario']);
        $stmt->bindValue(":senha", $senha);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $linha = $stmt->fetch(PDO::FETCH_ASSOC);
            $_SESSION['logado'] = serialize(new Usuario($linha));
            header("Location: ../Tela/home.php");
        } else {
            header("Location: ../index.php?msg=erro");
        }
    }
    
    function logout(){
        session_destroy();
        header('location: ../index.php');
    }
    
/*login*/

/*chave*/}
