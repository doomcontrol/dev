<div class="ui-state-default cart_view clr contextmenu noselect" id="cartUser<?=$user->getID()?>" data-id="<?=$user->getID()?>" data-sortableclass="People" data-sortablefunct="Position" data-position="<?=$user->getPosition()?>" data-class="People" data-funct="EditForm" ondblclick="LoadView(this);" onclick="bindEvent.touchDouble(this)"> 
    <div class="cart_view_head"> 
        <?= \components\user\useravatar\cartview\Component::display($user->getAvatar(), $user->getID())?>
        <img class="groupicon" src="<?=  assets_url('img/'.  \user_obj_definition($user,true)->getIcon())?>" />
        <h3 class="name user<?=$user->getID()?> userFullName<?=$user->getID()?>"><?= $user->getfullName()?></h3> 
        <a href="mailto:<?=$user->getEmail()?>" class="mail user<?=$user->getID()?> userEmail<?=$user->getID()?>"><?=$user->getEmail()?></a>
    </div>
    <div class="contextmenu-holder noselect">
        <div class="cxh-title">Edit User Data</div>
        <ul class="reset clr">
            <li class="reset main"><a href="#" data-class="People" data-funct="EditName" data-id="<?=$user->getID()?>" data-inline="#inline<?=$user->getID()?>" data-fields="#editname<?=$user->getID()?>" onclick="inlineEdit.Open(this); return false;" >Edit Name</a></li>
            <li class="reset main"><a href="#" data-class="People" data-funct="EditGroup" data-id="<?=$user->getID()?>" data-inline="#inline<?=$user->getID()?>" data-fields="#editgroup<?=$user->getID()?>" onclick="inlineEdit.Open(this); return false;">Edit Group</a></li>
            <li class="reset main"><a href="#" data-class="People" data-funct="EditEmail" data-id="<?=$user->getID()?>" data-inline="#inline<?=$user->getID()?>" data-fields="#editemail<?=$user->getID()?>" onclick="inlineEdit.Open(this); return false;" >Edit Email</a></li>
            <li class="reset main"><a href="#" data-call="uploadManager.Open" data-service="userAvatar" onclick="Context.ClickAction(this,<?=$user->getID()?>);return false;">Edit Avatar Icon</a></li>
        </ul>
    </div>
    <div class="inline-mask"></div>
    <div class="inline-edit" id="inline<?=$user->getID()?>">
        <div class="inline-edit-item field_useremail " id="editemail<?=$user->getID()?>">
            <label>Email</label>
            <input type="text" name="field_useremail" value="<?=$user->getEmail()?>" class="boxsizing" />
            <div class="inline-btt">
                <input type="submit" name="Save" value="Save" /> <span class="inline-cancel"><i class="icon-remove"></i> Cancel</span>
            </div>
        </div>
        <div class="inline-edit-item field_userfullname" id="editname<?=$user->getID()?>">
            <label>First Name</label>
            <input type="text" name="field_first_name" value="<?=$user->getName()?>" class="boxsizing" />
            <label>Last Name</label>
            <input type="text" name="field_last_name" value="<?=$user->getLastName()?>" class="boxsizing" />
            <div class="inline-btt">
                <input type="submit" name="Save" value="Save" /> <span class="inline-cancel"><i class="icon-remove"></i> Cancel</span>
            </div>
        </div>
        <div class="inline-edit-item field_usergroup" id="editgroup<?=$user->getID()?>">
            <label>Set Group</label>
            <select name="group" style="width:200px;">
                <?php foreach($form_data['groups'] as $group): ?> 
                <option value="<?= $group->getID() ?>" <?= $group->getID() == 3 ? 'selected' : ''?>><?= \gui_text($group->getName()) ?></option>
                <?php endforeach; ?> 
            </select>
            <div class="inline-btt">
                <input type="submit" name="Save" value="Save" /> <span class="inline-cancel"><i class="icon-remove"></i> Cancel</span>
            </div>
        </div>
    </div>
</div>