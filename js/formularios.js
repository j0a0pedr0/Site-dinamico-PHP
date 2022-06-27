$(function(){
    /*$('form').submit(function(){
        alert('formulario enviado');
        $('form').html('<input type="email" name"email" required /><input type="submit" value="Enviar" name="acao"/>');
        return false;
    });*/

    $('body').on('submit','form',function(){
        alert('formulario enviado');
        //$('form').html('<input type="email" name"email" required /><input type="submit" value="Enviar" name="acao"/>');
        $('input[type=email]').val('');
        $('input[type=text]').val('');
        $('input[type=number]').val('');
        $('textarea').val('');
        return false;
    })
})