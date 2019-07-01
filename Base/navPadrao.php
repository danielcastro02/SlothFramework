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
                <a class='dropdown-trigger center' style="background-color: transparent" data-hover="true" href='#' data-target='dropdown1'>SQL</a>
                <ul id='dropdown1' class='dropdown-content'>
                    <li><a href="./Tela/criaConexao.php">Criar Conexão</a></li>
                    <li class="divider"></li>
                    <li><a href="./Tela/criaTabela.php">Criar Tabela</a></li>
                </ul>

            </li>
            <li>
                <a class='dropdown-trigger' style="background-color: transparent" data-belowOrigin="true" href='#' data-target='dropdown2'>Objetos</a>
                <ul id='dropdown2' class='dropdown-content'>
                    <li><a href="./Tela/criaObjeto.php">Criar a partir de tabela</a></li>
                    <li class="divider"></li>
                    <li><a href="./Controle/bancoControle.php?function=criarTudo">Criar todo banco</a></li>
                </ul>

            </li>


            <li>
                <a class='dropdown-trigger' href='#' data-target='dropdown3'>Incluir bibliotecas</a>
                <ul id='dropdown3' class='dropdown-content'>
                    <li><a href="#!">PHPMailer</a></li>
                    <li><a href="#!">Jquery</a></li>
                    <li><a href="#!">Materialize</a></li>
                    <li><a href="#!">HTML2PDF</a></li>
                    <li><a href="#!">Chart</a></li>
                    <li><a href="<?php echo $pontos; ?>./Controle/bibliotecaControle.php?function=composer">Composer</a></li>
                </ul>

            </li>
        </ul>
    </div>

</nav>

<script>

    $('.dropdown-trigger').dropdown({
        coverTrigger: false,
    });

</script>
