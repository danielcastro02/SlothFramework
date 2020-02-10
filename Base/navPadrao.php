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
include_once __DIR__."/../Modelo/Parametros.php";
$parametros = new Parametros();
?>

<nav class="nav-extended black">
    <div class="nav-wrapper" style="width: 100vw; margin-left: auto; margin-right: auto;">
        <a href="<?php echo $pontos; ?>./Tela/home.php" class="brand-logo">SlothFramework</a>
        <ul class="right hide-on-med-and-down">
            <li><a class="center" href="#!"><?php echo $parametros->getNomeDb() ?></a> </li>
            <li><a class="center" href="#!" id="defineBanco">Definir banco</a> </li>
            <li><a class="center" href="#!"><?php echo $parametros->getDestino() ?></a> </li>
            <li><a class="center" href="#!" id="defineCaminho">Definir destino</a> </li>
            <li>

                <a class='dropdown-trigger center' style="background-color: transparent" data-hover="true" href='#' data-target='dropdown4'>Interfaces</a>
                <ul id='dropdown4' class='dropdown-content'>
                    <li><a href="<?php echo $pontos; ?>./Tela/criaLogin.php">Criar Login</a></li>
                    <li><a href="<?php echo $pontos; ?>./Tela/criaRegistroUsuario.php">Criar Registro Usuario</a></li>
                    <li><a href="<?php echo $pontos; ?>./Tela/criaTelaRegistro.php">Criar Registros</a></li>
                    <li><a href="<?php echo $pontos; ?>./Tela/criaTelaEditar.php">Criar Editar Registros</a></li>
                    <li><a href="<?php echo $pontos; ?>./Tela/criaListagem.php">Criar Listagem</a></li>
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
                <?php
                if($parametros->getServer()!= "https://sloth.markeyvip.com") {
                    ?>
                    <a href="<?php echo $pontos; ?>./Controle/autoDelete.php" class="disabled" id="autodelete">Auto
                        Destruir</a>
                    <?php
                }
                ?>
            </li>
            <li><a class="center" href="<?php echo $pontos; ?>/Controle/usuarioControle.php?function=logout">Sair</a> </li>

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

    $("#defineCaminho").click(function(){
        var caminho = prompt("Insira o caiminho:");
        if(caminho!='null') {
            $.ajax({
                url: "<?php echo $pontos ?>Controle/parametrosControle.php?function=alteraDestino&destino=" + caminho,
                success: function (data) {
                    if (data == 'true') {
                        alert("Trocado!");
                        location.reload();
                    }
                }
            });
        }
    });
    $("#defineBanco").click(function(){
        var caminho = prompt("Insira o banco:");
        if(caminho!='null') {
            $.ajax({
                url: "<?php echo $pontos ?>Controle/parametrosControle.php?function=alteraBanco&nomeDb=" + caminho,
                success: function (data) {
                    if (data == 'true') {
                        alert("Trocado!");
                        location.reload();
                    }
                }
            });
        }
    });

</script>
