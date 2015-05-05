;
var SelectBox = function(){
    
    var $O = this;
    
    
    this.Init = function(){
        
        $('body').find('select').each(function(){
            
            if( $(this).parent().hasClass('select-box')){
                
            } else {
                
                $O._buildSelect( $(this) );
            }
            
        });
        
    };
    
    
    this._buildSelect = function(select){
        
        select.wrap('<div class="select-box boxsizing" />');
        
        var object = new Object();
        object.wrap = select.closest('.select-box');
        object.select = select;
        object.values = $O._convertValues( select );
        object.selectedIndex = null;
        
        object.wrap.append('<div class="select-box-display" data-value=""><span></span><i class="icon-chevron-sign-down"></i></div>');
        object.displaybox = object.wrap.find('.select-box-display');
        
        object = $O._initializeData( object );
        
        $O._clickEvent( object );
        
    };
    
    this._convertValues = function(select){
      
        var values = new Array();
        
        select.find('option').each(function(){
            var val = $(this).val();
            var text = $(this).text();
            values.push({string:text,value:val});
        });
        
        return values;
        
    };
    
    this._initializeData = function(object){
        
        var string = object.displaybox.find('span').text();
        
        if(string === ''){
            
            object.displaybox.find('span').text(object.values[0].string);
            object.displaybox.data('value', object.values[0].value);
            
            var opts = object.select.find('option:selected');
            if(opts === undefined){
                object.select.find("option:first").attr('selected','selected');
            
                object.selectedIndex = 0;
            } else {
                var index = opts.index();
                
                object.displaybox.find('span').text(object.values[index].string);
                object.displaybox.data('value', object.values[index].value);
                
                object.selectedIndex = index;
            }
            
        } 
        
        return object;
        
    };
    
    this._clickEvent = function(object){
      
        object.displaybox.unbind().on('click', function(){
            
            $('body').append('<div class="select-box-options boxsizing animate"></div>');
            
            var sb_opt = $('body').find('.select-box-options');
            
            var ohtm = null;
            
            $.each(object.values, function(index,b){
                
                var s = index == object.selectedIndex ? 'selected' : '';
                
                var i = s ? 'icon-check' : 'icon-check-empty';
                
                ohtm = '<div class="select-box-options-item '+s+'" data-value="'+b.value+'" data-string="'+b.string+'" data-index="'+(index+1)+'"><i class="'+i+'"></i>'+b.string+'</div>';
                sb_opt.append(ohtm);
                
            });
            
            setTimeout(function(){
                 sb_opt.addClass('active');
                 
                 sb_opt.find('.select-box-options-item').on('click',function(){
                     
                     var clickedItem = $(this);
                     
                     sb_opt.find('.select-box-options-item.selected').removeClass('selected').find('i').removeClass('icon-check').addClass('icon-check-empty');
                     
                     clickedItem.addClass('selected').find('i').removeClass('icon-check-empty').addClass('icon-check');
                     
                     var newString = '<span>'+clickedItem.data('string')+'</span><i class="icon-chevron-sign-down"></i>';
                     
                     object.displaybox.data('value', clickedItem.data('value')).html( newString );
                     
                     var fopt = 'option:nth-child('+clickedItem.data('index')+')';
                     
                     object.select.find(fopt).prop('selected',true);
                     
                     object.selectedIndex = clickedItem.index();
                     
                     sb_opt.removeClass('active');
                     
                     setTimeout(function(){
                         sb_opt.remove();
                     },400);
                     
                 });
                 
            },100);
           
            
        });
        
    };
    
};