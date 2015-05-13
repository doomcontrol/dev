<div class="removable-mask active"></div>
<div class="removable onscreen uploadbox boxshadow active">
    
    <form id="adduser1430464649" method="post" action="/call" data-class="Upload" data-funct="DoUpload" data-service="<?=$service?>" data-id="<?=$id?>" class="fullscreen boxsizing">
        <div class="upload-box boxsizing" id="dropbox_<?=time()?>" data-processing="Processing...">
            <div class="uploadclick fullscreen">
                <span class="init-text-upload">
                <i class="icon-upload-alt">&nbsp;</i><br />
                DRAG&DROP FILE<br/>
                <small>or click here to chose file</small>
                
                </span>
                <input type="file" id="input" class="boxsizing" id="file_<?=time()?>" />
                <div class="throbber">
                    <div class="loader" id="throbber_<?=time()?>"></div>
                    <div class="message" id="message_<?=time()?>"></div>
                </div>
            </div>

        </div>        
    </form>
</div>