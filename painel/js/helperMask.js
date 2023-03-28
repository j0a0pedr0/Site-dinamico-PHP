$(function(){
    $('[name=cpf]').mask('999.999.999-99');
    $('[name=cnpj]').mask('99.999.999/9999-99');
    $('[name=parcelas],[name=intervalo]').mask('99');
    $('[name=preco]').maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});
    $('[name=vencimento]').Zebra_DatePicker('');
    $('[name=area]').mask('999 m2');

    $('[name=tipo_cliente]').change(function(){
        var val = $(this).val();

        if(val == 'fisico'){
            $('[name=cpf]').parent().show();
            $('[name=cnpj]').parent().hide();
        }else{
            $('[name=cpf]').parent().hide();
            $('[name=cnpj]').parent().show();
        }
    });
    $('[name=busca_parametro]').change(function(){
        var val = $(this).val();
        $('input[name=busca]').val('');

        if(val == 'cpf'){
            $('input[name=busca]').mask('999.999.999-99');
        }else if(val == 'cnpj'){
            $('input[name=busca]').mask('99.999.999/9999-99');
        }else if(val == 'nome' || val == 'email'){
            $('input[name=busca]').unmask();
        }
    })
})