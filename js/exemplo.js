$(function(){

    var atual = -1;
    var maximo = $('.box-especialidades').length - 1;
    var timer;
    var animacaoDelay = 3;


       // executarAnimacao();
 
        
    
    function executarAnimacao(){
        $('.box-especialidades').hide();
        timer = setInterval(logicaAnimacao,animacaoDelay*1000);

        function logicaAnimacao(){
            atual++;
            if(atual > maximo){
                $('.box-especialidades').hide();
                atual = -1;
                return false;
            }
            $('.box-especialidades').eq(atual).fadeIn(1500);
        }
    }


})