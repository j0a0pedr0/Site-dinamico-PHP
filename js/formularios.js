$(function(){
    /*$('form').submit(function(){
        alert('formulario enviado');
        $('form').html('<input type="email" name"email" required /><input type="submit" value="Enviar" name="acao"/>');
        return false;
    });*/

    $('body').on('submit','form.ajax-form',function(){

        //$('form').html('<input type="email" name"email" required /><input type="submit" value="Enviar" name="acao"/>');
        function limparInput(){
            $('input[type=email]').val('');
            $('input[type=text]').val('');
            $('input[type=number]').val('');
            $('textarea').val('');
        }

        var form = $(this);
        
        $.ajax({
            beforeSend:function(){
                $('.overlay-loading').fadeIn();
            },
            url:'http://localhost/criando_site_dinamico/formularios.php',
            method:'post',
            dataType:'json',
            data:form.serialize()
        }).done(function(data){
            if(data.sucesso){
                $('.overlay-loading').fadeOut();
                limparInput();
                $('.sucesso').fadeIn();
                setTimeout(function(){
                    $('.sucesso').fadeOut();
                },3000);
            }else{
                $('.overlay-loading').fadeOut();
                limparInput();
                $('.erro').fadeIn();
                setTimeout(function(){
                    $('.erro').fadeOut();
                },3000);
            }
        });
        return false;
    })
})