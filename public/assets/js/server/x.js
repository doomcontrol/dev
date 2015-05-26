var ServerX = function(url)
{
    
	var callbacks = {};
	var ws_url = url;
	var conn;

	this.bind = function(event_name, callback){
		callbacks[event_name] = callbacks[event_name] || [];

		callbacks[event_name].push(callback);
		return this;
	};

	this.send = function(event_name, event_data){
            
		this.conn.send( JSON.stringify(event_data) );
		return this;
	};

	this.connect = function() {
            
		if ( typeof(MozWebSocket) == 'function' )
			this.conn = new MozWebSocket(url);
		else
                    if ( typeof(WebSocket) == 'function' )
                    {
                        try{
                            this.conn = new WebSocket(url);
                        }catch(e){
                            
                        }
                    }

                if(this.conn){
                    this.conn.onmessage = function(evt){
                            dispatch('message', evt.data);
                    };

                    this.conn.onclose = function(){dispatch('close',null);};
                    this.conn.onopen = function(){dispatch('open',null);};
                }
           
	};

	this.disconnect = function() {
		this.conn.close();
	};

	var dispatch = function(event_name, message){

		var chain = callbacks[event_name]; 
		if(typeof chain == 'undefined') return; /*// no callbacks for this event*/
		for(var i = 0; i < chain.length; i++){
			chain[i]( message );
		}
	};
   
};