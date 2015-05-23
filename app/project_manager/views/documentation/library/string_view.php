<div class="clr docpage">
    <h1>Library::String <a href="<?=site_url('documentation/library')?>">Library</a></h1>
    <div class="leftside">
        <?=$navigation?>
    </div>
    <div class="rightside">
        
        <h3>Strip Aplha Numeric characters from string</h3>
        
        <div class="summary">Strip Aplha Numeric requires one arguments and second is optional.
            <p>
                Second parametar is used when want to extend regex.
            </p>
        </div>
        <?php $core->load->library("String")?>
        <pre class="prettyprint linenums lang-php">
        <?= prettify('global $core;')?>
        <?= prettify('$core->load->library("String")')?>
        <?= prettify('$string = "Sample string this test isn`t what you want. (maybe you want to striped this). ";');?>
        <?= prettify('$core->library->string->strip_alphanumeric($string);')?>
        <?= prettify('// Result:')?>
        <?= prettify($core->library->string->strip_alphanumeric("Sample string this test isn`t what you want. (maybe you want to striped this). "))?>
        <?= prettify('// default regex is /[^a-zA-Z0-9\s]/')?>
        </pre>
    </div>
</div>