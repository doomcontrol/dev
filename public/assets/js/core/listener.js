function LivePost(response){

    try{
        if(response.state === undefined && response.status !== undefined){
            response.state = response.status;
        }
    } catch(err){}
    
    if(response.state === false){
        console.log('ddd');
        AlertMessage(response.message);
    } else {

        PushLive(response);
        PostComponent(response);
        
    };
    
    
};

/**
 * Listener Function
 * 
 * @param {type} retriveObject
 * @returns {undefined}
 */
function ListenerServer(retriveObject){

    console.log('ListenerServer:');
    console.log(retriveObject);

    var json  = null;
    var pid   = parseInt($.cookie('processId'));
  
    try{
        json = retriveObject;

    if(parseInt(json.processId) !== parseInt(pid)) return;
    
    
    try{
        
        if(json.object.data){
            DisplayData(json.object.data);
        }
        
    } catch(err){
        console.log(err);
    }
    
    try{
        
        if(json.object.move){
            MoveObject(json.object.move);
        }
        
    } catch(err){
        console.log(err);
    }
    
    
    try{
        
        if(json.object.highlight){
                Highlight(json.object.highlight);
        }
        
    } catch(err){
        console.log(err);
    }
    
    
    if(json.callback.length > 0){  
        eval(json.callback)(json);
        return; 
    }

  }catch(err){ console.log(err); }
};



/**
 * Server Pull
 * --------------------------------------------------------
 * 
 * @returns {undefined}
 */
$(function(){
    
    var msg = new Object();

        msg.processId           = processId;
        msg.url                 = document.URL;
        msg.uid                 = sessionId;
        msg.object              = new Object();
        msg.object.strOutput    = "Connecting...";
        msg.callback            = 'writeServerInfo';
    
        ListenerServer(msg);
        
        servX = new ServerX( servXaddress );

   

   
    servX.bind('open', function() {
        var msg = new Object();

        msg.processId           = processId;
        msg.url                 = document.URL;
        msg.uid                 = sessionId;
        msg.object              = new Object();
        msg.object.strOutput    = '<i class="icon-globe green">&nbsp;</i> Connected.';
        msg.callback            = 'writeServerInfo';

        ListenerServer( msg );
    });

   
    servX.bind('close', function( data ) {
        
        var msg = new Object();

        msg.processId           = processId;
        msg.url                 = document.URL;
        msg.uid                 = sessionId;
        msg.object              = new Object();
        msg.object.strOutput    = '<i class="icon-globe red">&nbsp;</i> Disconnected.';
        msg.callback            = 'writeServerInfo';
            
        ListenerServer( msg );
    });


    servX.bind('message', function( payload ) {

        try{
        payload = JSON.parse(payload);
        } catch(err){}
        ListenerServer( payload );
    });

    servX.connect();
    
    
});