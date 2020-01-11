<?php

if (!isset($_SESSION)) {
    session_start();
}

include_once __DIR__ . '/sitePDO.php';

$classe = new SitePDO();

if (isset($_GET['function'])) {
    $metodo = $_GET['function'];
    $classe->$metodo();
}

