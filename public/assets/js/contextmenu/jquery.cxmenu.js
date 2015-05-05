

$.fn.contextmenu = function( options ) {
   
    var mouse = {x: 0, y: 0};
    
    var menu = this.find('.contextmenu-holder');
     
    var settings = $.extend({
            color: "#333",
            backgroundColor: "#fff",
            fontsize:"13px"
    }, options );
    
   /* menu.css({
        color:settings.color,
        backgroundColor: settings.backgroundColor,
        "font-size":settings.fontsize
    });
    
    menu.find('a').css({
        color:settings.color,
        "font-size":settings.fontsize
    }); */
    
    document.addEventListener('mousemove', function(e){ 
        mouse.x = e.clientX || e.pageX; 
        mouse.y = e.clientY || e.pageY 
    }, false);
    
    $('body').on('click contextmenu',function(){
        $('body').find('.contextmenu-holder').removeClass('active');
    });
     
    this.on('contextmenu press',function(e){
        e.stopPropagation();
        
        $('body').find('.contextmenu-holder').removeClass('active');
        
        var menu = $(this).find('.contextmenu-holder');
        
        menu.addClass('active').css({top:mouse.y,left:mouse.x});
        
        return false;
    });
    
    return this;
    
};



