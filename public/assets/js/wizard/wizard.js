$(function(){
    
    
    var wizard = $('body').find('.wizard');
    
    if(wizard.length){
        
        setTimeout(function(){
            
            wizard.addClass('active');
            
            wizard.find('#wiz-1').addClass('active');
        
            var nav = wizard.find('.wiz-nav');

            nav.find('li').on('click',function(){

                var inx = ($(this).index())+1;

                wizard.find('.wiz-page').removeClass('afteractive');
                wizard.find('.wiz-page.active').removeClass('active').addClass('afteractive');

                wizard.find('.wiz-page:nth-child('+inx+')').addClass('active').removeClass('afteractive');
                
                nav.find('li').removeClass('active');
                $(this).addClass('active');

            });
            
        },8000);
        
        
        
    }
    
    
});
