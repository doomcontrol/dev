<div class="clr docpage">
    <h1>Helper::Form <a href="<?=site_url('documentation/helper')?>">Helper</a></h1>
    <div class="leftside">
        <?=$navigation?>
    </div>
    <div class="rightside">
        <h3>Is Submited</h3>
        <div class="summary">Check if some form is submited. Result is boolean</div>
        <pre class="prettyprint linenums lang-php">
        <?= prettify('isSubmit();')?>
        <?= prettify('//Result: true / false')?>
        </pre>
        
        <h3>Is Serialized</h3>
        <div class="summary">Check if some string is serialized. Result is boolean or is unserialized if second argument is set to true</div>
        <pre class="prettyprint linenums lang-php">
        <?= prettify('is_serialized($str);')?>
        <?= prettify('//Result: true / false')?>
        <?= prettify('')?>
        <?= prettify('is_serialized($str, true);')?>
        <?= prettify('//Result: unserialized data')?>
        </pre>
    </div>
</div>