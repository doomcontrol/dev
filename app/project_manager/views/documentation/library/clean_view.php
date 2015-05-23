<div class="clr docpage">
    <h1>Library::Clean <a href="<?=site_url('documentation/library')?>">Library</a></h1>
    <div class="leftside">
        <?=$navigation?>
    </div>
    <div class="rightside">
        <h3>Clean String</h3>
        <div class="summary">This function used to clean or validate string. If is returning empty result (<strong>null</strong>) , string is not validly.</div>
        <?php $string="This is sample <a href=\"#\">HTML element</a> After element"; ?>
        <pre class="prettyprint linenums lang-php">
        <?= prettify('$string="This is sample <a href=\"#\">HTML element</a> After element";')?>
        <?= prettify('$core->clean->cleanString($string,\'HTML|XSS\');')?>
        <?= prettify('')?>
        <?= prettify('Result: ' . $core->clean->cleanString($string,'HTML|XSS'))?>
        </pre>
        <div class="summary">You can chose what you want to clean. You can use <strong>HTML</strong>,<strong>XSS</strong>,<strong>NUM</strong>,<strong>EMAIL</strong> action</div>
        
        
        <h3>Trim</h3>
        <div class="summary">This function used to remove blank spaces.
            <p>Last Arguments is with which we will replace empty spaces.</p>
        </div>
        <?php $string="This is sample"; ?>
        <pre class="prettyprint linenums lang-php">
        <?= prettify('$string="This is sample";')?>
        <?= prettify('$core->clean->cleanString($string,"TRIM", "");')?>
        <?= prettify('')?>
        <?= prettify('Result: ' . $core->clean->cleanString($string,"TRIM", ""))?>
        </pre>
    </div>
</div>