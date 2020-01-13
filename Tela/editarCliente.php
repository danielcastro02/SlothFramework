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
        include_once '../Controle/clientePDO.php';
        include_once '../Modelo/Cliente.php';

        $clientePDO = new ClientePDO();
        $cliente = new Cliente($clientePDO->selectClienteId_cliente($_GET['id_cliente'])->fetch());
    ?>
<body class="homeimg">
<?php
    include_once '../Base/navBar.php';
?>
<main>
    <div class="row" style="margin-top: 10vh;">
        <form action="../Controle/clienteControle.php?function=editar" enctype="multipart/form-data"
              class="card col l8 offset-l2 m10 offset-m1 s10 offset-s1" method="post">
            <div class="row center">
                <h4 class="textoCorPadrao2">Editar Cliente</h4>
                <input type="text" value="<?php echo $cliente->getIdCliente(); ?>" name="id_cliente" hidden>
                <div class="input-field col s6">
                    <input type="text" name="nome_cliente" id="nome_cliente" value="<?php echo $cliente->getNomeCliente() ?>">
                    <label for="nome_cliente">Nome</label>
                </div>
                <div class="input-field col s6">
                    <input type="text" name="cpf_cnpj" id="cpf_cnpj" value="<?php echo $cliente->getCpfCnpj() ?>">
                    <label for="cpf_cnpj">CPF/CNPJ</label>
                </div>
                <div class="input-field col s12">
                    <textarea type="text" name="descricao_cliente" id="descricao_cliente"
                              class="materialize-textarea"><?php echo $cliente->getDescricaoCliente() ?></textarea>
                    <label for="descricao_cliente">Descrição</label>
                </div>
                <div class="row center">
                    <a href="../Tela/listagemCliente.php" class="corPadrao3 btn">Voltar</a>
                    <input type="submit" class="btn corPadrao2" value="Confirmar">
                </div>
            </div>
        </form>
    </div>
    <script>
        $("select").formSelect();
    </script>
</main>
<?php
    include_once '../Base/footer.php';
?>
</body>
</html>

