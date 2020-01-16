<?php
include_once "../Base/requerLogin.php";
include_once "../Controle/versaoPDO.php";
include_once "../Modelo/Versao.php";
$versaoPDO = new VersaoPDO();
$stmt = $versaoPDO->getUnlinkedVesions($_GET['id_projeto']);
echo "<option value='0'>Nenhuma versão!</option>";
if($stmt) {
    while ($linha = $stmt->fetch()) {
        $versao = new Versao($linha);
        echo "<option value='" . $versao->getIdVersao() . "'>" . $versao->getNomeVersao() . " / " . $versao->getTextNivel() . "</option>";
    }
}
