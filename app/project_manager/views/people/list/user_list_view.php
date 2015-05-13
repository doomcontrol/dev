<div class="magtop user_lists clr carts">
    <?php foreach ($groups as $group): ?>
    <div class=" usercell boxsizing" id="group_<?=$group->getID()?>" data-id="<?=$group->getID()?>"> 
        
        <h2><img src="<?=  assets_url('img/'.$group->getIcon())?>" /><?= \gui_text($group->getName())?></h2>
        <div class="sortable">
        <?php foreach($users as $user): ?> 
            <?php foreach($user->getUserGroupDefinition() as $userGroupDefinition): ?> 
                <?php if($userGroupDefinition->getID() == $group->getID()): ?>
                <?php $data = []; $data['user'] = $user; $data['group'] = $group; ?>
                <?= \components\user\userbox\Component::Display($data)?>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endforeach; ?> 
        </div>
    </div>
    <?php endforeach; ?> 
</div>