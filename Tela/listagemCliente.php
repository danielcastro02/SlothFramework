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
include_once '../Controle/clientePDO.php';
include_once '../Modelo/Cliente.php';

?>
<main>
    <div class="row center">
        <h5>Cliente</h5>
    </div>
    <div class="row">
        <div class="col s12 l10 offset-l1 card">
            <table>
                <tr>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>CPF/CNPJ</th>
                    <th>Detalhes</th>
                    <th>Editar</th>
                    <th>Excluir</th>
                </tr>
                <?php
                $clientePDO = new ClientePDO();
                $stmt = $clientePDO->selectCliente();
                if ($stmt->rowCount() > 0) {
                    while ($linha = $stmt->fetch()) {
                        $cliente = new Cliente($linha);
                        ?>
                        <tr>
                            <td><?php echo $cliente->getNomeCliente() ?></td>
                            <td><?php echo $cliente->getDescricaoCliente() ?></td>
                            <td><?php echo $cliente->getCpfCnpj() ?></td>
                            <td><a class="btn corPadrao2" href="./detalhesCliente.php?id_cliente=<?php echo $cliente->getIdCliente() ?>">Detalhes</a></td>
                            <td><a class="btn corPadrao2" href="./editarCliente.php?id_cliente=<?php echo $cliente->getIdCliente() ?>">Editar</a></td>
                            <td><a class="btn red darken-2" href="../Controle/clienteControle.php?function=excluir&id_cliente=<?php echo $cliente->getIdCliente() ?>">Excluir</a></td>
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

