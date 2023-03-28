$(function(){
    $('.ajax').ajaxForm({
        dataType: 'json',

        beforeSend:function(){
            $('.ajax').animate({'opacity':'0.6'});
            $('.ajax').find('input[type=submit]').attr('disabled','true');
        },
        success: function(data){
            $('.ajax').animate({'opacity':'1'});
            $('.ajax').find('input[type=submit]').removeAttr('disabled');
            $('.box-alert').remove();
            if(data.sucesso){
                $('.ajax').prepend('<div style="transition:2s;" class="box-alert opasity sucesso"><i class="fa-solid fa-user-check"></i>'+data.mensagem+'</div>');
                var el = $('.ajax');
                
                if($('.ajax').attr('atualizar') == undefined)
                el[0].reset();
                   
            }else{
                $('.ajax').prepend('<div style="transition:2s;" class="box-alert opasity erro"><i class="fa-solid fa-times"></i> '+data.mensagem+'</div>');
            }
            console.log(data);
        }
        
    })

    $('[actionBtn=delete-cliente]').click(function(){
        
        var el = $(this).parent().parent().parent().parent();
        var item_Id = $(this).attr('item_id');
        var txt = '"Deseja excluir o cliente"';
        var r = confirm(txt);
            if(r == true){
                $.ajax({
                    url:include_path+'ajax/forms.php',
                    data:{id:item_Id,tipo_acao:'deletar_cliente'},
                    method:'post'
                }).done(function(){
                    el.fadeOut(500);
                    return false;
                })
                return false;
            }else{
                return false;
            }
    })
    $('[actionBtn=delete-produto]').click(function(){
        
        var el = $(this).parent().parent().parent().parent();
        var item_name = $(this).attr('item_name');
        var item_Id = $(this).attr('item_id');
        var ItemCount = $(this).attr('item_count');
        var txt = '"Deseja excluir o produto: '+item_name+' com Quantidade de:'+ItemCount+' unidades do Estoque?"';
        var r = confirm(txt);
            if(r == true){
                $.ajax({
                    url:include_path+'ajax/forms.php',
                    data:{id:item_Id,tipo_acao:'deletar_produto'},
                    method:'post'
                }).done(function(){
                    el.fadeOut(500);
                    return false;
                    
                })
                return false;
            }else{
                return false;
            }
            
        return false;
    });
    $('[actionBtn=delete-imagem]').click(function(){
        
        var el = $(this).parent().parent().parent().parent();
        var item_id = $(this).attr('item_id');
        var item_name = $(this).attr('item_name');
        var msg = 'Tem certeza que deseja excluir essa Imagem';
        var response = confirm(msg);

        if(response){
            $.ajax({
                url:include_path+'ajax/forms.php',
                data:({id:item_id,tipo_acao:'delete-imagem',imagem:item_name}),
                method:'post'
            }).done(function(){
                el.fadeOut(500);
                return false;
            })
        }else{ 
            return false;
        }
        return false;
    });
    $('[actionBtn=delete-empreendimento]').click(function(){
        var el = $(this).parent().parent().parent().parent();
        var item_id = $(this).attr('item_id');
        var item_imagem = $(this).attr('item_img');
        var msg = 'TEM CERTEZA QUE DESEJA EXCLUIR ESSE EMPREENDIMENTO???';
        var response = confirm(msg);

        if(response){
            $.ajax({
                url:include_path+'ajax/forms.php',
                data:({id:item_id,tipo_acao:'delete-empreendimento',imagem:item_imagem}),
                method:'POST'
            }).done(function(){
                el.fadeOut(500);
                return false;
            })
        }else{
            return false
        }
        return false;
    });

    $('[actionBtn=delete-imagem-imovel]').click(function(){
        
        var el = $(this).parent().parent().parent().parent();
        var item_id = $(this).attr('item_id');
        var item_name = $(this).attr('item_name');
        var msg = 'Tem certeza que deseja excluir essa Imagem';
        var response = confirm(msg);

        if(response){
            $.ajax({
                url:include_path+'ajax/forms.php',
                data:({id:item_id,tipo_acao:'delete-imagem-imovel',imagem:item_name}),
                method:'post'
            }).done(function(){
                el.fadeOut(500);
                return false;
            })
        }else{ 
            return false;
        }
        return false;
    });

    $('[actionBtn=delete-imovel]').click(function(){
        var el = $(this).parent().parent();
        var item_id = $(this).attr('item_id');
        var msg = 'Tem certeza que deseja excluir esse Imóvel';
        var response = confirm(msg);

        if(response){
            $.ajax({
                url:include_path+'ajax/forms.php',
                data:({id:item_id,tipo_acao:'delete-imovel-single'}),
                method:'post'
            }).done(function(){
                el.fadeOut(500);
                return false;
            })
            return false;
        }else{ 
            return false;
        }
        return false;
    });

});