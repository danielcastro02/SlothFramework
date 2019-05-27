<?php 
class conexao { 

public function getConexao(){
$con = new PDO('mysql:host=localhost;dbname=teste','root','windows#s3rv3r');
 return $con;
}
 }