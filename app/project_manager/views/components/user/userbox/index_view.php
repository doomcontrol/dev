<div class="cart_view clr animate contextmenu noselect" id="cart-<?=$user->getID()?>"> 
    <div class="cart_view_head"> 
        <img class="groupicon" src="<?=  assets_url('img/'.  \user_obj_definition($user,true)->getIcon())?>" />
        <h3><?= $user->getfullName()?></h3> 
        <a href="mailto:<?=$user->getEmail()?>" class="mail"><?=$user->getEmail()?></a>
    </div>
    <div class="contextmenu-holder noselect">
        <div class="cxh-title">Edit User Data</div>
        <ul class="reset clr">
            <li class="reset main"><a href="#">Edit Name</a></li>
            <li class="reset main"><a href="#">Edit Group</a></li>
            <li class="reset main"><a href="#">Edit Email</a></li>
            <li class="reset main"><a href="#" data-call="uploadManager.Open" onclick="Context.ClickAction(this);return false;">Edit Avatar Icon</a></li>
        </ul>
    </div>
</div>