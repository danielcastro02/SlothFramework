<?php
    class conexao {

        private static $con;

        public static function getConexao(): PDO {
            try {
                if (is_null(self::$con)) {
                    self::$con = new PDO('mysql:host=localhost;dbname=sistemainterno', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
                }
                return self::$con;
            } catch (Exception $e) {
                echo "<h1>FALHA GERAL CONTATE O SUPORTE contato@markeyvip.com</h1>";
                exit(0);
            }
        }

        public static function getTransactConnetion(): PDO {
            try {
                return new PDO('mysql:host=localhost;dbname=sistemainterno', 'sistemainterno', 's8pT864Jhb', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            } catch (Exception $e) {
                echo "<h1>FALHA GERAL CONTATE O SUPORTE contato@markeyvip.com</h1>";
                exit(0);
            }
        }
    }