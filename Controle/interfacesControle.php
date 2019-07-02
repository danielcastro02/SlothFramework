<?php

if (!isset($_SESSION)) {
    session_start();
}
if (realpath("./index.php")) {
    include_once "./Controle/interfacesPDO.php";
} else {
    if (realpath("../index.php")) {
        include_once "../Controle/interfacesPDO.php";
    } else {
        if (realpath("../../index.php")) {
            include_once "../../Controle/interfacesPDO.php";
            
        }
    }
}
$classe = new interfacesPDO();

if (isset($_GET["function"])) {
    $metodo = $_GET["function"];
    $classe->$metodo("");
}