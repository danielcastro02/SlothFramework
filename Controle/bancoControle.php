<?php

if (!isset($_SESSION)) {
    session_start();
}
if (realpath("./index.php")) {
    include_once "./Controle/geradorPDO.php";
} else {
    if (realpath("../index.php")) {
        include_once "../Controle/geradorPDO.php";
    } else {
        if (realpath("../../index.php")) {
            include_once "../../Controle/geradorPDO.php";
            
        }
    }
}
$classe = new geradorPDO();

if (isset($_GET["function"])) {
    $metodo = $_GET["function"];
    $classe->$metodo("");
}