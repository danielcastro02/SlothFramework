<?php
    include_once '../Base/requerLogin.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <?php
        include_once '../Base/header.php';
        include_once '../Controle/usuarioPDO.php';
        include_once '../Modelo/Usuario.php';

        $usuarioPDO = new UsuarioPDO();
        $usuario = new Usuario($usuarioPDO->selectUsuarioId_usuario($_GET['id_usuario'])->fetch());
    ?>
<body class="homeimg">
<?php
    include_once '../Base/navBar.php';
?>
<main>
    <div class="row" style="margin-top: 10vh;">
        <form action="../Controle/usuarioControle.php?function=editar" class="card col l8 offset-l2 m10 offset-m1 s10 offset-s1" method="post">
            <div class="row center">
                <input name="id_usuario" value="<?php echo $usuario->getId_usuario() ?>" hidden />
                <h4 class="textoCorPadrao2">Editar Usuário</h4>
                <div class="input-field col s6">
                    <input type="text" name="nome" id="nome" value="<?php echo $usuario->getNome() ?>">
                    <label for="nome">Nome</label>
                </div>
                <div class="input-field col s6">
                    <input type="text" name="usuario" id="usuario" value="<?php echo $usuario->getUsuario() ?>">
                    <label for="usuario">Usuário</label>
                </div>
                <div class="input-field col s6">
                    <input type="password" name="senha1" id="senha1">
                    <label for="senha1">Senha</label>
                </div>
                <div class="input-field col s6">
                    <input type="password" name="senha2" id="senha2">
                    <label for="senha2">Repita a senha</label>
                </div>
                <div class="row center">
                    <a href="./listagemUsuario.php" class="corPadrao3 btn">Voltar</a>
                    <input type="submit" class="btn corPadrao2" value="Continuar">
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

