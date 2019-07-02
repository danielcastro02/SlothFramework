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
        if (!realpath("../Modelo/" . ucfirst($tabela) . ".php")) {

            $geradorPDO->geraModelo($semente);
        }

        $pdoantiga = file_get_contents("../Controle/" . $tabela . "PDO.php");
        $pdoantigapartes = explode("/*login*/", $pdoantiga);
        if (count($pdoantigapartes) > 1) {
            $pdoantiga = $pdoantigapartes[0] . $pdoantigapartes[2];
        }
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
        include_once '../Base/navBar.php';
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
                    </div>
                    <div class=\"row center\">
                        <a href=\"../index.php\" class=\"corPadrao3 btn\">Voltar</a>
                        <input type=\"submit\" class=\"btn corPadrao2\" value=\"Login\">
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

        $navbar = file_get_contents("../Base/navBar.php");
        $filtro = explode("<!--" . $semente->getNome() . "login-->", $navbar);
        if (count($filtro) > 1) {
            $navbar = $filtro[0] . $filtro[2];
        }
        $partes = explode("<!--" . $semente->getNome() . "item-->", $navbar);
        $conteudo = $partes[0] . "
            <!--" . $semente->getNome() . "login-->
                <li><a href=\"<?php echo \$pontos; ?>./Tela/login.php\">Login</a></li>
            <!--" . $semente->getNome() . "login-->
                
            <!--" . $semente->getNome() . "item-->
            <!--" . $semente->getNome() . "item-->
" . $partes[2];
        file_put_contents("../Base/navBar.php", $conteudo);
        header('location: ../Tela/login.php');
    }

    function insertUsuario() {
        $tabela = $_POST['nome'];
        $usuario = $_POST['usuario'];
        $senha = $_POST['senha'];
        $bancoPDO = new bancoPDO();
        $geradorPDO = new geradorPDO();
        $nome = ucfirst($tabela);
        $nomeNormal = $tabela;
        $colunas = $bancoPDO->selectColunas($tabela);
        while ($linha = $colunas->fetch()) {
            $atributos[] = $linha[0];
        }
        $semente = new gerador();
        $semente->setNome($tabela);
        $semente->setAtributo($atributos);
        if (!realpath("../Controle/$tabela" . "PDO.php")) {

            $geradorPDO->geraModelo($semente);
        }
        $pdoantiga = file_get_contents("../Controle/" . $tabela . "PDO.php");
        $pdoantigapartes = explode("/*inserir*/", $pdoantiga);
        $conteudo = $pdoantigapartes[0] . "
             /*inserir*/
    function inserir" . $nome . "() {
        \$" . $nomeNormal . " = new " . $nomeNormal . "(\$_POST);
        if(\$_POST['senha1'] == \$_POST['senha2']){
            \$senhamd5 = md5(\$_POST['senha1']);
            \$con = new conexao();
            \$pdo = \$con->getConexao();
            \$stmt = \$pdo->prepare('insert into " . $nome . " values(";
        $conteudo = $conteudo . "default , ";
        $verificaDefault = true;
        for ($i = 1; $i < (count($atributos) - 1); $i++) {
            $conteudo = $conteudo . ":" . $atributos[$i] . " , ";
        }
        $conteudo = $conteudo . ":" . $atributos[$i] . ");' ";
        $conteudo = $conteudo . ");\n";
        if ($verificaDefault) {
            for ($i = 1; $i < count($atributos); $i++) {
                if ($atributos[$i] != $senha) {
                    $conteudo = $conteudo . "
            \$stmt->bindValue(':" . $atributos[$i] . "', \$" . $nomeNormal . "->get" . ucfirst($atributos[$i]) . "());    
        ";
                } else {
                    $conteudo = $conteudo . "
            \$stmt->bindValue(':" . $atributos[$i] . "', \$senhamd5);    
        ";
                }
            }
        } else {
            for ($i = 0; $i < count($atributos); $i++) {
                $conteudo = $conteudo . "
            \$stmt->bindValue(':" . $atributos[$i] . "', \$" . $nomeNormal . "->get" . ucfirst($atributos[$i]) . "());    
        ";
            }
        }
        $conteudo = $conteudo . "
            if(\$stmt->execute()){ 
                header('location: ../index.php?msg=" . $nomeNormal . "Inserido');
            }else{
                header('location: ../index.php?msg=" . $nomeNormal . "ErroInsert');
            }
        } else{
            header('location: ../Tela/registroUsuario.php?msg=senhaerrada');      
        }
    }
    /*inserir*/
                " . $pdoantigapartes[2];
        file_put_contents("../Controle/" . $nomeNormal . "PDO.php", $conteudo);

        $conteudo = "<!DOCTYPE html>
<html>
    <head>
        <meta charset=\"UTF-8\">
        <title>Login</title>
        <?php
        include_once '../Base/header.php';
        ?>
    <body class=\"homeimg\">
        <?php
        include_once '../Base/navBar.php';
        ?>
        <main>
            <div class=\"row\" style=\"margin-top: 10vh;\">
                <form action=\"../Controle/" . $tabela . "Controle.php?function=inserir$nome\" class=\"card col l8 offset-l2 m10 offset-m1 s10 offset-s1\" method=\"post\">
                    <div class=\"row center\">
                        <h4 class=\"textoCorPadrao2\">Registre-se</h4>";
        for ($i = 1; $i < (count($atributos)); $i++) {
            if ($atributos[$i] != $senha) {
                $conteudo = $conteudo . "
                        <div class=\"input-field col s6\">
                            <input type=\"text\" name=\"$atributos[$i]\">
                            <label>" . $atributos[$i] . "</label>
                        </div>";
            }
        }

        $conteudo = $conteudo . "
                        <div class = \"input-field col s6\">
                            <input type=\"password\" name=\"senha1\">
                            <label>Senha</label>
                        </div>
                        <div class = \"input-field col s6\">
                            <input type=\"password\" name=\"senha2\">
                            <label>Repita a senha</label>
                        </div>
                    </div>
                    <div class=\"row center\">
                        <a href=\"../index.php\" class=\"corPadrao3 btn\">Voltar</a>
                        <input type=\"submit\" class=\"btn corPadrao2\" value=\"Login\">
                        <?php
if (isset(\$_GET['msg'])) {
    if (\$_GET['msg'] == \"senhaerrada\") {
        echo \"Senhas não coincidem!\";
    }
}
?>
                    </div>
                    
                </form>
            </div>
        </main>
        <?php
        include_once '../Base/footer.php';
        ?>
    </body>
</html>

";

        file_put_contents("../Tela/registroUsuario.php", $conteudo);

        $navbar = file_get_contents("../Base/navBar.php");
        $filtro = explode("<!--" . $semente->getNome() . "registro-->", $navbar);
        $navbar = $filtro[0] . $filtro[2];
        $partes = explode("<!--" . $semente->getNome() . "item-->", $navbar);
        $conteudo = $partes[0] . "
            <!--" . $semente->getNome() . "registro-->
                <li><a href=\"<?php echo \$pontos; ?>./Tela/registroUsuario.php\">Registro</a></li>
            <!--" . $semente->getNome() . "registro-->
                
            <!--" . $semente->getNome() . "item-->
            <!--" . $semente->getNome() . "item-->
" . $partes[2];
        file_put_contents("../Base/navBar.php", $conteudo);
        header('location: ../Tela/registroUsuario.php');
    }

}
