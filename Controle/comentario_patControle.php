<?php

if (!isset($_SESSION)) {
    session_start();
}

if (realpath('./index.php')) {
    include_once './Controle/comentario_patPDO.php';
} else {
    if (realpath('../index.php')) {
        include_once '../Controle/comentario_patPDO.php';
    } else {
        if (realpath('../../index.php')) {
            include_once '../../Controle/comentario_patPDO.php';
        }
    }
}

$classe = new comentario_patPDO();

if (isset($_GET['function'])) {
    $metodo = $_GET['function'];
    $classe->$metodo();
}

