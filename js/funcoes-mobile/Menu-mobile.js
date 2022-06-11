function Menu_click(){
   // $('.botao-mobile').find('i');
   //
    var icone = document.querySelector("#icone i");
    var menu_mobile = document.getElementById('mobile-menu');
    if(menu_mobile.classList.contains('hide')){
        menu_mobile.classList.add('show');
        menu_mobile.classList.remove('hide');
        icone.classList.remove('fa-bars-staggered');
        icone.classList.add('fa-xmark');
        
    }else{
        icone.classList.remove('fa-xmark');
        icone.classList.add('fa-bars-staggered');
        menu_mobile.classList.remove('show');
        menu_mobile.classList.add('hide');
        
    }
}