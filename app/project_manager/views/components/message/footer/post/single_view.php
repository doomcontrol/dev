<li class="reset">
    <h5>
        <span class="message-sender"><?=$message->getUser()->getfullName()?>:</span><?=$message->getTitle()?></h5>
    <abbr class="timeago" title="<?=$message->getPostDateISO()?>">Just now</abbr><?= nl2br($message->getMessage())?>
        <i class="icon-check" title="Mark as readed" data-id="<?=$message->getID()?>">&nbsp;</i>
</li>