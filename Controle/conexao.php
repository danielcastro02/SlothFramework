<?php
    class conexao {
               
        public function getConexao(){
         
           $con = new PDO('mysql:host=localhost;dbname=sistemainterno','sistemainterno','Class.7ufo');
            return $con;
          
        }
    }