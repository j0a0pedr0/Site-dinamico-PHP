<div class="box-content editarUsuario listar-depoimentos w100">
    <h2 class="w100 h2-mobile" ><i class="fa-solid fa-comments"></i> Chat Online</h2>
    <div class="box-chat-online">
        <?php 
        $mensagens = \Mysql::Conectar()->prepare("SELECT * FROM `tb_admin.chat` ORDER BY id DESC LIMIT 30");
        $mensagens->execute();
        $mensagens = $mensagens->fetchAll();
        $mensagens = array_reverse($mensagens);
        foreach($mensagens as $key => $value){
            $user_id = \Mysql::Conectar()->prepare("SELECT nome FROM `tb_admin.usuarios` WHERE id=?");
            $user_id->execute(array($value['user_id']));
            $nome = $user_id->fetch()['nome'];
            $msgId = $value['id'];
            $styleRight = '';
            if($_SESSION['id'] == $value['user_id']){
                $styleRight = 'text-align:right;';
            }
            
            ?>
        
        <div class="mensagem-chat" style="<?php echo $styleRight; ?>">
            <span><?php echo $nome; ?></span>
            <p><?php echo $value['mensagem']; ?></p>
        </div><!--mensagem-chat-->
        <?php
            $_SESSION['lastIdChat'] = $msgId;
        } ?>
    
    </div><!--box-chat-online-->
    <form method="POST" action="<?php echo INCLUDE_PATH_PAINEL; ?>ajax/chat.php" class="form-chat">
        <textarea name="mensagem"></textarea>
        <input type="submit" name="acao" value="Enviar">
    </form>
</div><!--box-content editar usuario-->