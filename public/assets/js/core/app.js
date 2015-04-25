










function send(txt){
    var msg = new Object();
    msg.txt = txt;
    msg.processId = processId;
    msg.url       = document.URL;
    msg.uid       = sessionId;
    msg.type      = servTypeSend.message;
    servX.send( 'message', JSON.stringify(msg) );
    
}


function writeServerInfo(json){
    
    $('#server_info').html(json.strOutput);
    
}



// ON DOM READY
$(function(){
    
    var msg = new Object();
        msg.strOutput   = "Connecting...";
        msg.type        = servTypeSend.info;
        msg.processId   = processId;
        msg.url         = document.URL;
        msg.uid         = sessionId;
        msg.object      = null;
        msg.callback    = null;
    
        ListenerServer(msg);
        
    servX = new ServerX(servXaddress);

   

    //Let the user know we're connected
    servX.bind('open', function() {
        var msg = new Object();
        msg.strOutput   = '<i class="icon-globe green">&nbsp;</i> Connected.';
        msg.type        = servTypeSend.info;
        msg.processId   = processId;
        msg.url         = document.URL;
        msg.uid         = sessionId;
        msg.object      = null;
        msg.callback    = null;
        msg.uid         = sessionId;

        ListenerServer( msg );
    });

    //OH NOES! Disconnection occurred.
    servX.bind('close', function( data ) {
            var msg = new Object();
            msg.strOutput   = '<i class="icon-globe red">&nbsp;</i> Disconnected.';
            msg.type        = servTypeSend.info;
            msg.processId   = processId;
            msg.url         = document.URL;
            msg.uid         = sessionId;
            msg.object      = null;
            msg.callback    = null;
            
            ListenerServer( msg );
    });

    //Log any messages sent from server
    servX.bind('message', function( payload ) {
        console.log('payload:'+payload);
        ListenerServer( payload );
    });

    servX.connect();
    
});











var FotItem = new FooterItems();


$(function(){
    
    FotItem.Init();
    
    var timerId = setInterval(formatDate, 60000);
    
    formatDate();
    
    
});