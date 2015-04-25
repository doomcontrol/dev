
var Core = function(){
    
    var $O = this;
    
    var targetUrl = '/ajax_request';
    
    this.Init = function(){
        
    };
    
    this.Controler = function(){
        
      
        if(sessionId === undefined){
            
            var param = {
                classObj:'Login',
                classFunc:'index',
                action:'login'
            };
            
            $O._load(param,'document','html');
            
        } else {
            
        }
        
        
    };
    
    this._load = function(param, target, inject){
        
        $.ajax({
            url: targetUrl,
            type: "POST",
            cache: false,
            data: param,
            success : function(html){

                    switch (inject){

                        case 'html':
                            $(target).html(html);
                        break;
                        case 'append':
                             $(target).append(html);
                            break;
                        case 'prepend':
                             $(target).prepend(html);
                            break;
                        case 'text':
                             $(target).text(html);
                        break;
                        default: 
                            $(target).html(html);
                        break;
                    }
            }
        });
        
    };
    
};