<div class="clr docpage">
    <h1>Library::Output <a href="<?=site_url('documentation/library')?>">Library</a></h1>
    <div class="leftside">
        <?=$navigation?>
    </div>
    <div class="rightside">
        <h3>Output JSON</h3>
        <?php $array = array("title"=>"My Title","summary"=>"this is my summary","id"=>23);?>
        <div class="summary">This function will outpout on screen array or object data like json with json header. After execution output, application will exit with die() function;
            <p>This library is already included in core</p>
        </div>
        <pre class="prettyprint linenums lang-php">
        <?= prettify('$array = array("title"=>"My Title","summary"=>"this is my summary","id"=>23);')?>
        <?= prettify('$core->output->json($array);')?>
        <?= prettify("")?>
        <?= prettify("//Result with exit application")?>
        <?= prettify( $core->output->json($array, false))?>
        <?= prettify("")?>
        <?= prettify("//Or we want to be returned like string")?>
        <?= prettify('$json = $core->output->json($array, false);')?>
        <?= prettify('echo $json;')?>
        <?= prettify("")?>
        <?= prettify("//Result without exit application")?>
        <?= prettify( $core->output->json($array, false))?>
        </pre>
    </div>
</div>