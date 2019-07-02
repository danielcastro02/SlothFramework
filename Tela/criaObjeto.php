<!DOCTYPE html>
<?php
include_once '../Controle/bancoPDO.php';
$bancoPDO = new bancoPDO();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <?php
        include_once '../Base/header.php';
        ?>
    </head>
    <body>
        <?php
        include_once '../Base/navPadrao.php';
        ?><main>

                <div class="row">
                    <form action="../Controle/bancoControle.php?function=criarEspecifico" method="post" class="card col s10 offset-s1 z-depth-3">
                        <h4 class="center">Selecione a tabela para criar os objetos</h4>
                            <div class="input-field col s6 offset-s3">
                                <select type="text" name="nome">
                                    <?php
                                        $tabelas = $bancoPDO->selectTables();
                                        while($linha = $tabelas->fetch()){
                                            echo "<option value='".$linha[0]."'>".$linha[0]."</option>";
                                        }
                                    ?>
                                </select>
                                <label>Tabela</label>
                            </div>
                        <div class="row center">
                            <input type="submit" class="btn black">
                        </div>
                    </form>
                </div>
        </main>
        
        <?php
        include_once '../Base/footer.php';
        ?>
        <script>
        $('select').formSelect();
        
        </script>
        
    </body>
</html>
