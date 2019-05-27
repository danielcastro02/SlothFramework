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
        if (!realpath("./Controle/Conexao.php")) {
            ?>
        <form action="./Controle/geradorControle.php?function=criaConexao" method="post">
                <div id="aumentar" class="row">
                    <div class="input-field col s6 offset-s3">
                        <input type="text" placeholder="Nome do Banco" name="nome"/><br>
                    </div>
                    <div class="input-field col s4">
                        <input  type="text" placeholder="Host" name="host"/>
                    </div>
                    <div class="input-field col s4">
                        <input  type="text" placeholder="Usuario" name="usuario"/>
                    </div>
                    <div class="input-field col s4">
                        <input  type="text" placeholder="Senha" name="senha"/>
                    </div>
                </div><div class="row center">
                <a href="#" id="adiciona" class="btn">Adicionar atributo</a>
                <input type="submit" class="btn">
                </div>
            </form>
            <?php
        } else {
            ?>
            <form action="./Controle/geradorControle.php?function=criaTabela">
                <div id="aumentar" class="row">
                    <div class="input-field col s6 offset-s3">
                        <input type="text" placeholder="Nome da Tabela" name="nome"/><br>
                    </div>
                    <div class="input-field col s4">
                        <input  type="text" placeholder="Atributo" name="atributo[]"/>
                    </div>
                    <div class="input-field col s4">
                        <input  type="text" placeholder="Tipo" name="tipo[]"/>
                    </div>
                    <div class="input-field col s4">
                        <input  type="text" placeholder="regra" name="regra[]"/>
                    </div>
                </div><div class="row center">
                <a href="#" id="adiciona" class="btn">Adicionar atributo</a>
                <input type="submit" class="btn">
                </div>
            </form>
            <?php
        }
        ?>
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
