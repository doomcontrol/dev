

/**
 * Listener Function
 * 
 * @param {type} retriveObject
 * @returns {undefined}
 */
function ListenerServer(retriveObject){
  
  var json = null;
  
  try{
      
    json = jQuery.parseJSON(retriveObject);

    var pid = parseInt($.cookie('processId'));
    
    if(json.processId !== pid) return;
    if(json.callback.length > 0){  var c = json.callback + "('"+JSON.stringify(json)+"')"; eval(c); return; }

  }catch(err){ }
  
   if(json === null) json = retriveObject;
   
   if(json)
   switch(json.type){
       case servTypeSend.info:
            writeServerInfo(json);
       break;
   }
}