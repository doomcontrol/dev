<div class="clr docpage">
    <h1>Library::Minify <a href="<?=site_url('documentation/library')?>">Library</a></h1>
    <div class="leftside">
        <?=$navigation?>
    </div>
    <div class="rightside">
        <h3>Exec</h3>
        <?php $string = "body {" . "\n"; ?>
        <?php $string.= " color:#fff;" . "\n"; ?> 
        <?php $string.= "}" . "\n"; ?> 
        <?php $core->load->library('Minify') ?>
        <div class="summary">This function will return minified string (javascript or css)
        </div>
        <pre class="prettyprint linenums lang-css">
        <?= prettify("body {")?>
        <?= prettify(" color:#fff;")?>
        <?= prettify("}")?>
        <?= prettify("")?>
        <?= prettify("//Result")?>
        <?= prettify( $core->library->minify->exec($string,'CSS'))?>
        </pre>
        <div class="summary">php used sample
        </div>
        <pre class="prettyprint linenums lang-php">
        <?= prettify('$core->load->library("Minify")')?>
        <?= prettify("// if we minified css")?>
        <?= prettify('echo $core->library->minify->exec($string,"CSS"))')?>
        <?= prettify("// if we minified js")?>
        <?= prettify('echo $core->library->minify->exec($string,"JS"))')?>
        </pre>
    </div>
</div>