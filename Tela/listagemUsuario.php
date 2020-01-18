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
    ?>
<body class="homeimg">
<?php
    include_once '../Base/navBar.php';
    include_once '../Controle/usuarioPDO.php';
    include_once '../Modelo/Usuario.php';

?>
<main>
    <div class="row center">
        <h5>Cliente</h5>
    </div>
    <div class="row">
        <div class="col s12 l10 offset-l1 card">
            <table>
                <tr>
                    <th class="center">Nome</th>
                    <th class="center">Usuario</th>
                    <th class="center">Editar</th>
                    <th class="center">Excluir</th>
                </tr>
                <?php
                    $usuarioPDO = new UsuarioPDO();
                    $stmt = $usuarioPDO->selectUsuario();
                    if ($stmt->rowCount() > 0) {
                        while ($linha = $stmt->fetch()) {
                            $usuario = new Usuario($linha);
                            ?>
                            <tr>
                                <td class="center"><?php echo $usuario->getNome() ?></td>
                                <td class="center"><?php echo $usuario->getUsuario() ?></td>
                                <td class="center"><a class="btn corPadrao2" href="./editarUsuario.php?id_usuario=<?php echo $usuario->getId_usuario() ?>">Editar</a></td>
                                <td class="center"><a class="btn red darken-2" href="../Controle/usuarioControle.php?function=deleteUsuario&id_usuario=<?php echo $usuario->getId_usuario() ?>">Excluir</a></td>
                            </tr>
                            <?php
                        }
                    }
                ?>
            </table>
        </div>
    </div>
</main>
<?php
    include_once '../Base/footer.php';
?>
</body>
</html>

