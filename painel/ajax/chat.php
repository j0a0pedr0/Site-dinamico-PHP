<?php

    include("../../includeConstants.php");
    $data['sucesso'] = true;
    

    if(Painel::logado() == false){
        die("Ops, Não sei oq Ha");
    }

    $id_user = $_SESSION['id'];

    if(isset($_POST['tipo_acao']) && $_POST['tipo_acao'] == 'inserir_mensagem'){
    $mensagem = $_POST['mensagem'];
    $id_user = $_SESSION['id'];
    $nome = $_SESSION['nome'];
    $sql = \Mysql::Conectar()->prepare("INSERT INTO `tb_admin.chat` VALUES (null,?,?)");
    $sql->execute(array($id_user,$mensagem));
    $styleRight = 'text-align:right !important;';

    echo    '<div class="mensagem-chat" style="'.$styleRight.'">
                <span>'.$nome.':</span>
                <p>'.$mensagem.'</p>
            </div><!--mensagem-chat-->';

    $_SESSION['lastIdChat'] = \Mysql::Conectar()->lastInsertId();

    }else if(isset($_POST['tipo_acao']) && $_POST['tipo_acao'] == 'recuperar_mensagem'){
        $lastId = $_SESSION['lastIdChat'];
        
        $sql = \Mysql::Conectar()->prepare("SELECT * FROM `tb_admin.chat` WHERE id > $lastId");
        $sql->execute();
        $mensagens = $sql->fetchAll();
        
        foreach($mensagens as $key => $value){
            $user_id = \Mysql::Conectar()->prepare("SELECT nome FROM `tb_admin.usuarios` WHERE id=?");
            $user_id->execute(array($value['user_id']));
            $nome = $user_id->fetch()['nome'];

            $styleRight = '';
            if($id_user == $value['user_id']){
                $styleRight = 'text-align:right !important;';
            }
            
            echo '<div class="mensagem-chat" style="'.$styleRight.'">
                <span>'.$nome.':</span>
                <p>'.$value['mensagem'].'</p>
                </div><!--mensagem-chat-->';

                $_SESSION['lastIdChat'] = $value['id'];
        }
    }
?>