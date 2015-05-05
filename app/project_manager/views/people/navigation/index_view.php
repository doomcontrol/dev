<div class="page-main-navigation animate" id="pagemenu">
    <div class="mobile-menu" onclick="pageMenu.Click();"><i class="icon-reorder"></i></div>
    <ul class="reset clr list-menu animate">
        <?php foreach ($nav_items as $item): ?> 
        <li class="reset clr animate">
            <a href="<?=$item['link']?>" >
                <b><?= \gui_text($item['name'])?></b>
                <?= $item['icon'] ? '<i class="'.$item['icon'].'"></i>' : ''?> 
            </a>
        </li>
        <?php endforeach; ?> 
    </ul>
</div>