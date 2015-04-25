<div class="quick-user">
    <img src="<?=assets_url('clients/hid/users/thumb/christophe-dd1.png')?>" class="avatar" />
    <h5><?= $user->getFirstName() ?> <?= $user->getLastName() ?><span><?= $user->isOwner() ? 'Owner' : ''?></span></h5>
    <div class="drop-hold animate">
        <a href="<?=site_url('logout')?>" class="link-br"><i class="icon-signout"></i> Logout</a>
        <span class="space">&nbsp;</span>
        <a href="<?=site_url('my_profile')?>" class="link-br"><i class="icon-user"></i> My Profile</a>
    </div>
</div>