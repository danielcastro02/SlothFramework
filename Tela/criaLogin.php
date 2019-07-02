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
                    <form action="../Controle/interfacesControle.php?function=criarLogin" method="post" class="card col s10 offset-s1 z-depth-3">
                        <h4 class="center">Selecione o objeto do usuário</h4>
                        <div class="row">
                            <div class="input-field col s6 offset-s3">
                                <select type="text" name="nome" id="nome">
                                    <?php
                                        $tabelas = $bancoPDO->selectTables();
                                        while($linha = $tabelas->fetch()){
                                            echo "<option value='".$linha[0]."'>".$linha[0]."</option>";
                                        }
                                    ?>
                                </select>
                                <label>Tabela</label>
                            </div>
                            <div class="input-field col s6 offset-s3">
                                <select type="text" name="usuario" id="usuario">
                                    <option value="0" disabled="true">Selecione a anterior</option>
                                </select>
                                <label>Usuario</label>
                            </div>
                            <div class="input-field col s6 offset-s3">
                                <select type="text" name="senha" id="senha">
                                    <option value="0" disabled="true">Selecione a anterior</option>
                                </select>
                                <label>Senha</label>
                            </div>
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
        
        $('#nome').change(function(){
            var valor = $(this).val();
            $("#senha").load("./carregaColunas.php?tabela="+valor, function (){
                 $('select').formSelect();
            });
            $("#usuario").load("./carregaColunas.php?tabela="+valor, function (){
                 $('select').formSelect();
            });
            
        });
        
        </script>
        
    </body>
</html>
