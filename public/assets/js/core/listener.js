

/**
 * Listener Function
 * 
 * @param {type} retriveObject
 * @returns {undefined}
 */
function ListenerServer(retriveObject){

    var json  = null;
    var pid   = parseInt($.cookie('processId'));
  
    try{
        json = retriveObject;

    if(parseInt(json.processId) !== parseInt(pid)) return;
    
    
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