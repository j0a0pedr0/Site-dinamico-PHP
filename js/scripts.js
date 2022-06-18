$(function(){

    if($('target').length > 0){
        //o elemento existe e portanto precisamo das erol em aulgum elemento.
        var elemento = '#'+$('target').attr('target');
        var divScroll = $(elemento).offset().top;
        $('html,body').animate({'scrollTop':divScroll},1000);
    }

    carregarDinamico();
    function carregarDinamico(){
        $('[realtime]').click(function(){
            var pagina = $(this).attr('realtime');
            $('.container-principal').hide();
            $('.container-principal').load(include_path+'pages/'+pagina+'.php');
            setTimeout(function(){
                initialize();
                addMarker(40.7143528,-74.0059731,'',"Minha casa",false,true);
            },1000)

            $('.container-principal').fadeIn(2000);

            return false;
        })
    }
})