$(function(){
    $('[name=preco_minimo],[name=preco_maximo]').maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});
    
    $(":input").bind('keyup change input', function(){
        sendRequest();
    });

    function sendRequest(){
        $('form').ajaxSubmit({
            data:{'nome_imovel':$('[name=texto-busca]').val()},
            success:function(data){
                $('.lista-imoveis').html(data);
            }
        })
    }
})
