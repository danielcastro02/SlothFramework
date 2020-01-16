<?php
include_once '../Base/requerLogin.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Listagem Aplicativo</title>
        <?php
            include_once '../Base/header.php';
            include_once '../Controle/aplicativoPDO.php';
            include_once '../Controle/clientePDO.php';
            include_once '../Modelo/Aplicativo.php';
            include_once '../Modelo/Cliente.php';
            $aplicativoPDO = new aplicativoPDO();
            $clientePDO = new ClientePDO();
        ?>
        <body class="homeimg">
        <?php
        include_once '../Base/navBar.php';
        ?>
        <main>
            <div class="row " style="margin-top: 5vh;">
                <table class=" card col s10 offset-s1 center">
                <h4 class='center'>Listagem Aplicativo</h4>
                    <tr class="center">
                        <td class='center'>Cliente</td>
                        <td class='center'>Nome_pacote</td>
                        <td class='center'>Chave</td>
                        <td class='center'>Arquivo_firebase</td>
                        <td class='center'>Detalhes</td>
                        <td class='center'>Editar</td>
                        <td class='center'>Excluir</td>
                    </tr>
                    <?php
                    $stmt = $aplicativoPDO->selectAplicativo();
                        
                    if ($stmt) {
                        while ($linha = $stmt->fetch()) {
                            $aplicativo = new aplicativo($linha);
                            $cliente = new Cliente($clientePDO->selectClienteId_cliente($aplicativo->getIdCliente())->fetch());
                            ?>
                        <tr>
                            <td class="center"><?php echo $cliente->getNomeCliente()?></td>
                            <td class="center"><?php echo $aplicativo->getNomePacote()?></td>
                            <td class="center"><a class="btn blue lighten-1" href="<?php echo '..'.AplicativoPDO::REPO_KEYS.$aplicativo->getChaveAtualizacao(); ?>" download>Download</a></td>
                            <td class="center"><a class="btn blue lighten-1" href="<?php echo '..'.AplicativoPDO::REPO_KEYS.$aplicativo->getArquivoFirebase(); ?>" download>Download</a></td>
                            <td class="center"><a href="detalhesApp.php?id_app=<?php echo $aplicativo->getIdAplicativo() ?>" class="btn corPadrao2">Detalhes</a></td>
                            <td class = 'center'><a class="btn corPadrao2" href="./editarAplicativo.php?id=<?php echo $aplicativo->getIdAplicativo()?>">Editar</a></td>
                            <td class="center"><a class="btn red darken-2" href="../Controle/aplicativoControle.php?function=deletar&id=<?php echo $aplicativo->getIdAplicativo()?>">Excluir</a></td>
                        </tr>
                                <?php
                        }
                    }
                    ?>
                    </table>
            </div>
        </main>
        <?php
        include_once '../Base/footer.php';
        ?>
    </body>
</html>

