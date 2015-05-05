
var UploadManager = function(){
    
    var UM = "uploadManager.";
    var $O = this;
    var object;
    
    this.Open = function(){
        
        var params = {
            classObj:'Upload',
            classFunct:'BoxView',
        };
    
        AjaxCall(params, UM + "_callbackDisplay");
    };
    
    
    this._callbackDisplay = function(response){
        
       
            $O._removeBox();
            
            $('body').append(response.strOutput);
            
            object          = new Object();
            object.mask         = $('body').find('.removable-mask');
            object.popup        = $('body').find('.removable.onscreen');
            object.drop         = $('body').find('.upload-box');
            object.dropId       = object.drop.prop('id');
            object.input        = object.drop.find('input[type=file]');
            object.mask.click   = function(){ object.mask.on('click',function(){ $O._removeBox(); }); };
                
            
            object.mask.click();
            
            $O._dropEvents( object )

    };
    
    this._removeBox = function(){
       
        $('body').find('.removable-mask').remove();
        $('body').find('.removable.onscreen').remove();
    };
    
    this._dropEvents = function( object ){
      
        var id = object.input.prop('id');
        
        var inputElement = document.getElementById(id);
        
        var selectedFile = inputElement.files[0];
        
        inputElement.addEventListener("change", $O._handleFiles, false);
        
     
        
    };
    
    
    
    this._handleFiles = function(){
        
        var fileList = this.files; 
        
        var numFiles = fileList.length;
        
        var file;
        
        for (var i = 0, numFiles = fileList.length; i < numFiles; i++) {
            
            file = fileList[i];
        }
        
        /*//TODO videti sta sa ovim raditi*/
        var uploadData = $O._getUploadSize(fileList);
        
        
        $O._sendFiles(fileList, object);
    };
    
    
    
    this._getUploadSize = function(fileList){
      
        
        var nBytes = 0,
            oFiles = fileList,
            nFiles = oFiles.length;
        for (var nFileId = 0; nFileId < nFiles; nFileId++) {
          nBytes += oFiles[nFileId].size;
        }
        var sOutput = nBytes + " bytes";

        for (var aMultiples = ["KiB", "MiB", "GiB", "TiB", "PiB", "EiB", "ZiB", "YiB"], nMultiple = 0, nApprox = nBytes / 1024; nApprox > 1; nApprox /= 1024, nMultiple++) {
          sOutput = nApprox.toFixed(3) + " " + aMultiples[nMultiple] + " (" + nBytes + " bytes)";
        }
        
        var fileData            = new Object();
            fileData.totalFiles = nFiles;
            fileData.size       = sOutput;
        
        return fileData;
          
        
    };
    
    
    this._sendFiles = function(fileList, object){
  
        for (var i = 0; i < fileList.length; i++) {
          
            new FileUpload(fileList[i], object);
        }
        
        
    };
   
};



function FileUpload(file, object) {
        
        console.log(file);
        
        var self = this;
        
        var throberId       = object.drop.find('.loader').prop('id');
        
        var ctrl            = object.drop.find('.message');
        var initMessage     = object.drop.find('.init-text-upload');
        var rememberMessage = initMessage.html();
        var processingText  = object.drop.data('processing');
        
        initMessage.html('');
    
        var throb = Throbber({
            color: 'yellow',
            padding: 30,
            size: 40,
            fade: 200,
            clockwise: false
        }).appendTo( document.getElementById( throberId ) ).start();

       
        throb.toggle();
        
    
        var reader  = new FileReader();  
       
        var formData = new FormData();
        formData.append('file', file);
        

        var xhr = new XMLHttpRequest();
        
        
       xhr.upload.onprogress = function(e) {
        if (e.lengthComputable) { 
                var progressBar = new Object();
                progressBar.value = (e.loaded / e.total) * 100;
                progressBar.textContent = progressBar.value; /*// Fallback for unsupported browsers.*/
                
                var precision = Math.round(progressBar.value ? progressBar.value : progressBar.textContent);
                
                ctrl.html( (precision) + ' %');
                
                if(precision > 99){
                    ctrl.addClass('blink').html(processingText);
                }
            }
        };
        
        xhr.open('POST', '/', true);
        xhr.setRequestHeader('X-Requested-With','XMLHttpRequest');
        
        xhr.onload = function(e) {
            if (this.status == 200) {
               /*// console.log(this.response);*/
            } else {
                console.log(e);
                console.log(this);
                console.log('error');
            }
        };

        xhr.send(formData);
        
       
};

