function PushLive(object){
    
    console.log('Push Live:');
    console.log(object);
    
    try{
        
        if(object.object.callback){
            eval(object.object.callback)(object);
        }
 
    } catch(err){
        console.log(err);
    }
    
    try{
        
        if(object.callback){
            eval(object.callback)(object);
        }
 
    } catch(err){
        console.log(err);
    }

    servX.send( 'message',object );
    
};


function writeServerInfo(json){
   
    $('#server_info').html(json.object.strOutput);
    
};


function SendLive(response){

    try{
        if(response.state === undefined && response.status !== undefined){
            response.state = response.status;
        }
    } catch(err){}
    
    if(response.state === false){
        
        AlertMessage(response.message);
    } else {

        PushLive(response);
        //PostComponent(response);
        
    };
};

/**
 * ISODateString
 * ----------------------------------------------
 * format date to ISO 8601 for timego
 * @returns {undefined}
 * ----------------------------------------------
 */
function ISODateString(d){
 function pad(n){return n<10 ? '0'+n : n;}
 return d.getUTCFullYear()+'-'
      + pad(d.getUTCMonth()+1)+'-'
      + pad(d.getUTCDate())+'T'
      + pad(d.getUTCHours())+':'
      + pad(d.getUTCMinutes())+':'
      + pad(d.getUTCSeconds())+'Z'; };





/**
 * ISODateNow
 * -------------------------------------------
 * Get Date Now ISO 8601
 * @returns {String}
 * -------------------------------------------
 */
function ISODateNow(){
    var d = new Date(), fd = ISODateString(d); 
    return '<abbr class=*$timeago*$ title=*$'+fd+'*$>Just now</abbr>';
};





/**
 * formatDate
 * ------------------------------------------
 * Convert date to timego on screen
 * 
 * @returns {undefined}
 * ------------------------------------------
 */
function formatDate(){ $("abbr.timeago").timeago();};






/**
 * validate
 * -----------------------------------------
 * Validate input filed is ampty
 * 
 * @param {type} $item
 * @returns {Boolean|validate.v}
 * -----------------------------------------
 */
function validate($item){
    
    var v = $item.val();
    if(v.trim().length < 1){ $item.addClass('error'); return false; } else { $item.removeClass('error'); return v; }
};




/**
 * AjaxCall
 * -----------------------------------------
 * 
 * @param {type} $params
 * @param {type} $callback
 * @returns {undefined}
 * -----------------------------------------
 */
function AjaxCall( params, callback, sendData, sendData2 ){
    
     $.ajax({
        type: "POST",  url:  ajaxUrl,  data: params,
        success: function(_response) {
            if(callback !== undefined){
                console.log('Ajax Call:' + callback);
                eval(callback)(_response, sendData, sendData2);
                console.log('Ajax Call Callback :' + callback);
                 
            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            /*//TODO change this with message*/
            return false;
        }
    });
    
};



/**
 * AlertMessage
 * -----------------------------------------
 * 
 * 
 * @param {type} string
 * @returns {undefined}
 */
function AlertMessage(string){
    
    var params = {
        classObj:'Guitext',
        classFunct:'index',
        guiString:string
    };
    
    AjaxCall(params,'_displayMessage');
};


/**
 * _displayMessage
 * -----------------------------------------
 * 
 * @param {type} response
 * @returns {undefined}
 */
function _displayMessage(response){
    try{
        
        var str = response.strOutput;

        var ab = $('body').find('.alert-box');
        
        ab.text(str);
        ab.append('<i class="icon-remove" />');
        
        ab.addClass('active');
        
        $('body').on('click', function(){
            ab.removeClass('active');
        });
        
        ab.find('i').unbind().on('click',function(){
            ab.removeClass('active');
        });
        
        
    }catch(e){
        
    };
};



/**
 * validateEmail
 * -----------------------------------------
 * 
 * @param {type} email
 * @returns {Boolean}
 */
function validateEmail(mail)   
{  
    if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail))  
    {  
       return (true); 
    };
    return (false);
};




function DisableBodyScroll(boolean){
    if(boolean){
        $('html, body').css({
            'overflow': 'hidden',
            'height': '100%'
        });
    } else {
        $('html, body').css({
            'overflow': 'auto',
            'height': 'auto'
        });
    };
};




function launchIntoFullscreen(element) {
  if(element.requestFullscreen) {
    element.requestFullscreen();
  } else if(element.mozRequestFullScreen) {
    element.mozRequestFullScreen();
  } else if(element.webkitRequestFullscreen) {
    element.webkitRequestFullscreen();
  } else if(element.msRequestFullscreen) {
    element.msRequestFullscreen();
  }
};


