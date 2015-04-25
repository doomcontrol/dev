

/**
 * ISODateString
 * ----------------------------------------------
 * format date to ISO 8601 for timego
 * @returns {undefined}
 * ----------------------------------------------
 */
function ISODateString(d){
 function pad(n){return n<10 ? '0'+n : n}
 return d.getUTCFullYear()+'-'
      + pad(d.getUTCMonth()+1)+'-'
      + pad(d.getUTCDate())+'T'
      + pad(d.getUTCHours())+':'
      + pad(d.getUTCMinutes())+':'
      + pad(d.getUTCSeconds())+'Z'};





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
                eval(callback)(_response, sendData, sendData2);
                 
            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            //TODO change this with message
            return false;
        }
    });
    
}