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
            
            <!--aplicativo-->
            <li>
                <a class='dropdown-trigger center black-text' style="background-color: transparent" data-hover="true" href='#' data-target='aplicativo'>Aplicativo</a>
                <ul id='aplicativo' class='dropdown-content'>
                    <!--aplicativoregistro-->
                    <li><a href="<?php echo $pontos; ?>./Tela/registroAplicativo.php">registro</a></li>
                    <!--aplicativoregistro-->
                    <!--aplicativolistagem-->
                    <li><a href="<?php echo $pontos; ?>./Tela/listagemAplicativo.php">listagem</a></li>
                    <!--aplicativolistagem-->
                    <!--aplicativoitem-->
                
                
                </ul>
            </li>
            <!--aplicativo-->
            
            <!--usuario-->
            <li>
                <a class='dropdown-trigger center black-text' style="background-color: transparent" data-hover="true" href='#' data-target='usuario'>Usuario</a>
                <ul id='usuario' class='dropdown-content'>
                    <!--usuariologin-->
                    <li><a href="<?php echo $pontos; ?>./Tela/login.php">login</a></li>
                    <!--usuariologin-->
                    <!--usuarioregistro-->
                    <li><a href="<?php echo $pontos; ?>./Tela/registroUsuario.php">registro</a></li>
                    <!--usuarioregistro-->
                    <!--usuarioitem-->
                
                
                </ul>
            </li>
            <!--usuario-->
            <!--proximo-->




        </ul>
    </div>
</nav>
<script>
$('.dropdown-trigger').dropdown({
        coverTrigger: false,
    });
</script>
