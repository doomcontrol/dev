<div class="clr docpage">
    <h1>Library::Doctrine <a href="<?=site_url('documentation/library')?>">Library</a></h1>
    <div class="leftside">
        <?=$navigation?>
    </div>
    <div class="rightside">
        <h3>Entity Manager</h3>
        <div class="summary">Doctrine entity manager is implemented in core.</div>
        <pre class="prettyprint linenums lang-php">
        <?= prettify('global $core;')?>
        <?= prettify('')?>
        <?= prettify('$entityManager = $core->em;')?>
        </pre>
        <div class="summary">Entity manager in Repository is used differently.</div>
        <pre class="prettyprint linenums lang-php">
        <?= prettify('$entityManager = $this->_em;')?>
        </pre>
        
        
        <h3>Register New Model Path</h3>
        <div class="summary">You can tell doctrine to use new model path in application with this function.</div>
        <pre class="prettyprint linenums lang-php">
        <?= prettify('global $core;')?>
        <?= prettify('')?>
        <?= prettify('$core->doctrine->register_model("myNewDirPath");')?>
        </pre>
        
        
        <h3>Register Entity Path</h3>
        <div class="summary">You can tell doctrine to use new entity path in application with this function.</div>
        <pre class="prettyprint linenums lang-php">
        <?= prettify('global $core;')?>
        <?= prettify('')?>
        <?= prettify('$core->doctrine->register_entities("myNewDirPath");')?>
        </pre>
    </div>
</div>