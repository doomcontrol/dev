
/**
 * Footer functions
 * - message
 * 
 * 
 * @returns {FooterItems}
 */
var FooterItems = function(){
    
    var $O = this;
    
    var classMap = {
        blur:'blur-2',
        holder:'.item-holder',
        hold:'.holder',
        active:'active',
        onscreen:'.onscreen',
        item:'.item',
        wrap:'.wrap',
        body:'body',
        msg:'msg',
        liman:'li.main',
        amain:'a.main',
        inpsendmsg:'input[name=sendmessage]',
        inptitle:'input[name=title]',
        textmsg:'textarea[name=message]',
        liman1:'li.main:nth-child(1)',
        retriveMessage:'FotItem.retriveMessage',
        message:'message',
        footmessage:'#footmessage',
        warning:'warning',
        iconcomment:'.icon-comment',
        iconcheck:'.icon-check',
        bounce:'bounce',
        msghdspan:'.message-header span',
        li:'li',
        click:'click',
        
    };
    
    
    /**
     * FooterItems.Init
     * ----------------------------------------
     * 
     * @type public
     * 
     * Initialize footer items 
     * @returns {undefined}
     * ----------------------------------------
     */
    this.Init = function(){
        
        $(classMap.body).find(classMap.item).each(function(){
            
            var $item = $(this);
            
            /**
             * Stop propagation on
             * - holder
             * - onscreen
             */
            $item.find(classMap.holder).unbind().on(classMap.click, function(e){ e.stopPropagation();});
            $item.find(classMap.onscreen).unbind().on(classMap.click, function(e){ e.stopPropagation();});
            
            /**
             * Call send emssage method
             */
            $O.sendMessage($item);
            
            
            $item.unbind().on(classMap.click, function(){
                
                 $item = $(this);
                 
                 if($item.hasClass(classMap.active)){
                     
                     $(classMap.wrap).removeClass(classMap.blur);
                     
                     var HLD =$item.find(classMap.holder);
                     
                     $item.removeClass(classMap.active);
                     
                 } else {
                     
                     $(classMap.wrap).addClass(classMap.blur);
                     
                     $(classMap.body).find(classMap.item).removeClass(classMap.active);
                     
                     $item.addClass(classMap.active);
                     
                     var HLD =$item.find(classMap.holder);
                     
                     if(HLD.hasClass(classMap.msg)){  $O.msgMarkReaded(HLD); } 
                     
                     
                     $item.find(classMap.onscreen).find(classMap.amain).unbind().on(classMap.click,function(e){
                         
                        e.stopPropagation();

                        $item.find(classMap.onscreen).find(classMap.liman).removeClass(classMap.active);
                        $item.find(classMap.onscreen).find(classMap.amain).removeClass(classMap.active);
                        $(this).addClass(classMap.active);
                        $(this).parent().addClass(classMap.active);
                        
                        var ofs = $(this).parent().position();
                        var p_left = ofs.left;
                        
                        $(this).parent().find(classMap.hold).css('left',-(p_left-5));
                        
                        return false;

                    });
                 }
            });
        });
    };
    
    
    /**
     * FooterItems.sendMessage
     * ----------------------------------------------
     * Send message to listener
     * 
     * @type public
     * 
     * @param {type} $item
     * @returns {undefined}
     * ----------------------------------------------
     */
    this.sendMessage = function($item){
        
        var bt = $item.find(classMap.inpsendmsg);
        
        if(bt.length){
            
            bt.unbind().on(classMap.click,function(){
                
                var title = validate( $item.find(classMap.inptitle) );
                var message = validate( $item.find(classMap.textmsg) );
            
                if(title === false || message === false){
                    $item.parent().find(classMap.liman).removeClass(classMap.active);
                    $item.parent().find(classMap.amain).removeClass(classMap.active);
                    var t = $item.parent().find(classMap.liman1);
                    t.addClass(classMap.active).find(classMap.amain).addClass(classMap.active);
                } else {
                    
                    $O._storeMessage(title,message);
                    
                }
            });
        }
        
    };
    
    
    
    /**
     * FooterItems.retriveMessage
     * -----------------------------------------------
     * Get message from listener
     * 
     * @type public
     * 
     * @param {type} json
     * @param {type} parse
     * @returns {undefined}
     * -----------------------------------------------
     */
    this.retriveMessage = function(json, parse){
       
        if(parse === undefined){
            
            var $obj = jQuery.parseJSON(json); 
        }
        else 
            var $obj = json;
        
        var title = $obj.object.title;
        var message = $obj.object.message;
        var id = $obj.object.id;
        
        var $m = $(classMap.body).find(classMap.footmessage);
        
        title = title.replace(/\*\$/g,'\"');
        message = message.replace(/\*\$/g,'\"');

        var strOutput = '<li class=\'reset\'><h5>'+title+'</h5>'+message+'<i class="icon-check" title=\'Mark as readed\' data-id=\''+id+'\'>&nbsp;</i><i class=\'icon-pencil\' title=\'Write Replay\'>&nbsp;</i></li>';
        $m.append(strOutput);
        
        $m.parent().parent().addClass(classMap.warning);
        
        $m.parent().parent().find(classMap.iconcomment).addClass(classMap.bounce);
        
        $O.msgMarkReaded($m.parent());
        
        formatDate();
        
    };
    
    
    
    /**
     * FooterItems.msgMarkReaded
     * -----------------------------------------------
     * Mark as readed message
     * 
     * @type public
     * 
     * @param {type} $item_holder
     * @returns {undefined}
     * -----------------------------------------------
     */
    this.msgMarkReaded = function($item_holder){
        
        var li = $item_holder.find(classMap.li);
        var t = li.length;
        
        $item_holder.find(classMap.msghdspan).text(t);
        
        $item_holder.find(classMap.iconcheck).unbind().on(classMap.click,function(){
            
            
            var id = $(this).data('id');
            
            var params = new Object();
                params.classObj = "Message";
                params.classFunct = "MarkReaded";
                params.id = id;
            
                AjaxCall(params);
            
                $(this).parent().remove();
            
                var li = $item_holder.find(classMap.li);
                var t = li.length;

                $item_holder.find(classMap.msghdspan).text(t);

                if(t === 0){
                    $item_holder.parent().removeClass(classMap.warning);
                    $item_holder.parent().find(classMap.iconcomment).removeClass(classMap.bounce);
                }
            
        });
        
    };
    

    /**
     * FooterItems._storeMessage
     * ----------------------------------------
     * Store message to server
     * @type private
     * 
     * @param {type} title
     * @param {type} message
     * @returns {undefined}
     */
    this._storeMessage = function(title,message, msg, msgObject){
        
        var params = new Object();
        params.classObj = "Message";
        params.classFunct = "Store";
        params.title = title;
        params.message = message;
        
        AjaxCall(params,'FotItem.callBackStore');
        
        var  fm = $(classMap.body).find(classMap.footmessage); 
        var item = fm.closest('.item.message');
        var frm = item.find('.onscreen');
        var inpts = frm.find('input');
        $.each(inpts,function(i,e){
            if( $(e).prop('type') !== "button"){
                $(e).val('');
            }
        });
        var txts = frm.find('textarea');
        $.each(txts,function(i,e){
                $(e).val('');
        });
        
        frm.find('li.main').removeClass('active');
        frm.find('li.main:nth-child(1)').addClass('active');
        
    };
    


    /**
     * FooterItems.callBackStore
     * ----------------------------------------
     * Callback after saved message
     * 
     * @param {type} response
     * @returns {undefined}
     */
    this.callBackStore = function(response){
        
        response.callback = "FotItem.DisplayPost";

        PushLive(response);
        $O.DisplayPost(response);
        
    };
    
    
    
    /**
     * FooterItems.DisplayPost
     * ----------------------------------------
     * Display posted message
     * @param {type} response
     * @returns {undefined}
     */
    this.DisplayPost = function(response){
        
        var  fm = $(classMap.body).find(classMap.footmessage); 
        
        fm.find(classMap.li).removeClass('active');
        fm.prepend(response.object.strOutput);
        fm.find(classMap.li+':nth-child(1)').addClass('active');
        
        var t = fm.find(classMap.li).length;
        
        $(classMap.body).find(classMap.msghdspan).text(t);
        
        $O.msgMarkReaded(fm.parent());
        
        fm.parent().parent().addClass(classMap.warning);
        
        fm.parent().parent().find(classMap.iconcomment).addClass(classMap.bounce);
        
        formatDate();
    };
    
};