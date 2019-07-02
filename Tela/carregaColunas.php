<?php

include_once '../Controle/bancoPDO.php';
$bancoPDO = new bancoPDO();
$tabela = $_GET['tabela'];

$colunas = $bancoPDO->selectColunas($tabela);

while($linha = $colunas->fetch()){
    echo "<option value='".$linha[0]."'>".$linha[0]."</option>";
}