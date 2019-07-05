<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Listagem Patrimonio</title>
        <?php
            include_once '../Base/header.php';
            include_once '../Controle/patrimonioPDO.php';
            include_once '../Modelo/Patrimonio.php';
            $patrimonioPDO = new patrimonioPDO();
        ?>
        <body class="homeimg">
        <?php
        include_once '../Base/navBar.php';
        ?>
        <main>
            <div class="row " style="margin-top: 5vh;">
                <table class=" card col s10 offset-s1 center">
                <h4 class='center'>Listagem Patrimonio</h4>
                    <tr class="center">

                        <td class='center'>Pat</td>
                        <td class='center'>Nome</td>
                        <td class='center'>Id_desc</td>
                        <td class='center'>Localizacao</td>
                        <td class='center'>Estado</td>
                        <td class='center'>Editar</td>
                        <td class='center'>Excluir</td>
                    </tr>
                    <?php
                    $stmt = $patrimonioPDO->selectPatrimonio();
                        
                    if ($stmt) {
                        while ($linha = $stmt->fetch()) {
                            $patrimonio = new patrimonio($linha);
                            ?>
                        <tr>
                            <td class="center"><?php echo $patrimonio->getPat()?></td>
                            <td class="center"><?php echo $patrimonio->getNome()?></td>
                            <td class="center"><?php echo $patrimonio->getId_desc()?></td>
                            <td class="center"><?php echo $patrimonio->getLocalizacao()?></td>
                            <td class="center"><?php echo $patrimonio->getEstado()?></td>
                            <td class = 'center'><a href="./editarPatrimonio.php?id=<?php echo $patrimonio->getpat()?>">Editar</a></td>
                            <td class="center"><a href="../Controle/patrimonioControle.php?function=deletar&id=<?php echo $patrimonio->getpat()?>">Excluir</a></td>
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

