$(function(){

    var curslide = 0;
    var maxSlider = $('.banner-single').length - 1;

    changeSlide();
    initSlider();

    function initSlider(){
        $('.banner-single').hide();
        $('.banner-single').eq(curslide).show();
        for(var i = 0; i < maxSlider+1;i++){
            var content = $('.bullets').html();
            if(i == 0){
                content+='<span class="active-slider"></span>';
            }else{
                content+='<span></span>';
            }
            $('.bullets').html(content);
        }
    }

    function changeSlide(){
        var delay = 4;
        setInterval(function(){
            $('.banner-single').eq(curslide).stop().fadeOut(1500);
            curslide++;
            if(curslide > maxSlider){
                curslide = 0;
            }
            $('.banner-single').eq(curslide).stop().fadeIn(1500);

            $('.bullets span').removeClass('active-slider');
            $('.bullets span').eq(curslide).addClass('active-slider');
            
        },delay * 1000);
    }

    $('body').on('click','.bullets span',function(){
        var currentbullets = $(this);
        $('.bullets span').removeClass('active-slider');
        $('.banner-single').eq(curslide).stop().fadeOut(1500);
        curslide = currentbullets.index();
        $('.banner-single').eq(curslide).stop().fadeIn(1500);
        currentbullets.addClass('active-slider');
    })
});