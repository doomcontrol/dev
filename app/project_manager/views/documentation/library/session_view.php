<div class="clr docpage">
    <h1>Library::Session <a href="<?=site_url('documentation/library')?>">Library</a></h1>
    <div class="leftside">
        <?=$navigation?>
    </div>
    <div class="rightside">
        <h3>Session</h3>
        
        <div class="summary">Session is already included in core;</div>
        <pre class="prettyprint linenums lang-php">
        <?= prettify('global $session;')?>
        <?= prettify('//Accessing')?>
        <?= prettify('$session->...')?>
        </pre>
        
        <h3>Set Session</h3>
        
        <div class="summary">Set Session requires three arguments. Session name, Session value, expired value
            <p>
                Session name is what you want to call this session<br />
                Session value can be array, object or string<br />
                Session expired value is expired time in minutes
            </p>
        </div>
        <pre class="prettyprint linenums lang-php">
        <?= prettify('global $session;')?>
        <?= prettify('$session->set_session("userId",1,30)')?>
        <?= prettify('// or with application default time which is 60 minutes')?>
        <?= prettify('$session->set_session("userId",1)')?>
        </pre>
        
        
        <h3>Get Session</h3>
        
        <div class="summary">Get Session requires one arguments. Session name.
        </div>
        <pre class="prettyprint linenums lang-php">
        <?= prettify('global $session;')?>
        <?= prettify('$userId = $session->get_session("userId")')?>
        </pre>
        
        
        <h3>Delete Session</h3>
        
        <div class="summary">Delete Session requires one arguments. Session name.
        </div>
        <pre class="prettyprint linenums lang-php">
        <?= prettify('global $session;')?>
        <?= prettify('$userId = $session->delete_session("userId")')?>
        </pre>
        
        <h3>Delete All Session</h3>
        
        <div class="summary">Delete All Session non required arguments.
        </div>
        <pre class="prettyprint linenums lang-php">
        <?= prettify('global $session;')?>
        <?= prettify('$userId = $session->delete_session_all()')?>
        </pre>
    </div>
</div>