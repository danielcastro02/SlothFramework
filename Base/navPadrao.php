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

<nav class="nav-extended corpadrao">
    <div class="nav-wrapper">
        <a href="<?php echo $pontos; ?>./Tela/Sistema/home.php" class="brand-logo">Sistema para Associação</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <!-- Dropdown Trigger -->
            <li><a class='dropdown-trigger' data-target='dropdown1'>
                    <?php
                    $usuario = new usuario();
                    $usuario = unserialize($_SESSION['usuario']);
                    echo $usuario->getNome();
                    ?></a></li>
            <ul id='dropdown1' class='dropdown-content'>
                <li><a><b>
                    <?php
                    echo $usuario->getNome();
                    ?>
                        </b></a></li>
                <li><a href="<?php echo $pontos; ?>Tela/Update/alterarDadosUsuario.php">Alterar Dados Pessoais</a></li>
                <li><a href="<?php echo $pontos; ?>Tela/Update/alterarEnderecoUsuario.php">Alterar Endereço</a></li>
                <?php 
                    if(isset($_SESSION['aluno'])){
                        ?>
                <li><a href="<?php echo $pontos; ?>Tela/Update/alterarCurso.php">Alterar Curso</a></li>
                <?php
                    }
                ?>
            </ul>
            <li><a href="<?php echo $pontos; ?>Controle/usuarioControle.php?function=logout">Sair</a></li>
        </ul>
    </div>
</nav>

<script>

    $('.dropdown-trigger').dropdown({
    hover: false
    });

</script>
