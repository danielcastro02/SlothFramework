<?php
include_once '../Base/requerLogin.php';

if (!isset($_SESSION)) {
    session_start();
}
include_once __DIR__."/../Controle/parametrosPDO.php";
$classe = new ParametrosPDO();

if (isset($_GET["function"])) {
    $metodo = $_GET["function"];
    $classe->$metodo();
}