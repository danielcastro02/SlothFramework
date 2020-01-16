<?php
    if (realpath('./index.php')) {
        include_once './Controle/conexao.php';
        include_once './Modelo/Aplicativo.php';
    } else {
        if (realpath('../index.php')) {
            include_once '../Controle/conexao.php';
            include_once '../Modelo/Aplicativo.php';
        } else {
            if (realpath('../../index.php')) {
                include_once '../../Controle/conexao.php';
                include_once '../../Modelo/Aplicativo.php';
            }
        }
    }

    class AplicativoPDO
    {

        const REPO_KEYS = "/Repo/Chaves/";
        const REPO_VERSION = "/Repo/Versions/";
        const REPO_FIREBASE = "/Repo/Firebase/";

        /* inserir */
        function inserirAplicativo()
        {
            $aplicativo = new Aplicativo($_POST);
            $con = new conexao();
            $pdo = $con->getConexao();
            $stmt = $pdo->prepare('insert into aplicativo values(default , :cliente, :id_versao, :id_site, :nome_pacote , :chave , :arquivo_firebase);');
            $stmt->bindValue(':cliente', $aplicativo->getIdCliente());
            $stmt->bindValue(':id_versao', $aplicativo->getIdVersao());
            $stmt->bindValue(':id_site', $aplicativo->getIdSite());
            $stmt->bindValue(':nome_pacote', $aplicativo->getNomePacote());
            $nome = hash_file('md5', $_FILES['chave']['tmp_name']);
            $ext = explode('.', $_FILES['chave']['name']);
            $extensao = ".".$ext[(count($ext) - 1)];
            $extensao = strtolower($extensao);
            move_uploaded_file($_FILES['chave']["tmp_name"], '..'.self::REPO_KEYS.$nome.$extensao);
            $stmt->bindValue(':chave', $nome.$extensao);
            $nome = hash_file('md5', $_FILES['arquivo_firebase']['tmp_name']);
            $ext = explode('.', $_FILES['arquivo_firebase']['name']);
            $extensao = ".".$ext[(count($ext) - 1)];
            $extensao = strtolower($extensao);
            move_uploaded_file($_FILES['arquivo_firebase']["tmp_name"], '..'.self::REPO_FIREBASE.$nome.$extensao);
            $stmt->bindValue(':arquivo_firebase', $nome.$extensao);
            if ($stmt->execute()) {
                header('location: ../Tela/home.php?msg=aplicativoInserido');
            } else {
                header('location: ../Tela/home.php?msg=aplicativoErroInsert');
            }
        }

        /* inserir */
        public function selectAplicativo()
        {

            $con = new conexao();
            $pdo = $con->getConexao();
            $stmt = $pdo->prepare('select * from aplicativo ;');
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                return $stmt;
            } else {
                return false;
            }
        }

        public function selectAplicativoId_aplicativo($id_aplicativo)
        {

            $con = new conexao();
            $pdo = $con->getConexao();
            $stmt = $pdo->prepare('select * from aplicativo where id_aplicativo = :id_aplicativo;');
            $stmt->bindValue(':id_aplicativo', $id_aplicativo);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                return $stmt;
            } else {
                return false;
            }
        }

        public function selectAplicativoCliente($cliente)
        {

            $con = new conexao();
            $pdo = $con->getConexao();
            $stmt = $pdo->prepare('select * from aplicativo where id_cliente = :cliente;');
            $stmt->bindValue(':cliente', $cliente);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                return $stmt;
            } else {
                return false;
            }
        }

        public function selectAplicativoNome_pacote($nome_pacote)
        {

            $con = new conexao();
            $pdo = $con->getConexao();
            $stmt = $pdo->prepare('select * from aplicativo where nome_pacote = :nome_pacote;');
            $stmt->bindValue(':nome_pacote', $nome_pacote);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                return $stmt;
            } else {
                return false;
            }
        }

        public function selectAplicativoChave($chave)
        {

            $con = new conexao();
            $pdo = $con->getConexao();
            $stmt = $pdo->prepare('select * from aplicativo where chave = :chave;');
            $stmt->bindValue(':chave', $chave);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                return $stmt;
            } else {
                return false;
            }
        }

        public function selectAplicativoDominio($dominio)
        {

            $con = new conexao();
            $pdo = $con->getConexao();
            $stmt = $pdo->prepare('select * from aplicativo where dominio = :dominio;');
            $stmt->bindValue(':dominio', $dominio);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                return $stmt;
            } else {
                return false;
            }
        }

        public function selectAplicativoArquivo_firebase($arquivo_firebase)
        {

            $con = new conexao();
            $pdo = $con->getConexao();
            $stmt = $pdo->prepare('select * from aplicativo where arquivo_firebase = :arquivo_firebase;');
            $stmt->bindValue(':arquivo_firebase', $arquivo_firebase);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                return $stmt;
            } else {
                return false;
            }
        }

        public function editar()
        {
            $aplicativo = new Aplicativo($_POST);
            $oldApp = new Aplicativo($this->selectAplicativoId_aplicativo($aplicativo->getIdAplicativo())->fetch());
            $con = new conexao();
            $pdo = $con->getConexao();
            $stmt = $pdo->prepare('update aplicativo set id_cliente = :cliente , nome_pacote = :nome_pacote , chave_atualizacao = :chave, arquivo_firebase = :arquivo_firebase where id_aplicativo = :id_aplicativo;');
            if ($_FILES['chave']['name'] != "") {
                unlink(".." . self::REPO_KEYS . $oldApp->getChaveAtualizacao());
                $nome = hash_file('md5', $_FILES['chave']['tmp_name']);
                $ext = explode('.', $_FILES['chave']['name']);
                $extensao = "." . $ext[(count($ext) - 1)];
                $extensao = strtolower($extensao);
                move_uploaded_file($_FILES['chave']["tmp_name"], '..' . self::REPO_KEYS. $nome . $extensao);
                $stmt->bindValue(':chave', $nome . $extensao);
            } else {
                $stmt->bindValue(':chave', $oldApp->getChaveAtualizacao());
            }

            if ($_FILES['arquivo_firebase']['name'] != "") {
                unlink(".." . self::REPO_FIREBASE . $oldApp->getArquivoFirebase());
                $nome = hash_file('md5', $_FILES['arquivo_firebase']['tmp_name']);
                $ext = explode('.', $_FILES['arquivo_firebase']['name']);
                $extensao = "." . $ext[(count($ext) - 1)];
                $extensao = strtolower($extensao);
                move_uploaded_file($_FILES['arquivo_firebase']["tmp_name"], '..' . self::REPO_FIREBASE. $nome . $extensao);
                $stmt->bindValue(':arquivo_firebase', $nome . $extensao);
            } else {
                $stmt->bindValue(':arquivo_firebase', $oldApp->getArquivoFirebase());
            }

            $stmt->bindValue(':cliente', $aplicativo->getIdCliente());
            $stmt->bindValue(':nome_pacote', $aplicativo->getNomePacote());
            $stmt->bindValue(":id_aplicativo", $aplicativo->getIdAplicativo());
            $stmt->execute();
            if($stmt->execute()) {
                $_SESSION['toast'][] = "Aplicativo atualizado";
                header("Location: ../Tela/listagemAplicativo.php");
            } else {
                $_SESSION['toast'][] = "Erro ao atualizar aplicativo";
                header("Location: ../Tela/editarAplicativo.php?id=".$aplicativo->getIdAplicativo());
            }
        }

        public function deleteAplicativo($definir)
        {
            $aplicativo = new Aplicativo($this->selectAplicativoId_aplicativo($definir)->fetch());
            $con = new conexao();
            $pdo = $con->getConexao();
            $stmt = $pdo->prepare('delete from aplicativo where id_aplicativo = :definir ;');
            $stmt->bindValue(':definir', $definir);
            if ($stmt->execute()) {
                unlink("..".self::REPO_KEYS.$aplicativo->getChaveAtualizacao());
                unlink("..".self::REPO_FIREBASE.$aplicativo->getArquivoFirebase());
                $_SESSION['toast'][] = "Aplicativo exluido com sucesso";
                return $stmt->rowCount();
            } else {
                $_SESSION['toast'][] = "Erro ao exluir";
            }
        }

        public function deletar()
        {
            $this->deleteAplicativo($_GET['id']);
            header('location: ../Tela/listagemAplicativo.php');
        }

        /* chave */
    }
