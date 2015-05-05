
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
        }

        Highlight(response.object.id);
    } catch(err){}
    
};


function Highlight( id ){
    
    $( id ).addClass('animate');
    $( id ).addClass('highlight');
    
    setTimeout(function(){
        $( id ).removeClass('highlight');
    },3000);
    
};