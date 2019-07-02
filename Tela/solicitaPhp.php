<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
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
                <form action="../Controle/scriptControle.php?function=criarTudo" method="POST" class="card col s10 offset-s1 z-depth-3">
                    <h4 class="center">Informe o caminho absoluto do seu "php.exe" (Costuma ser C:\xampp\php\php.exe) caso suas variaveis de ambiente estejam configuradas, digite apenas "php"</h4>

                        <div class="input-field col s6 offset-s3">
                            <input type="text" name="local"/>
                            <label>Localização</label>
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

    </body>
</html>
