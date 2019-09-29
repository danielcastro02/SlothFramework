<?php
    class conexao {
               
        public function getConexao(){
         
           $con = new PDO('mysql:host=localhost;dbname=markey-admin','root','');
            return $con;
          
        }
    }