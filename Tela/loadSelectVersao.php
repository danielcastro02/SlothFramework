<?php
include_once "../Base/requerLogin.php";
include_once "../Controle/versaoPDO.php";
include_once "../Modelo/Versao.php";
$versaoPDO = new VersaoPDO();
$stmt = $versaoPDO->selectId_projeto($_GET['id_projeto']);
if($stmt){
    while($linha = $stmt->fetch()){
        $versao = new Versao($linha);
        echo "<option value='".$versao->getIdVersao()."' ".($versao->getIdVersao() == $_GET['id_projeto'] ? "selected" : "" ).">".$versao->getNomeVersao()." / ".$versao->getTextNivel()." </option>";
    }
}else{
    echo "<option>Nenhuma versão!</option>";
}
