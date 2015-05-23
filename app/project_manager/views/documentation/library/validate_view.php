<div class="clr docpage">
    <h1>Library::Validate <a href="<?=site_url('documentation/library')?>">Library</a></h1>
    <div class="leftside">
        <?=$navigation?>
    </div>
    <div class="rightside">
        
        <h3>Validate Name</h3>
        
        <div class="summary">Only letters and white space allowed.</div>
        <pre class="prettyprint linenums lang-php">
        <?= prettify('global $core;')?>
        <?= prettify('if( !$message =  $core->validate->validateName("Thomas") ) { /* do stuff */ } else { echo $message; }')?>
        </pre>
        
        <h3>Validate Email</h3>
        
        <pre class="prettyprint linenums lang-php">
        <?= prettify('global $core;')?>
        <?= prettify('if( !$message =  $core->validate->validateMail("thomas@gml.com") ) { /* do stuff */ } else { echo $message; }')?>
        </pre>
        
        <h3>Validate URL</h3>
        
        <pre class="prettyprint linenums lang-php">
        <?= prettify('global $core;')?>
        <?= prettify('if( !$message =  $core->validate->validateUrl("http://www.google.com") ) { /* do stuff */ } else { echo $message; }')?>
        </pre>
        
        <h3>Validate integer</h3>
        
        <pre class="prettyprint linenums lang-php">
        <?= prettify('global $core;')?>
        <?= prettify('if( !$message =  $core->validate->validateInt("12345") ) { /* do stuff */ } else { echo $message; }')?>
        </pre>
        
        
        <h3>Validate Date</h3>
        
        <pre class="prettyprint linenums lang-php">
        <?= prettify('global $core;')?>
        <?= prettify('if( !$message =  $core->validate->validateDate("2014-01-01") ) { /* do stuff */ } else { echo $message; }')?>
        </pre>
        
        
        <h3>Validate Date and time</h3>
        
        <pre class="prettyprint linenums lang-php">
        <?= prettify('global $core;')?>
        <?= prettify('if( !$message =  $core->validate->validateDateTime("2014-01-01 08:00:00") ) { /* do stuff */ } else { echo $message; }')?>
        </pre>
        
        <h3>Validate String</h3>
        
        <pre class="prettyprint linenums lang-php">
        <?= prettify('global $core;')?>
        <?= prettify('if( !$message =  $core->validate->validateString("This is string") ) { /* do stuff */ } else { echo $message; }')?>
        </pre>
    </div>
</div>