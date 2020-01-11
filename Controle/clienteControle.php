<?php

if (!isset($_SESSION)) {
    session_start();
}
include_once __DIR__ . '/../Controle/clientePDO.php';
$classe = new ClientePDO();
if (isset($_GET['function'])) {
    $metodo = $_GET['function'];
    $classe->$metodo();
}

