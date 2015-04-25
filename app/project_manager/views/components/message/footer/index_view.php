<div class="item <?=count($messages) ? 'warning':''?> message ra">
    <span class="button-item noselect"><i class="icon-comment <?=count($messages) ? 'bounce':''?>">&nbsp;</i> Message</span>
    <div class="item-holder msg animate">
        <div class="message-header">Ukupno <span><?=count($messages)?></span> poruke</div>
        <ul class="reset" id="footmessage">
            <?php foreach($messages as $message):?>
            
            <li class="reset"><h5><span class="message-sender"><?=$message->getUser()->getFullName()?>:</span><?=$message->getTitle()?></h5><abbr class="timeago" title="<?=$message->getPostDateISO()?>"><?=$message->getPostDateISO()?></abbr><?=$message->getMessage()?><i class="icon-check" title="Mark as readed" data-id="<?=$message->getID()?>">&nbsp;</i><i class="icon-pencil" title="Write Replay">&nbsp;</i></li>
            
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="mask"></div>
    <div class="onscreen animate">
        <ul class="reset clr">
            <li class="reset active main"><a href="#" class="active main"  >
                <i class="icon-pencil">&nbsp;</i>Write message</a>
                <ul class="reset clr">
                    <li><label>Title:<span title="required field">*</span></label><input type="text" name="title" value="" class="boxsizing" spellcheck="false" /></li>
                    <li><label>Message:<span title="required field">*</span></label><textarea name="message" spellcheck="false" class="boxsizing"></textarea></li>
                </ul>
            </li>
            <li class="reset main"><a href="#" class="main" >
                    <i class="icon-group">&nbsp;</i>Notified users</a>
                    <ul class="reset clr holder">
                    <li></li>
                </ul>
            </li>
            <li class="reset main"><a href="#" class="main" >
                    <i class="icon-hand-right">&nbsp;</i>Send</a>
                    <ul class="reset clr holder">
                        <li><input type="button" name="sendmessage" value="Send" class="button blue animate-fast margin30" /></li>
                </ul>
            </li>
        </ul>
        
    </div>
</div>