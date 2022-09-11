$(function(){
    var open = true;
    var openMobile = false;
    var windowSize = $(window)[0].innerWidth; 

    if(windowSize < 768){
        //$('.menu').attr('style','width: 0px !important');
        $('.menu').css('display','block')
        $('.menu').css('width','0');
    }
    $('.menu-btn').click(function(){

        if(windowSize > 768){
            if(open){
                //$('body').css('overflow','hidden');
                //o menu está aberto, precisamos fechar e adaptar nosso conteúdo geral do painel
                $('.menu').animate({'width':'0','padding':'0'},function(){
                    open = false;
                });
                $('.topo-painel').animate({'width':'100%','left':'0'},function(){
                    open = false;
                });
            }else{

                $('.menu').css('display','block')
                $('.menu').animate({'width':'180px'},function(){
                    open = true;
                });
                $('.topo-painel').animate({'left':'180px'},function(){
                    open = true;
                   // $('.topo-painel').css('trasition','2s')
                    $('.topo-painel').css('width','calc(100% - 180px)');
                });
                
            }
        }else{
            //open = false;
            if(openMobile == true){
                //$('body').css('overflow','hidden');
                //o menu está aberto, precisamos fechar e adaptar nosso conteúdo geral do painel
                $('.menu').animate({'width':'0','padding':'0'},function(){
                    openMobile = false;
                });
                $('.topo-painel').animate({'width':'100%','left':'0'},function(){
                    openMobile = false;
                });
            }else{
                $('.menu').animate({'width':'180px'},function(){
                    openMobile = true;
                });
                $('.topo-painel').animate({'left':'180px'},function(){
                    openMobile = true;
                   
                });
                
            }
            
        }
        
    })

    $('[formato=data]').mask('99/99/9999');

    $('[actionBtn=delete]').click(function(){
        var txt = '"Deseja excluir o registro"';
        var r = confirm(txt);
        if(r == true){
            return true
        }else{
            return false;
        }
    })

})