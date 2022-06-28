<?php
 
    class MySql{

        private static $pdo;

        public static function Conectar(){
            if(self::$pdo == null){
                try{
                    self::$pdo = new PDO('mysql:host='.HOST.';dbname='.DATABASE,USER,PASSWORD,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"));
                    self::$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                }catch(Exception $e){
                    echo "<script>alert('error ao conectar');</script>";
                }
            }

            return Self::$pdo;
            
        }

        
        
    }
?>