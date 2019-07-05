<?php
    class conexao {
               
        public function getConexao(){
         
           $con = new PDO('mysql:host=localhost;dbname=oficina','root','windows#s3rv3r');
            return $con;
          
        }
    }