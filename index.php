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
        ?><main><?php
            if (!realpath("./Controle/Conexao.php")) {
                ?>

                <div class="row">
                    <form action="./Controle/geradorControle.php?function=criaConexao" method="post" class="card col s10 offset-s1 z-depth-3">
                        <h4 class="center">Você ainda não conectou com um banco, por favor faça a conexão.</h4>
                        <div id="aumentar" class="row">
                            <div class="input-field col s6 offset-s3">
                                <input type="text" name="nome"/><br>
                                <label>Nome do Banco</label>
                            </div>
                            <div class="input-field col s4">
                                <input  type="text" name="host"/>
                                <label>Host</label>
                            </div>
                            <div class="input-field col s4">
                                <input  type="text" name="usuario"/>
                                <label>Usuario</label>
                            </div>
                            <div class="input-field col s4">
                                <input  type="password" name="senha"/>
                                <label>Senha</label>
                            </div>
                        </div><div class="row center">
                            <a href="#" id="adiciona" class="btn black">Adicionar atributo</a>
                            <input type="submit" class="btn black">
                        </div>
                    </form>
                </div>
                <?php
            } else {
                ?>
                <div class="row">
                    <form action="./Controle/geradorControle.php?function=gerarTabela" method="POST" class="card col s10 offset-s1 z-depth-3">
                        <h4 class="center">Crie uma tabela, (Sintaxe SQL) isto criara os objetos relacionados e a tabela no banco de dados.</h4>

                        <div id="aumentar" class="row">
                            <div class="input-field col s6 offset-s3">
                                <input type="text" name="nome"/><br>
                                <label>Nome da tabela</label>
                            </div>
                            <div class="input-field col s4">
                                <input  type="text" name="atributo[]"/>
                                <label>Atributo</label>
                            </div>
                            <div class="input-field col s4">
                                <input  type="text" name="tipo[]"/>
                                <label>Tipo</label>
                            </div>
                            <div class="input-field col s4">
                                <input  type="text" name="regra[]"/>
                                <label>Regra</label>
                            </div>
                        </div><div class="row center">
                            <a href="#" id="adiciona" class="btn black">Adicionar atributo</a>
                            <input type="submit" class="btn black">
                        </div>
                    </form>
                </div>
                <?php
            }
            ?>
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
