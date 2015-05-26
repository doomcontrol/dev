
/**
 * InlineEdit
 * ------------------------------
 * 
 * @description Handle Inline edit functionality
 * 
 * @returns {InlineEdit}
 */
var InlineEdit = function(){
  
    var $O = this;
  
    /**
     * inlineEdit.Open
     * ------------------------------
     * 01.06.2015
     * 
     * @param {type} e
     * @returns {undefined}
     */
    this.Open = function(e){
      
        
        var $e              = $(e);
        
        var Data            = new Object();
        
        Data.e              = $e;
        Data.targetInline   = $( $e.data('inline') );
        Data.targetFields   = $( $e.data('fields') );
        Data.targetMask     = Data.targetInline.prev('.inline-mask');
        Data.submit         = Data.targetInline.find('input[type=submit]');
        Data.cancel         = Data.targetInline.find('.inline-cancel');
        Data.firstInput     = Data.targetFields.find('input:first');
        
        
        $('body').find('.inline-edit-item').removeClass('active');
        $('body').find('.inline-edit').removeClass('active');
        $('body').find('.inline-mask').removeClass('active');
        
        
        Data.targetInline.addClass('active');
        Data.targetFields.addClass('active');
        Data.targetMask.addClass('active');
        

        Data.firstInput.focus();
        var tmpStr = Data.firstInput.val();
        Data.firstInput.val('');
        Data.firstInput.val(tmpStr);
        
        Data.submit.unbind().on('click',function(){
            
           $O.submit( Data );
           $O.close(Data);
            
        });
        
        Data.cancel.unbind().on('click', function(){ $O.close( Data ); });
        Data.targetMask.unbind().on('click', function(){ $O.close( Data ); });
    };
    
    
    /**
     * inlineEdit.submit
     * ------------------------------
     * 01.06.2015
     * 
     * @param {type} Data
     * @returns {undefined}
     */
    this.submit = function(Data){

        var params = new Object();
        params.classObj = Data.e.data('class');
        params.classFunct = Data.e.data('funct');
        params.id = Data.e.data('id');

        Data.targetFields.find('input').each(function(){
            if( $(this).prop('type') !== 'submit'){ params[$(this).prop('name')] = $(this).val(); }
        });
        
        Data.targetFields.find('select').each(function(){
            console.log( $(this) );
            params[$(this).prop('name')] = $(this).find('option').filter(":selected").val();
        });

        AjaxCall(params,'PushLive');
        
    };
    
    /**
     * inlineEdit.close
     * ------------------------------
     * 01.06.2015
     * 
     * @param {type} Data
     * @returns {undefined}
     */
    this.close = function( Data ){
        
        Data.targetInline.removeClass('active');
        Data.targetFields.removeClass('active');
        Data.targetMask.removeClass('active');
        
    };
    
    
    
};



/**
 * GridSortable
 * -------------------------------
 * 
 * @description Handle Grid Sortable drag&move elements
 * 
 * @returns {GridSortable}
 */
var GridSortable = function (){
    
    
    /**
     * gridSortable.Init
     * ------------------------------
     * 01.06.2015
     * 
     * @returns {undefined}
     */
    this.Init = function(){
        if(isMobile === false){
            $( ".sortable" ).sortable({
                connectWith:'.sortable',
                scroll: true,
                scrollSensitivity: 10,
                scrollSpeed: 20,
                stop: function( event, ui ) {
                    
                    var params          = new Object();
                    params.classObj     = ui.item.data('sortableclass');
                    params.classFunct   = ui.item.data('sortablefunct');
                    params.id           = ui.item.data('id');
                    params.target       = ui.item.parent().parent().prop('id');
                    params.group        = ui.item.parent().parent().data('id');
                    params.previd       = ui.item.prev().prop('id');
                   
                    AjaxCall(params,'PushLive');
                    
                },
            });
        }
        //$( ".sortable" ).disableSelection();
        
    };
    
};





/**
 * ContextMenu
 * ---------------------------------
 * 
 * @description Handle Context Menu on elements
 * 
 * @returns {ContextMenu}
 */
var ContextMenu = function(){
    
    /**
     * Context.ClickAction
     * ------------------------------
     * 01.06.2015
     * 
     * @param {type} e
     * @param {type} id
     * @returns {Boolean}
     */
    this.ClickAction = function( e, id ){
        
        var event = $(e);
        
        eval(event.data('call'))(event.data('service'), id);
        
        return false;
    };
    
    
};




/**
 * PageMenu
 * 
 * @description Handle Page Menu
 * 
 * @returns {PageMenu}
 */
