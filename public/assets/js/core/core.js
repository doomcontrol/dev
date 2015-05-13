
function PostComponent(response){
    
    try{ 
        var strOutput = response.object.strOutput;

        var target = $('body').find(response.object.target);

        if( ! target.length) return;

        switch(response.object.method){
            case 'append':
                target.append(strOutput);
            break;
            case 'prepend':
                target.prepend(strOutput);
            break;
            case 'html':
                target.html(strOutput);
            break;
            case 'text':
                target.text(strOutput);
            break;
            case 'move':
                moveTo(response);
            break;
        }

        Highlight(response.object.id);
        
        try{
            
            if(response.object.reinit !== undefined){
                if(response.object.reinit === true){
                    reInit();
                }
            }
            
        }catch(err){
            
        }
        
    } catch(err){}
    
};


function Highlight( id ){
    
    //$( id ).addClass('animate');
    $( id ).addClass('highlight');
    
    setTimeout(function(){
        $( id ).removeClass('highlight');
        //$( id ).removeClass('animate');
    },2000);
    
};


function moveTo(response){
    
    try{
        if(response.object.previd !== null)
            var prevElement = $('body').find('#' + response.object.previd);
        else 
            var prevElement = null;
        
        var Element     = $('body').find(response.object.id);
        var Target      = $('body').find(response.object.target);

        if(prevElement && Element.length){  
            Element.detach().insertAfter(prevElement);
        } else {
            if(Target.length && Element.length){
                var cl = Element.clone();  Element.detach(); cl.prependTo(Target); Element = null;
            }
        }
    } catch(err){
        console.log(err);
    }
   
};