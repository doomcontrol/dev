








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
    
    
    this.ClickAction = function( e ){
        
        var event = $(e);
        
        eval(event.data('call'))();
        
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
            DisableBodyScroll(false);
        } else {
            p.addClass('active');
            w.addClass('active');
            DisableBodyScroll(true);
        }
        
    };
    
    this.Swipe = function(){
       
       
        $('#body').touchwipe({
            wipeLeft: function() { $O.OpenMenu('left'); },
            wipeRight: function() { $O.OpenMenu('right'); },
            wipeUp: function() { $('#server_info').text("up"); },
            wipeDown: function() { $('#server_info').text("down"); },
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
            DisableBodyScroll(false);
        } else {
            p.addClass('active');
            w.addClass('r-active');
            h.addClass('active');
            DisableBodyScroll(true);
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

$(function(){
    
    FotItem.Init();
    SelBox.Init();
    SF.Init();

    pageMenu.Swipe();
    
    var timerId = setInterval(formatDate, 60000);
    
    formatDate();
    
    $('.contextmenu').contextmenu();
    
    


    
});