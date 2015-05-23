<div class="boxsizing boxshadow extended-window userform" id="editUserForm<?=$user->getID()?>" data-class="People" data-funct="SaveForm">
    <h2>EDIT USER<em><label>Joined:</label><abbr class="timeago" title="<?= $user->getJoinedISO()?>">...</abbr></em></h2>
    <div class="scrollholder">
        <input type="hidden" name="id" value="<?=$user->getID()?>" />

        <div class="cartview-avatar" id="userFormAvatar<?=$user->getID()?>">
        <?php if($user->getAvatar()): ?>
        <img src="<?= avatar_url('small/'.$user->getAvatar()) ?>"  />
        <?php endif; ?>
        </div>

        <div class="user-form-base-info clr" id="userformbaseinfo<?=$user->getID()?>">
            <div class="form-item">
                <label>First Name:</label><input type="text" name="fname" value="<?=$user->getName()?>" />
            </div>
            <div class="form-item">
                <label>Lat Name:</label><input type="text" name="lname" value="<?=$user->getLastName()?>" />
            </div>
            <div class="form-item">
                <label>Email:</label><input type="text" name="email" value="<?=$user->getEmail()?>" />
            </div>
        </div>

        <div class="user-form-extend-info">
            <fieldset>
                <legend>Login data</legend>
                <div class="form-item">
                    <label>Username:</label><input type="text" name="username" value="<?=$user->getUsername()?>" />
                </div>
                <div class="form-item">
                    <label>Passord:</label><input type="password" name="password" value="" placeholder="******" />
                </div>
            </fieldset>
            <fieldset>
                <legend>Group</legend>
                <div class="form-item">
                    <select name="group" style="width:200px;">
                    <?php foreach($form_data['groups'] as $group): ?> 
                    <option value="<?= $group->getID() ?>" <?= $group->getID() == \user_obj_definition($user,false) ? 'selected' : ''?>><?= \gui_text($group->getName()) ?></option>
                    <?php endforeach; ?> 
                </select>
                </div>
            </fieldset>
        </div>


    </div>
    <div class="inline-btt">
        <input type="submit" name="Save" value="Save" onclick="SF.Init('editUserForm<?=$user->getID()?>', false);" /> <span class="inline-cancel" ><i class="icon-remove"></i> Cancel</span>
    </div>
</div>
<script>SelBox.Init();</script>
