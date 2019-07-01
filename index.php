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
        include_once './Base/header.php';
        ?>
    </head>
    <body>
        <?php
        include_once './Base/navPadrao.php';
        ?><main>
        </main>
        <script>
            $("#adiciona").click(function () {
            $("#aumentar").append("<div class='input-field col s4'>\n\
            <input  type='text' placeholder='Atributo' name='atributo[]'/>\n\
            </div>                    <div class='input-field col s4'>\n\
            <input  type='text' placeholder='Tipo' name='tipo[]'/>\n\
            </div>\n\
            <div class='input-field col s4'><input  type='text' placeholder='regra' name='regra[]'/></div>");
            });

        </script>
    </body>
</html>
