<div class="clr docpage">
    <h1>Basic::Index File <a href="<?=site_url('documentation/basic')?>">Basic</a></h1>
    <div class="leftside">
        <?=$navigation?>
    </div>
    <div class="rightside">
        <h3>Index.php</h3>
        <div class="summary">This file is located in the Public Folder
            <p>File contains definition's, autoloader included, core initializations, session initializations, asset's initializations</p>
        </div>
        
        <h3>SECRET KEY definition</h3>
        <div class="summary">This is used in crypt session data</div>
        <pre class="prettyprint linenums lang-php">
        <?= prettify('define(\'SECRET_KEY\', \'go%47*55i37oyp\');')?>
        </pre>
        
        <h3>SESSION TIMEOUT definition</h3>
        <div class="summary">This is used as default session timeout</div>
        <pre class="prettyprint linenums lang-php">
        <?= prettify('define(\'SESSION_TIMEOUT\', 60);')?>
        </pre>
        
        <h3>ENVIRONMENT definition</h3>
        <div class="summary">Define default ENVIRONMENT of application. Can be development or production</div>
        <pre class="prettyprint linenums lang-php">
        <?= prettify('define(\'ENVIRONMENT\', \'development\');')?>
        </pre>
        
        <h3>DIR definition</h3>
        <div class="summary">Define default public server directory path</div>
        <pre class="prettyprint linenums lang-php">
        <?= prettify('define(\'DIR\', __DIR__.DIRECTORY_SEPARATOR);')?>
        <?= prettify('//Result: ' . DIR)?>
        </pre>
        
        <h3>CORE definition</h3>
        <div class="summary">Define default core server directory path</div>
        <pre class="prettyprint linenums lang-php">
        <?= prettify('define(\'CORE\', DIR . \'..\' . DIRECTORY_SEPARATOR . \'core\' . DIRECTORY_SEPARATOR);')?>
        <?= prettify('//Result: ' . CORE)?>
        </pre>
        
        <h3>APP definition</h3>
        <div class="summary">Define default app server directory path</div>
        <pre class="prettyprint linenums lang-php">
        <?= prettify('define(\'APP\', DIR . \'..\' . DIRECTORY_SEPARATOR . \'app\' . DIRECTORY_SEPARATOR . \'project_manager\' . DIRECTORY_SEPARATOR);')?>
        <?= prettify('//Result: ' . APP)?>
        </pre>
        
        <h3>VENDOR definition</h3>
        <div class="summary">Define default vendor server directory path</div>
        <pre class="prettyprint linenums lang-php">
        <?= prettify('define(\'VENDOR\', DIR . \'..\' . DIRECTORY_SEPARATOR . \'vendor\' . DIRECTORY_SEPARATOR);')?>
        <?= prettify('//Result: ' . VENDOR)?>
        </pre>
        
        <h3>ASSETS definition</h3>
        <div class="summary">Define default asset server directory path</div>
        <pre class="prettyprint linenums lang-php">
        <?= prettify('define(\'ASSETS\', DIR . \'assets\' . DIRECTORY_SEPARATOR);')?>
        <?= prettify('//Result: ' . ASSETS)?>
        </pre>
        
        <h3>IMAGES definition</h3>
        <div class="summary">Define default images server directory path</div>
        <pre class="prettyprint linenums lang-php">
        <?= prettify('define(\'IMAGES\', DIR . \'images\' . DIRECTORY_SEPARATOR);')?>
        <?= prettify('//Result: ' . IMAGES)?>
        </pre>
        
        <h3>IMAGES CLIENTS definition</h3>
        <div class="summary">Define default client images server directory path. %s replace with client sub domain</div>
        <pre class="prettyprint linenums lang-php">
        <?= prettify('define(\'IMAGES_CLIENTS\', IMAGES . \'users\' . DIRECTORY_SEPARATOR . \'%s\' . DIRECTORY_SEPARATOR);')?>
        <?= prettify('echo sprintf(IMAGES_CLIENTS, \sub_url()) );')?>
        <?= prettify('//Result: ' . (sprintf(IMAGES_CLIENTS, \sub_url()) ))?>
        </pre>
        
        
        <h3>STORAGE definition</h3>
        <div class="summary">Define default storage server directory path. This directory is used to store client files and documents</div>
        <pre class="prettyprint linenums lang-php">
        <?= prettify('define(\'STORAGE\', DIR . \'..\' . DIRECTORY_SEPARATOR . \'storage\' . DIRECTORY_SEPARATOR);')?>
        <?= prettify('//Result: ' . STORAGE)?>
        </pre>
        
        
        <h3>CORE</h3>
        <div class="summary">In this file, core is initialed. You can access to core with GLOBAL function</div>
        <pre class="prettyprint linenums lang-php">
        <?= prettify('global $core;')?>
        </pre>
    </div>
</div>
