<?php
$pontos = "";
if (realpath("./index.php")) {
    $pontos = './';
} else {
    if (realpath("../index.php")) {
        $pontos = '../';
    } else {
        if (realpath("../../index.php")) {
            $pontos = '../../';
        }
    }
}
?>

<nav class="nav-extended black">
    <div class="nav-wrapper" style="width: 100vw; margin-left: auto; margin-right: auto;">
        <a href="<?php echo $pontos; ?>./Tela/home.php" class="brand-logo center">SlothFramework</a>
        <ul class="right hide-on-med-and-down">
            <li>
                <a class='dropdown-trigger center' style="background-color: transparent" data-hover="true" href='#' data-target='dropdown4'>Interfaces</a>
                <ul id='dropdown4' class='dropdown-content'>
                    <li><a href="<?php echo $pontos; ?>./Tela/criaLogin.php">Criar Login</a></li>
                    <li><a href="<?php echo $pontos; ?>./Tela/criaregistroUsuario.php">Criar Registro Usuario</a></li>
                    <li class="divider"></li>
                </ul>

            </li>
            <li>
                <a class='dropdown-trigger center' style="background-color: transparent" data-hover="true" href='#' data-target='dropdown1'>SQL</a>
                <ul id='dropdown1' class='dropdown-content'>
                    <li><a href="<?php echo $pontos; ?>./Tela/criaConexao.php">Criar Conexão</a></li>
                    <li class="divider"></li>
                    <li><a href="<?php echo $pontos; ?>./Tela/criaTabela.php">Criar Tabela</a></li>
                </ul>

            </li>
            <li>
                <a class='dropdown-trigger' style="background-color: transparent" data-belowOrigin="true" href='#' data-target='dropdown2'>Objetos</a>
                <ul id='dropdown2' class='dropdown-content'>
                    <li><a href="<?php echo $pontos; ?>./Tela/criaObjeto.php">Criar a partir de tabela</a></li>
                    <li class="divider"></li>
                    <li><a href="<?php echo $pontos; ?>./Controle/bancoControle.php?function=criarTudo">Criar todo banco</a></li>
                </ul>

            </li>


            <li>
                <a class='dropdown-trigger' href='#' data-target='dropdown3'>Incluir bibliotecas</a>
                <ul id='dropdown3' class='dropdown-content'>
                    <li><a href="<?php echo $pontos; ?>./Controle/bibliotecaControle.php?function=phpmailer">PHPMailer</a></li>
                    <li><a href="<?php echo $pontos; ?>./Controle/bibliotecaControle.php?function=html2pdf">HTML2PDF</a></li>
                    <li><a href="<?php echo $pontos; ?>./Controle/bibliotecaControle.php?function=composer">Composer</a></li>
                </ul>

            </li>
            <li>
                <a href="<?php echo $pontos; ?>./Controle/autoDelete.php" id="autodelete">Auto Destruir</a>
            </li>
        </ul>
    </div>

</nav>

<script>
    $("#autodelete").click(function () {
        if (confirm("Você tem certeza absoluta do que esta fazendo???")) {
            if (confirm("Isto vai apagar todo o framework, você realmente tem ceteza???")) {
                if (confirm("Absoluta???")) {
                    alert("ok...");
                    alert("Ok");
                    alert("OK!!!");
                    if (confirm("Tem certeza que tem certeza???")) {
                        return true;
                    }else{
                        return false;
                    }
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    });
    $('.dropdown-trigger').dropdown({
        coverTrigger: false,
    });

</script>
