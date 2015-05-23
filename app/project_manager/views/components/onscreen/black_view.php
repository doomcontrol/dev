<!-- start onscreen -->
<div class="onscreen animate boxshadow" id="<?php Echo $onscreenId; ?>">
    
    <div class="onsc-tab-holder">
        <?php foreach ($config['tabs'] as $key => $value):?> 
        <span rel="onsc-<?php Echo $key; ?>"><?php Echo $value; ?></span>
        <?php endforeach; ?> 
    </div>
    
    <div class="onsc-tab-view-holder">
        <?php foreach($config['form'] as $key => $tabData): ?> 
        <div class="onsc-tab-data" rel="onsc-<?php Echo $key; ?>">
            <?php Echo $tabData['view']; ?>
        </div>
        <?php endforeach; ?> 
    </div>
    
</div>
<!-- end onscreen -->
