<div class="magtop user_lists clr carts animate">
    <?php foreach ($groups as $group): ?>
    <div class="usercell group_<?=$group->getID()?> boxsizing animate"> 
        <h2><img src="<?=  assets_url('img/'.$group->getIcon())?>" /><?= \gui_text($group->getName())?></h2>
        <?php foreach($users as $user): ?> 
            <?php foreach($user->getUserGroupDefinition() as $userGroupDefinition): ?> 
                <?php if($userGroupDefinition->getID() == $group->getID()): ?>
                <?php $data = []; $data['user'] = $user; $data['group'] = $group; ?>
                <?= \components\user\userbox\Component::Display($data)?>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endforeach; ?> 
    </div>
    <?php endforeach; ?> 
</div>