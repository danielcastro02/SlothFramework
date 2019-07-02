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
            <!--usuario-->
            <li>
                <a class='dropdown-trigger center black-text' style="background-color: transparent" data-hover="true" href='#' data-target='usuario'>Usuario</a>
                <ul id='usuario' class='dropdown-content'>
                    
            <!--usuariologin-->
                <li><a href="<?php echo $pontos; ?>./Tela/login.php">Login</a></li>
            <!--usuariologin-->
                
            
            <!--usuarioregistro-->
                <li><a href="<?php echo $pontos; ?>./Tela/registroUsuario.php">Registro</a></li>
            <!--usuarioregistro-->
                
            <!--usuarioitem-->
            <!--usuarioitem-->


                </ul>
            </li>
            <!--usuario-->
            <!--proximo-->
            <!--proximo-->


        </ul>
    </div>

</nav>
<script>
$('.dropdown-trigger').dropdown({
        coverTrigger: false,
    });

</script>
