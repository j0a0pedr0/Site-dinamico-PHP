$( ".boxes" ).sortable({
    appendTo: document.body,
    start: function(){
        var el = $(this);
        el.css('border','2px dashed #010235');
    },
    update:function(event,ui){
        var data = $(this).sortable('serialize');
        var el = $(this);
        data+='&tipo_acao=order_id';
        el.css('border','1px solid #ccc');
        $.ajax({
            url:include_path+'ajax/forms.php',
            method:'POST',
            data:data
        }).done(function(data){
            
        })
    },
    stop:function(){
        var el = $(this);
        el.css('border','1px solid #ccc');
    }
    

});