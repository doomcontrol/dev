

/**
 * SUBMIT FORM
 * ----------------------------------------------------
 * 
 * @returns {SubmitForm}
 */
var SubmitForm = function(){
    
    this.Init = function(form_id){
        
        var form = $('body').find('#'+form_id);
        
        var inputs = form.find('input');
        var textareas = form.find('textarea');
        var selects = form.find('select');
        
        var validate = true;
        var validateEmails = true;
        
        /* validate inputs */
        $.each(inputs, function(index,item){
            
            var inp = $(item);
            
            var vld = true;
            
            if(inp.val().trim().length === 0 && inp.prop('required')){ validate = false; inp.addClass('error');vld = false;
            } else { vld = true; inp.removeClass('error'); }
            
            if(inp.prop('type') == 'email' && vld === true){ var vem = validateEmail(inp.val());
                if(vem){ inp.removeClass('error'); } 
                else {
                    inp.addClass('error');
                    validate = false;
                    validateEmails = false;
                }
            }
        });
        
        /*
        //TODO dodati proveru za textarea i select*/

        
        if(!validate){ AlertMessage('field_required_error'); }
        if(!validateEmails){ AlertMessage('email_field_required_error'); }
        
        if(validate){
            
            var params = {};
            
            form.find('input, textarea, select').each(function(){
                params[$(this).prop('name')] = $(this).val();
            });
            
            params['classObj'] = form.data('class');
            params['classFunct'] = form.data('funct');
            
            AjaxCall(params, 'SendLive');
            
            form.find('input, textarea ').each(function(){
                 if( $(this).prop('type') !== 'button' && $(this).prop('type') !== 'submit' && $(this).prop('type') !== 'radio' && $(this).prop('type') !== 'checkbox'){
                     $(this).val('');
                 }
            });
            
            $('body').find('.form-holder').removeClass('active');
            $('body').find('.form-holder .onscreen').removeClass('active');
            
        }
        
    };
    
};