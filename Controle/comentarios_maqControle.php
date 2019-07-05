<?php

if (!isset($_SESSION)) {
    session_start();
}

if (realpath('./index.php')) {
    include_once './Controle/comentarios_maqPDO.php';
} else {
    if (realpath('../index.php')) {
        include_once '../Controle/comentarios_maqPDO.php';
    } else {
        if (realpath('../../index.php')) {
            include_once '../../Controle/comentarios_maqPDO.php';
        }
    }
}

$classe = new comentarios_maqPDO();

if (isset($_GET['function'])) {
    $metodo = $_GET['function'];
    $classe->$metodo();
}

