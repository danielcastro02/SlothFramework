<?php

if (realpath('./index.php')) {
    include_once './Controle/conexao.php';
    include_once './Modelo/Maquinas.php';
} else {
    if (realpath('../index.php')) {
        include_once '../Controle/conexao.php';
        include_once '../Modelo/Maquinas.php';
    } else {
        if (realpath('../../index.php')) {
            include_once '../../Controle/conexao.php';
            include_once '../../Modelo/Maquinas.php';
        }
    }
}


class MaquinasPDO{
    /*inserir*/
    function inserirMaquinas() {
        $maquinas = new maquinas($_POST);
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('insert into Maquinas values(:id , :lab , :nome , :patrimonio , :n_serie , :w_serial , :situacao , :maq);' );

        $stmt->bindValue(':id', $maquinas->getId());    
        
        $stmt->bindValue(':lab', $maquinas->getLab());    
        
        $stmt->bindValue(':nome', $maquinas->getNome());    
        
        $stmt->bindValue(':patrimonio', $maquinas->getPatrimonio());    
        
        $stmt->bindValue(':n_serie', $maquinas->getN_serie());    
        
        $stmt->bindValue(':w_serial', $maquinas->getW_serial());    
        
        $stmt->bindValue(':situacao', $maquinas->getSituacao());    
        
        $stmt->bindValue(':maq', $maquinas->getMaq());    
        
        if($stmt->execute()){ 
            header('location: ../index.php?msg=maquinasInserido');
        }else{
            header('location: ../index.php?msg=maquinasErroInsert');
        }
    }
    /*inserir*/
    

            

    public function selectMaquinas(){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from maquinas ;');
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    

                    
    public function selectMaquinasId($id){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from maquinas where id = :id;');
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    

                    
    public function selectMaquinasLab($lab){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from maquinas where lab = :lab;');
        $stmt->bindValue(':lab', $lab);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    

                    
    public function selectMaquinasNome($nome){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from maquinas where nome = :nome;');
        $stmt->bindValue(':nome', $nome);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    

                    
    public function selectMaquinasPatrimonio($patrimonio){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from maquinas where patrimonio = :patrimonio;');
        $stmt->bindValue(':patrimonio', $patrimonio);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    

                    
    public function selectMaquinasN_serie($n_serie){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from maquinas where n_serie = :n_serie;');
        $stmt->bindValue(':n_serie', $n_serie);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    

                    
    public function selectMaquinasW_serial($w_serial){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from maquinas where w_serial = :w_serial;');
        $stmt->bindValue(':w_serial', $w_serial);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    

                    
    public function selectMaquinasSituacao($situacao){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from maquinas where situacao = :situacao;');
        $stmt->bindValue(':situacao', $situacao);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    

                    
    public function selectMaquinasMaq($maq){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from maquinas where maq = :maq;');
        $stmt->bindValue(':maq', $maq);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    
 
    public function updateMaquinas(Maquinas $maquinas){        
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('update maquinas set lab = :lab , nome = :nome , patrimonio = :patrimonio , n_serie = :n_serie , w_serial = :w_serial , situacao = :situacao , maq = :maq where id = :id;');
        $stmt->bindValue(':lab', $maquinas->getLab());
        
        $stmt->bindValue(':nome', $maquinas->getNome());
        
        $stmt->bindValue(':patrimonio', $maquinas->getPatrimonio());
        
        $stmt->bindValue(':n_serie', $maquinas->getN_serie());
        
        $stmt->bindValue(':w_serial', $maquinas->getW_serial());
        
        $stmt->bindValue(':situacao', $maquinas->getSituacao());
        
        $stmt->bindValue(':maq', $maquinas->getMaq());
        
        $stmt->bindValue(':id', $maquinas->getId());
        $stmt->execute();
        return $stmt->rowCount();
    }            
    
    public function deleteMaquinas($definir){
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('delete from maquinas where definir = :definir ;');
        $stmt->bindValue(':definir', $definir);
        $stmt->execute();
        return $stmt->rowCount();
    }
    
    public function deletar(){
        $this->deleteMaquinas($_GET['id']);
        header('location: ../Tela/listarMaquinas.php');
    }


/*chave*/}
