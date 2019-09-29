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
            include_once '../Modelo/Aplicativo.php';
            $aplicativoPDO = new aplicativoPDO();
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

                        <td class='center'>Id_aplicativo</td>
                        <td class='center'>Cliente</td>
                        <td class='center'>Nome_pacote</td>
                        <td class='center'>Chave</td>
                        <td class='center'>Dominio</td>
                        <td class='center'>Arquivo_firebase</td>
                        <td class='center'>Editar</td>
                        <td class='center'>Excluir</td>
                    </tr>
                    <?php
                    $stmt = $aplicativoPDO->selectAplicativo();
                        
                    if ($stmt) {
                        while ($linha = $stmt->fetch()) {
                            $aplicativo = new aplicativo($linha);
                            ?>
                        <tr>
                            <td class="center"><?php echo $aplicativo->getId_aplicativo()?></td>
                            <td class="center"><?php echo $aplicativo->getCliente()?></td>
                            <td class="center"><?php echo $aplicativo->getNome_pacote()?></td>
                            <td class="center"><?php echo $aplicativo->getChave()?></td>
                            <td class="center"><?php echo $aplicativo->getDominio()?></td>
                            <td class="center"><?php echo $aplicativo->getArquivo_firebase()?></td>
                            <td class = 'center'><a href="./editarAplicativo.php?id=<?php echo $aplicativo->getid_aplicativo()?>">Editar</a></td>
                            <td class="center"><a href="../Controle/aplicativoControle.php?function=deletar&id=<?php echo $aplicativo->getid_aplicativo()?>">Excluir</a></td>
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

