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

<nav class="nav-extended white">
    <div class="nav-wrapper" style="width: 100vw; margin-left: auto; margin-right: auto;">
        <a href="<?php echo $pontos; ?>./Tela/home.php" class="brand-logo left black-text">Sloth</a>
        <ul class="right hide-on-med-and-down">
            <li>
                <a class='dropdown-trigger center black-text' style="background-color: transparent" data-hover="true" href='#' data-target='adm'>Administração</a>
                <ul id='adm' class='dropdown-content'>
                    <li><a href="<?php echo $pontos; ?>./Tela/registroUsuario.php">Cadastrar Usuário</a></li>
                </ul>
            </li>
            <li>
                <a class='dropdown-trigger center black-text' style="background-color: transparent" data-hover="true" href='#' data-target='projetos'>Projetos</a>
                <ul id='projetos' class='dropdown-content'>
                    <li><a href="<?php echo $pontos; ?>./Tela/registroProjeto.php">Registrar</a></li>
                    <li><a href="<?php echo $pontos; ?>./Tela/listagemProjeto.php">Ver Projetos</a></li>
                </ul>
            </li>
            <li>
                <a class='dropdown-trigger center black-text' style="background-color: transparent" data-hover="true" href='#' data-target='versao'>Versões</a>
                <ul id='versao' class='dropdown-content'>
                    <li><a href="<?php echo $pontos; ?>./Tela/registroVersao.php">Registrar</a></li>
                </ul>
            </li>
            <li>
                <a class='dropdown-trigger center black-text' style="background-color: transparent" data-hover="true" href='#' data-target='aplicativo'>Aplicativos</a>
                <ul id='aplicativo' class='dropdown-content'>
                    <li><a href="<?php echo $pontos; ?>./Tela/registroAplicativo.php">Registrar</a></li>
                    <li><a href="<?php echo $pontos; ?>./Tela/listagemAplicativo.php">Ver aplicativos</a></li>
                </ul>
            </li>
            <li>
                <a class='dropdown-trigger center black-text' style="background-color: transparent" data-hover="true" href='#' data-target='site'>Sites</a>
                <ul id='site' class='dropdown-content'>
                    <li><a href="<?php echo $pontos; ?>./Tela/registroSite.php">Registrar</a></li>
                    <li><a href="<?php echo $pontos; ?>./Tela/listagemSite.php">Ver Sites</a></li>
                </ul>
            </li>
            <li>
                <a class='dropdown-trigger center black-text' style="background-color: transparent" data-hover="true" href='#' data-target='cliente'>Cliente</a>
                <ul id='cliente' class='dropdown-content'>
                    <li><a href="<?php echo $pontos; ?>./Tela/registroCliente.php">Registro</a></li>
                    <li><a href="<?php echo $pontos; ?>./Tela/listagemCliente.php">Listagem</a></li>
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
