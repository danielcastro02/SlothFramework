<?php

if (!isset($_SESSION)) {
    session_start();
}

include_once __DIR__ . '/projetoPDO.php';

$classe = new aplicativoPDO();

if (isset($_GET['function'])) {
    $metodo = $_GET['function'];
    $classe->$metodo();
}

