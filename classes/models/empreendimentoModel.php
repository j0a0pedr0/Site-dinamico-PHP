<?php
    namespace Models;

    Class empreendimentoModel
    {
        public static function pegaImovel($id){
            $selectImoveis = \Mysql::Conectar()->prepare("SELECT * FROM `tb_admin.Imoveis` WHERE empreend_id=?");
            $selectImoveis->execute(array($id));
            return $selectImoveis->fetchAll();
        }
        public static function pegarEmpreend($slug){
            $empreendId = \Mysql::Conectar()->prepare("SELECT id,nome FROM `tb_admin.empreendimentos` WHERE slug='$slug'");
            $empreendId->execute();
            return $empreendId->fetchAll();
        }
    }


?>