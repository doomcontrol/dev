<div class="cartview-avatar" id="userAvatar<?=$id?>">
    <?php if($image): ?>
    <img src="<?=  assets_url('clients/default-avatar.jpg')?>" data-src="<?= avatar_url('medium/'.$image) ?>" class="load-on-screen animate" />
    <?php endif; ?>
</div>
<?php if($reInit): ?> 
<script>reInit();</script>
<?php endif; ?> 