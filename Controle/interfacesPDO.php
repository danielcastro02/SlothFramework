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
                        <div class='row'>
                            <?php
                            if (isset(\$_GET['msg'])) {
                                if (\$_GET['msg'] == \"erro\") {
                                    echo \"LOGIN OU SENHA INCORRETOS!\";
                                }
                            }
                            ?>
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

";
        file_put_contents("../Tela/login.php", $conteudo);
        $interfacePDO = new interfacesPDO();
        $interfacePDO->adicionaItemNav($semente, "login.php", "login");
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
        $intefacePDO = new interfacesPDO();
        $intefacePDO->adicionaItemNav($semente, 'registroUsuario.php', 'registro');
        header('location: ../Tela/registroUsuario.php');
    }

    function criarListagem() {
        $semente = new gerador();
        $semente->setNome($_POST['nome']);
        $bancoPDO = new bancoPDO();
        $geradorPDO = new geradorPDO();
        $nomeMaiuscula = ucfirst($semente->getNome());
        $nomeNormal = $semente->getNome();
        $colunas = $bancoPDO->selectColunas($semente->getNome());
        while ($linha = $colunas->fetch()) {
            $atributos[] = $linha[0];
        }
        $semente->setAtributo($atributos);
        $conteudo = "<!DOCTYPE html>
<html>
    <head>
        <meta charset=\"UTF-8\">
        <title>Listagem $nomeMaiuscula</title>
        <?php
            include_once '../Base/header.php';
            include_once '../Controle/" . $nomeNormal . "PDO.php';
            include_once '../Modelo/" . $nomeMaiuscula . ".php';
            \$" . $nomeNormal . "PDO = new " . $nomeNormal . "PDO();
        ?>
        <body class=\"homeimg\">
        <?php
        include_once '../Base/navBar.php';
        ?>
        <main>
            <div class=\"row \" style=\"margin-top: 5vh;\">
                <table class=\" card col s10 offset-s1 center\">
                <h4 class='center'>Listagem $nomeMaiuscula</h4>
                    <tr class=\"center\">
";
        foreach ($atributos as $att) {
            $conteudo = $conteudo . "
                        <td class='center'>" . ucfirst($att) . "</td>";
        }
        $conteudo = $conteudo . "
                        <td class='center'>Editar</td>
                        <td class='center'>Excluir</td>
                    </tr>
                    <?php
                    \$stmt = \$" . $nomeNormal . "PDO->select" . $nomeMaiuscula . "();
                        
                    if (\$stmt) {
                        while (\$linha = \$stmt->fetch()) {
                            \$" . $nomeNormal . " = new " . $nomeNormal . "(\$linha);
                            ?>
                        <tr>";
        foreach ($atributos as $att) {
            $conteudo = $conteudo . "
                            <td class=\"center\"><?php echo \$" . $nomeNormal . "->get" . ucfirst($att) . "()?></td>";
        }
        $conteudo = $conteudo . "
                            <td class = 'center'><a href=\"./editar" . $nomeMaiuscula . ".php?id=<?php echo \$" . $nomeNormal . "->get" . $atributos[0] . "()?>\">Editar</a></td>
                            <td class=\"center\"><a href=\"../Controle/" . $nomeNormal . "Controle.php?function=deletar&id=<?php echo \$" . $nomeNormal . "->get" . $atributos[0] . "()?>\">Excluir</a></td>
                        </tr>
                                <?php
                        }
                    }
                    ?>
                    </table>
            </div>
        </main>
        <?php
        include_once '../Base/footer.php';
        ?>
    </body>
</html>

";
        file_put_contents("../Tela/listagem" . $nomeMaiuscula . ".php", $conteudo);
        $intefacePDO = new interfacesPDO();
        $intefacePDO->adicionaItemNav($semente, "listagem" . $nomeMaiuscula . ".php", 'listagem');

        header('location: ../Tela/listagem' . $nomeMaiuscula . '.php');
    }

    public function telaInsert() {
        $tabela = $_POST['nome'];
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
                $conteudo = $conteudo . "
            \$stmt->bindValue(':" . $atributos[$i] . "', \$" . $nomeNormal . "->get" . ucfirst($atributos[$i]) . "());    
        ";
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
                        <h4 class=\"textoCorPadrao2\">Cadastrar $nome</h4>";
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
                    <div class=\"row center\">
                        <a href=\"../index.php\" class=\"corPadrao3 btn\">Voltar</a>
                        <input type=\"submit\" class=\"btn corPadrao2\" value=\"Cadastrar\">
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

        file_put_contents("../Tela/registro$nome.php", $conteudo);

        $intefacePDO = new interfacesPDO();
        $intefacePDO->adicionaItemNav($semente, "registro$nome.php", 'registro');
        header("location: ../Tela/registro$nome.php");
    }

    public function telaEditar() {
        $tabela = $_POST['nome'];
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
        if (preg_match("/*editar*/", $pdoantiga)) {
            $pdoantiga = explode("/*editar*/", $pdoantiga);
            $pdoantiga = $pdoantiga[0] . $pdoantiga[2];
        }

        $pdoantigapartes = explode("/*chave*/", $pdoantiga);
        $conteudo = $pdoantigapartes[0] . "
            /*editar*/
            function editar" . "() {
                \$" . $nomeNormal . " = new " . $nome . "(\$_POST);
                    if(\$this->update$nome(\$" . $nomeNormal . ") > 0){
                        header('location: ../index.php?msg=" . $nomeNormal . "Alterado');
                    } else {
                        header('location: ../index.php?msg=" . $nomeNormal . "ErroAlterar');
                    }
            }
            /*editar*/
            /*chave*/
            }
                ";
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
        <?php
        include_once '../Controle/" . $nomeNormal . "PDO.php';
        \$" . $nome . " = new " . $nomeNormal . "PDO();
            \$stmt = $" . $nome . "->select" . $nome . ucfirst($atributos[0]) . "(\$_GET['id']);
                \$nomeNormal = new " . $nome . "(\$stmt->fetch());
        ?>
        <main>
            <div class=\"row\" style=\"margin-top: 10vh;\">
                <form action=\"../Controle/" . $tabela . "Controle.php?function=editar\" class=\"card col l8 offset-l2 m10 offset-m1 s10 offset-s1\" method=\"post\">
                    <div class=\"row center\">
                        <h4 class=\"textoCorPadrao2\">Editar $nome</h4>";
        for ($i = 0; $i < (count($atributos)); $i++) {
            if ($i == 0) {
                $conteudo = $conteudo . "
                        <div class=\"input-field col s6\" hidden>
                            <input type=\"text\" name=\"$atributos[$i]\" value=\"<?= \$nomeNormal->get" . ucfirst($atributos[$i]) . "() ?>\">
                            <label>" . $atributos[$i] . "</label>
                        </div>";
            } else {
                $conteudo = $conteudo . "
                        <div class=\"input-field col s6\">
                            <input type=\"text\" name=\"$atributos[$i]\" value=\"<?= \$nomeNormal->get" . ucfirst($atributos[$i]) . "() ?>\">
                            <label>" . $atributos[$i] . "</label>
                        </div>";
            }
        }

        $conteudo = $conteudo . "
                    <div class=\"row center\">
                        <a href=\"../index.php\" class=\"corPadrao3 btn\">Voltar</a>
                        <input type=\"submit\" class=\"btn corPadrao2\" value=\"Alterar\">
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

        file_put_contents("../Tela/editar$nome.php", $conteudo);
        header("Location: ./interfacesControle.php?function=criarListagem", TRUE, 307);
    }

    function criarNavBar() {
        $conteudo = "<?php
\$pontos = \"\";
if (realpath(\"./index.php\")) {
    \$pontos = './';
} else {
    if (realpath(\"../index.php\")) {
        \$pontos = '../';
    } else {
        if (realpath(\"../../index.php\")) {
            \$pontos = '../../';
        }
    }
}
?>

<nav class=\"nav-extended white\">
    <div class=\"nav-wrapper\" style=\"width: 100vw; margin-left: auto; margin-right: auto;\">
        <a href=\"<?php echo \$pontos; ?>./Tela/home.php\" class=\"brand-logo left black-text\">Sloth</a>
        <ul class=\"right hide-on-med-and-down\">
            <!--proximo-->
        </ul>
    </div>
</nav>
<script>
$('.dropdown-trigger').dropdown({
        coverTrigger: false,
    });
</script>
";
        file_put_contents("../Base/navBar.php", $conteudo);
    }

    function adicionaObjetoNav(gerador $semente) {
        if (!realpath("../Base/navBar.php")) {
            $this->criarNavBar();
        }
        $nav = file_get_contents("../Base/navBar.php");
        if (!preg_match("<!--" . $semente->getNome() . "-->", $nav)) {

            $nav = explode("<!--proximo-->", $nav);

            $conteudo = $nav[0] . "
            <!--" . $semente->getNome() . "-->
            <li>
                <a class='dropdown-trigger center black-text' style=\"background-color: transparent\" data-hover=\"true\" href='#' data-target='" . $semente->getNome() . "'>" . ucfirst($semente->getNome()) . "</a>
                <ul id='" . $semente->getNome() . "' class='dropdown-content'>
                    <!--" . $semente->getNome() . "item-->
                </ul>
            </li>
            <!--" . $semente->getNome() . "-->
            <!--proximo-->

" . $nav[1];
            file_put_contents("../Base/navBar.php", $conteudo);
        }
    }

    function adicionaItemNav(gerador $semente, $nomearquivo, $funcao) {
        $nav = file_get_contents("../Base/navBar.php");
        if (preg_match("<!--" . $semente->getNome() . "$funcao-->", $nav)) {
            $nav = explode("<!--" . $semente->getNome() . "$funcao-->", $nav);
            $nav = $nav[0] . $nav[2];
        }
        $nav = explode("<!--" . $semente->getNome() . "item-->", $nav);
        $conteudo = $nav[0] . "<!--" . $semente->getNome() . $funcao . "-->
                    <li><a href=\"<?php echo \$pontos; ?>./Tela/$nomearquivo\">$funcao</a></li>
                    <!--" . $semente->getNome() . "$funcao-->
                    <!--" . $semente->getNome() . "item-->
                " . $nav[1];
        file_put_contents("../Base/navBar.php", $conteudo);
    }

}
