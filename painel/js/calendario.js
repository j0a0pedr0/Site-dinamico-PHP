$(function(){
    $('td[dia]').click(function(){
        $('td').removeClass('day-selected');
        $(this).addClass('day-selected');
        var novoDia = $(this).attr('dia').split('-');
        var novoDia = novoDia[2]+'/'+novoDia[1]+'/'+novoDia[0];
        trocarDatas($(this).attr('dia'),novoDia);

        aplicarEventos($(this).attr('dia'));
    })

    $('form').ajaxForm({
        dataType:'json',
        success:function(data){
            $('form .card-title').after('<div class="box-alert sucesso" style="opacity:1;width:100%;position:relative;top:0;">Evento foi adicionado com sucesso!</div>');
            $('.box-tarefas .card-title').after('<div class="box-tarefas-single"><h3>'+data.tarefa+'</h3></div><!--box-tarefas-single-->');
            setTimeout(function(){
                $('.box-alert').fadeOut(4000);
            },2000);
            $('form')[0].reset();
        }
        
    })

    function trocarDatas(nformatado,formatado){
        $('input[name=data]').attr('value',nformatado);
        $('form .card-title').html('Adicionar Tarefa para: '+formatado);
        $('.box-tarefas .card-title').html('Tarefas de '+formatado);
    }

    function aplicarEventos(data){
        $('.box-tarefas-single').remove();
        $.ajax({
            url:include_path+'ajax/calendario.php',
            method:'post',
            data:{'data':data,'acao':'puxar'}
        }).done(function(data){
            $('.box-tarefas .card-title').after(data);
        })
    }



    $('td[dia]').hover(function(){
        $(this).addClass('hover-calendario');
    },
    function(){
        $(this).removeClass('hover-calendario');
    })

})