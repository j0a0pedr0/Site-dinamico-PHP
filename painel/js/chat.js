$(function(){
    var box_chat_scroll = $('.box-chat-online')[0].scrollHeight;
    $('.box-chat-online').scrollTop(box_chat_scroll);

    $('textarea').keyup(function(e){
        var code = e.keyup || e.which;
        if(code == 13){
            insertChat();
        }
    })
    
    $('form').submit(function(){
        insertChat();
        return false;
    })

    function insertChat(){
        //Responsavel por Inserir as mensagens
        var Mensagem = $('textarea').val();
        $('textarea').val('');
        $.ajax({
            url:include_path+'ajax/chat.php',
            method:'post',
            data:{'mensagem':Mensagem,'tipo_acao':'inserir_mensagem'}
        }).done(function(data){
            $('.box-chat-online').append(data);
            var box_chat_scroll = $('.box-chat-online')[0].scrollHeight;
            $('.box-chat-online').scrollTop(box_chat_scroll);
        })
    }

    function recuperarMensagem(){
        //responsavel por recuperar mensagens novas no banco de dados
        
        $.ajax({
            url:include_path+'ajax/chat.php',
            method:'post',
            data:{'tipo_acao':'recuperar_mensagem'}
        }).done(function(data){
            $('.box-chat-online').append(data);
            
        })
    }

    setInterval(function(){
        recuperarMensagem();
    },3000)


})