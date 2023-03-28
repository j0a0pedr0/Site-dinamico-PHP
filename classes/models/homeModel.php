<?php
    namespace Models;

    Class homeModel
    {
        public static function pegaImoveis(){
            $selectImoveis = \Mysql::Conectar()->prepare("SELECT * FROM `tb_admin.imoveis`");
            $selectImoveis->execute();
            return $selectImoveis->fetchAll();
        }
    }

?>