<?php
    include("../../includeConstants.php");
    $data['sucesso'] = true;
    
    if(Painel::logado() == false){
        die("Ops, Não sei oq Ha");
    }


    if(isset($_POST['acao']) && $_POST['acao'] == 'inserir'){
        $data = [];

        $data['tarefa'] = $_POST['tarefa'];
        $date = $_POST['data'];
        $sql = \Mysql::Conectar()->prepare("INSERT INTO `tb_admin.agenda` VALUES (null,?,?)");
        $sql->execute(array($data['tarefa'],$date));
        die(json_encode($data));

    }else if(isset($_POST['acao']) && $_POST['acao'] == 'puxar'){
        $data = $_POST['data'];
        
        $sql = \Mysql::Conectar()->prepare("SELECT * FROM `tb_admin.agenda` WHERE data='$data' ORDER BY id DESC");
        $sql->execute();
        $tarefas = $sql->fetchAll();
        $box = '';

        foreach($tarefas as $key => $value){
            $box = '<div class="box-tarefas-single">
            <h3>'.$value['tarefa'].'</h3>
            </div><!--box-tarefas-single-->';
            
            echo $box;
        }
    }
?>