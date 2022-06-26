$(function(){
    /*$('form').submit(function(){
        alert('formulario enviado');
        $('form').html('<input type="email" name"email" required /><input type="submit" value="Enviar" name="acao"/>');
        return false;
    });*/

    $('body').on('submit','form',function(){
        alert('enviado!');
        var url_atual = window.location.href;
        console.log(url_atual);
        $('form').html('<h2>Qual o seu melhor e-mail?</h2><input type="email" name"email" required /><input type="submit" value="Enviar" name="acao"/>');
        return false;
    })
})