

var InlineEdit = function(){
  
    var $O = this;
  
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
    
    
    this.close = function( Data ){
        
        Data.targetInline.removeClass('active');
        Data.targetFields.removeClass('active');
        Data.targetMask.removeClass('active');
        
    };
    
    
    
};


var GridSortable = function (){
    
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
 * STEP CONTROL
 * ----------------------------------------------------------
 * 
 * @returns {StepControl}
 */
var StepControl = function(){
    
    var $O = this;
    
    this.Set = function(id){
        
        var formHolder = $('body').find('#'+id).closest('.form-holder');
        var a = formHolder.find('.form-screen');
        
        a.on('click',function(){
            
            formHolder.addClass('active');
            
            var m = formHolder.find('.form-mask');
            
            var d = $(this).data('step');
            
            if(d === ""){ d = "step-1"; }
            
            formHolder.find('.'+d).addClass('active');
            
            formHolder.find('ul li a.main').on('click',function(){
                
                formHolder.find('ul li').removeClass('active');
                formHolder.find('ul li a.main').removeClass('active');
                $(this).addClass('active');
                $(this).parent().addClass('active');
            });
            
            m.unbind().on('click',function(){
                formHolder.removeClass('active');
                formHolder.find('.'+d).removeClass('active');
                formHolder.find('ul li').removeClass('active');
                formHolder.find('ul li a.main').removeClass('active');
                
                formHolder.find('ul li:nth-child(1)').addClass('active');
            });
            
            
        });
    };
};



var ContextMenu = function(){
    
    
    this.ClickAction = function( e, id ){
        
        var event = $(e);
        
        eval(event.data('call'))(event.data('service'), id);
        
        return false;
    };
    
    
};

var PageMenu = function(){
  
    var $O = this;
  
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


var MainMenu = function(){
  
    var $O = this;
    
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



var Bind = function(){
    
    this.touchDouble = function(e){
        
        if(isMobile){
            $(e).on('doubletap', function(){
                $(e).trigger('dblclick');
                return false;
            });
        }
        
    };
    
};




var FotItem = new FooterItems();
var StepCtrl = new StepControl();
var SelBox = new SelectBox();
var SF = new SubmitForm();
var Context = new ContextMenu();
var uploadManager = new UploadManager();
var pageMenu = new PageMenu();
var mainMenu = new MainMenu();
var inlineEdit = new InlineEdit();
var gridSortable = new GridSortable();
var bindEvent = new Bind();

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

(function( win ){
	var doc = win.document;
	
	// If there's a hash, or addEventListener is undefined, stop here
	if( !location.hash && win.addEventListener ){
		
		//scroll to 1
		window.scrollTo( 0, 1 );
		var scrollTop = 1,
			getScrollTop = function(){
				return win.pageYOffset || doc.compatMode === "CSS1Compat" && doc.documentElement.scrollTop || doc.body.scrollTop || 0;
			},
		
			//reset to 0 on bodyready, if needed
			bodycheck = setInterval(function(){
				if( doc.body ){
					clearInterval( bodycheck );
					scrollTop = getScrollTop();
					win.scrollTo( 0, scrollTop === 1 ? 0 : 1 );
				}	
			}, 15 );
		
		win.addEventListener( "load", function(){
			setTimeout(function(){
				//at load, if user hasn't scrolled more than 20 or so...
				if( getScrollTop() < 20 ){
					//reset to hide addr bar at onload
					win.scrollTo( 0, scrollTop === 1 ? 0 : 1 );
				}
			}, 0);
		} );
	}
})( this );