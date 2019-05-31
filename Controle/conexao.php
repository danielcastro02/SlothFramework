<?php 

                class conexao { 

                

                public function getConexao(){

                

                    $con = new PDO('mysql:host=localhost;dbname=Teste','root','');

                     return $con;

                

                    }

                }