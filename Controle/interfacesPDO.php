<?php

if (realpath("./index.php") && realpath("./conexao.php")) {
    include_once "./Modelo/Gerador.php";
    include_once "./Controle/conexao.php";
    include_once "./Controle/geradorPDO.php";
    include_once "./Controle/bancoPDO.php";
} else {
    if (realpath("../index.php") && realpath("../Controle/conexao.php")) {
        include_once "../Modelo/Gerador.php";
        include_once "../Controle/conexao.php";
        include_once "../Controle/geradorPDO.php";
        include_once "../Controle/bancoPDO.php";
    } else {
        if (realpath("../../index.php") && realpath("../../Controle/conexao.php")) {
            include_once "../../Modelo/Gerador.php";
            include_once "../../Controle/conexao.php";
            include_once "../../Controle/geradorPDO.php";
            include_once "../../Controle/bancoPDO.php";
        } else {
            header('location: ../Tela/criaConexao.php');
        }
    }
}

class interfacesPDO {

    function criarLogin() {
        $tabela = $_POST['nome'];
        $usuario = $_POST['usuario'];
        $senha = $_POST['senha'];
        if (!realpath("../Modelo/" . ucfirst($tabela) . ".php")) {
            $geradorPDO = new geradorPDO();
            $bancoPDO = new bancoPDO();
            $colunas = $bancoPDO->selectColunas($tabela);
            $semente = new gerador();
            $semente->setNome($tabela);
            $atributos = [];
            while ($linha = $colunas->fetch()) {
                $atributos[] = $linha[0];
            }
            $semente->setAtributo($atributos);
            $geradorPDO->geraModelo($semente);
        }

        $pdoantiga = file_get_contents("../Controle/" . $tabela . "PDO.php");
        $pdoantigapartes = explode("/*login*/", $pdoantiga); 
        $pdoantiga = $pdoantigapartes[0].$pdoantigapartes[2];
        $pdoantiga = str_replace("/*chave*/}", "", $pdoantiga);
        
        $conteudo = $pdoantiga . "
            /*login*/
    public function login() {
        \$con = new conexao();
        \$pdo = \$con->getConexao();
        \$senha = md5(\$_POST['$senha']);
        \$stmt = \$pdo->prepare(\"SELECT * FROM $tabela WHERE $usuario LIKE :$usuario AND $senha LIKE :$senha\");
        \$stmt->bindValue(\":$usuario\", \$_POST['$usuario']);
        \$stmt->bindValue(\":$senha\", \$senha);
        \$stmt->execute();
        if (\$stmt->rowCount() > 0) {
            \$linha = \$stmt->fetch(PDO::FETCH_ASSOC);
            \$_SESSION['logado'] = serialize(new " . ucfirst($tabela) . "(\$linha));
            header(\"Location: ../index.php\");
        } else {
            header(\"Location: ../Tela/login.php?msg=erro\");
        }
    }
    
    function logout(){
        session_destroy();
        header('location: ../Tela/login.php');
    }
    
/*login*/

/*chave*/}
";
        file_put_contents("../Controle/" . $tabela . "PDO.php", $conteudo);

        $conteudo = "<!DOCTYPE html>
            <?php
            if(isset(\$_SESSION['logado'])){
                header('location: ../Tela/home.php');
            }
?>

<html>
    <head>
        <meta charset=\"UTF-8\">
        <title>Login</title>
        <?php
        include_once '../Base/header.php';
        ?>
    <body class=\"homeimg\">
        <?php
        include_once '../Base/navPadrao.php';
        ?>
        <main>
            <div class=\"row\" style=\"margin-top: 15vh;\">
                <form action=\"../Controle/" . $tabela . "Controle.php?function=login\" class=\"card col l6 offset-l3 m8 offset-m2 s10 offset-s1\" method=\"post\">
                    <div class=\"row center\">
                        <h4 class=\"textoCorPadrao2\">Faça Login</h4>
                        <div class=\"input-field col s10 offset-s1\">
                            <input type=\"text\" name=\"$usuario\">
                            <label>Usuario</label>
                        </div>
                        <div class=\"input-field col s10 offset-s1\">
                            <input type=\"password\" name=\"$senha\">
                            <label>Senha</label>
                        </div>
                        <div class=\"row center\">
                            <a href=\"../index.php\" class=\"corPadrao3 btn\">Voltar</a>
                            <input type=\"submit\" class=\"btn corPadrao2\" value=\"Login\">
                        </div>
                    </div>
                </form>
            </div>
        </main>
        <?php
        include_once '../Base/footer.php';
        ?>
    </body>
</html>
<?php
if (isset(\$_GET['msg'])) {
    if (\$_GET['msg'] == \"erro\") {
        echo \"LOGIN OU SENHA INCORRETOS!\";
    }
}
?>
";
        file_put_contents("../Tela/login.php", $conteudo);
        header('location: ../Tela/login.php');
    }

}
