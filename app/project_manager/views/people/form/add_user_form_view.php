<div class="form-holder">
    <div class="form-mask"></div>
    <a href="#" class="form-screen round-center" data-step="step-1"><i class="icon-plus">&nbsp;</i>Add user</a>
    <div class="step-1 onscreen animate boxshadow">
        <form id="<?= $form_data['form_id']?>" method="<?= $form_data['method']?>" action="<?= $form_data['action']?>" data-class="People" data-funct="AddNew" >
            <ul class="reset clr">
                <li class="reset active main"><a href="#" class="active main">
                    <i class="icon-pencil ">&nbsp;</i>User data</a>
                    <ul class="reset clr">
                        <li><label>First Name:<span title="required field">*</span></label><input type="text" name="first_name" value="" class="boxsizing" spellcheck="false" required></li>
                        <li><label>Last Name:<span title="required field">*</span></label><input type="text" name="last_name" value="" class="boxsizing" spellcheck="false" required></li>
                        <li><label>Email:<span title="required field">*</span></label><input type="email" name="email" value="" class="boxsizing" spellcheck="false" required></li>
                    </ul>
                </li>
                <li class="reset main"><a href="#" class="main">
                        <i class="icon-group">&nbsp;</i>Pick Group</a>
                        <ul class="reset clr holder">
                            <li>
                                <select name="group" style="width:200px;">
                                    <?php foreach($form_data['groups'] as $group): ?> 
                                    <option value="<?= $group->getID() ?>" <?= $group->getID() == 3 ? 'selected' : ''?>><?= \gui_text($group->getName()) ?></option>
                                    <?php endforeach; ?> 
                                </select>
                            </li>
                    </ul>
                </li>
                <li class="reset main"><a href="#" class="main">
                        <i class="icon-hand-right">&nbsp;</i>Save</a>
                        <ul class="reset clr holder">
                            <li><input type="button" name="submitform" value="Save & invite" class="button blue animate-fast margin30" onclick="SF.Init('<?= $form_data['form_id']?>');"></li>
                    </ul>
                </li>
            </ul>
        </form>
    </div>
</div>