var PageMenu = function(){
  
    var $O = this;
  
    /**
     * pageMenu.Click
     * ------------------------------
     * 01.06.2015
     * 
   * @returns {undefined}
   */
    this.Click = function(){
        var m = $('.mobile-menu');
        if(!m.length) return;
        
        var p = m.parent();
        var w = $('body').find('.wrap');
        if(p.hasClass('active')){
            p.removeClass('active');
            w.removeClass('active');
            enablePageScroll();
        } else {
            p.addClass('active');
            w.addClass('active');
            disablePageScroll();
        }
        
    };
    
    /**
     * pageMenu.Swipe
     * ------------------------------
     * 01.06.2015
     * 
     * @returns {undefined}
     */
    this.Swipe = function(){
       
       
        $('#body').touchwipe({
            wipeLeft: function() { $O.OpenMenu('left'); },
            wipeRight: function() { $O.OpenMenu('right'); },
            wipeUp: function() {  },
            wipeDown: function() {  },
            min_move_x: 150,
            min_move_y: 150,
            preventDefaultEvents: false
        });
        
        
        var m = $('.main-menu-list');
        if(m.length){
            $('.main-menu-list').touchwipe({
                wipeRight: function() { $O.OpenMenu('right'); },
                min_move_x: 150,
                min_move_y: 150,
                preventDefaultEvents: false
            });
        }
    };
    
    
    /**
     * pageMenu.OpenMenu
     * ------------------------------
     * 01.06.2015
     * 
     * @param {type} direction
     * @returns {undefined}
     */
    this.OpenMenu = function(direction){
        var w = $('body').find('.wrap');
        
        if(direction === 'right' && !w.hasClass('active') && !w.hasClass('r-active')){
            $O.Click();
           
            return;
        }
        
        if(direction === 'right' && w.hasClass('r-active')){
            mainMenu.Click();
           
            return;
        }
        
        if(direction === 'left' && w.hasClass('active')){
            $O.Click();
            return;
        }
        
        if(direction === 'left' && !w.hasClass('r-active')){
            mainMenu.Click();
          
            return;
        }
    };
    
    
};





/**
 * MainMenu
 * -----------------------------------
 * 
 * @description Handle Main Menu
 * 
 * @returns {MainMenu}
 */
var MainMenu = function(){
  
    var $O = this;
    
    /**
     * mainMenu.Click
     * ------------------------------
     * 01.06.2015
     * 
     * @returns {undefined}
     */
    this.Click = function(){
        var m = $('body').find('.main-mobile-menu');
        if(!m.length) return;
        
        var p = m.parent().find('ul');
        var h = m.parent();
        var w = $('body').find('.wrap');
        if(w.hasClass('r-active')){
            p.removeClass('active');
            w.removeClass('r-active');
            h.removeClass('active');
            enablePageScroll();
        } else {
            p.addClass('active');
            w.addClass('r-active');
            h.addClass('active');
            disablePageScroll();
        }
    };
    
};





/**
 * Bind
 * -----------------------------------
 * 
 * @description Bind double tap
 * 
 * @returns {Bind}
 */
var Bind = function(){
    
    /**
     * bindEvent.touchDouble
     * ------------------------------
     * 01.06.2015
     * 
     * @param {type} e
     * @returns {undefined}
     */
    this.touchDouble = function(e){
        
        if(isMobile){
            $(e).on('doubletap', function(){
                $(e).trigger('dblclick');
                return false;
            });
        }
        
    };
    
};






/**
 * OnScreen
 * -----------------------------------------
 * 
 * @description handle black pop up windows with forms
 * 
 * @returns {OnScreen}
 */
var OnScreen = function(){
    
    var onscreen = null;
    
    var self = this;
    
    /**
     * Onscreen.Open
     * ---------------------------
     * 24.06.2015
     * 
     * @param {type} _id
     * @returns {undefined}
     */
    this.Open  = function(_id){
        
        onscreen = $('body').find('#'+_id);
        
        var holder = onscreen.find('.onsc-tab-view-holder');
        
        if(holder.hasClass('custom-scrollbar')){
            
        } else {
           
            holder.addClass('custom-scrollbar');
        }
        
        
        if(onscreen.hasClass('active')){
            this._hide();
        }else{
            this._show(1);
        }
        
        this._click();
        
    };
    
    /**
     * Onscreen._click
     * ---------------------------
     * 24.06.2015
     * 
     * @returns {undefined}
     */
    this._click = function(){
        
        onscreen.find('.onsc-tab-holder span').on('click', function(){
            var index = ($(this).index()) + 1;
            self._show(index);
        });
        
    };
    
    
    /**
     * Onscreen._show
     * ---------------------------
     * 24.06.2015
     * 
     * @param {type} index
     * @returns {undefined}
     */
    this._show = function(index){
        onscreen.addClass('active');
        onscreen.find('.onsc-tab-holder span').removeClass('active');
        var activeTab = onscreen.find('.onsc-tab-holder span:nth-child('+index+')');
        activeTab.addClass('active');
        this._setTabData(activeTab.attr('rel'));
    };
    
    
    /**
     * Onscreen._hide
     * ---------------------------
     * 24.06.2015
     * 
     * @returns {undefined}
     */
    this._hide = function(){
        onscreen.removeClass('active');
    };
    
    
    /**
     * Onscreen._setTabData
     * ---------------------------
     * 24.06.2015
     * 
     * @param {type} rel
     * @returns {undefined}
     */
    this._setTabData = function(rel){
        onscreen.find('.onsc-tab-data').removeClass('active');
        onscreen.find('.onsc-tab-data[rel='+rel+']').addClass('active');
    };
};




var FotItem = new FooterItems();
var SelBox = new SelectBox();
var SF = new SubmitForm();
var Context = new ContextMenu();
var uploadManager = new UploadManager();
var pageMenu = new PageMenu();
var mainMenu = new MainMenu();
var inlineEdit = new InlineEdit();
var gridSortable = new GridSortable();
var bindEvent = new Bind();
var Onscreen = new OnScreen();

$(function(){
    
    FotItem.Init();
    SelBox.Init();
    SF.Init();

    pageMenu.Swipe();
    
    var timerId = setInterval(formatDate, 60000);
    
    formatDate();
    
    reInit();
    
});


function reInit(){
    $('.contextmenu').contextmenu();
    
    if($('body').find('.sortable').length){
        gridSortable.Init();
    }
    
    $(".load-on-screen").unveil(200, function() {
        $(this).load(function() {
            this.style.opacity = 1;
        });
    });
    
   
    
}