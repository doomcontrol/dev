<div class="clr docpage">
    <h1>Helper::User <a href="<?=site_url('documentation/helper')?>">Helper</a></h1>
    <div class="leftside">
        <?=$navigation?>
    </div>
    <div class="rightside">
        
        <h3>User Modules</h3>
        <div class="summary">This function return user modules in object for current session user</div>
        <pre class="prettyprint linenums lang-php">
        <?= prettify('$userModules = user_modules();');?>
        <?= prettify('//Result: ' . print_r(user_modules(), true))?>
        </pre>
        
        
        
        <h3>User Definition</h3>
        <div class="summary">This function requires two arguments. Last argument is optional. First argument is user object from doctrine. Last arguments is true or false. true if you want to return whole object. false if return only ID of group definition</div>
        <pre class="prettyprint linenums lang-php">
        <?= prettify('user_obj_definition($user,false);');?>
        <?= prettify('//Reult: 1');?>
        </pre>
        
        
        <h3>User Privileges</h3>
        <div class="summary">This function return object</div>
        <pre class="prettyprint linenums lang-php">
        <?= prettify('user_privileges();');?>
        <?= prettify('//Result: ' . print_r(user_privileges(),true))?>
        </pre>
        
        
        <h3>If user have module assigned to userL</h3>
        <div class="summary">This function requires two arguments. First is module name or module id. If is module id, second argument must be true. Default is false. Result is boolean</div>
        <pre class="prettyprint linenums lang-php">
        <?= prettify('is_user_have_module("People",false);');?>
        </pre>
        
    </div>
</div>