<div class="clr docpage">
    <h1>Helper::URL <a href="<?=site_url('documentation/helper')?>">Helper</a></h1>
    <div class="leftside">
        <?=$navigation?>
    </div>
    <div class="rightside">
        
        <h3>Get Site URL</h3>
        <div class="summary">This function requires one optional arguments. Relative path, joined to generate URL link</div>
        <pre class="prettyprint linenums lang-php">
        <?= prettify('// Get site url')?>
        <?= prettify('echo site_url();');?>
        <?= prettify('//Result: http://domain.com/')?>
        <?= prettify('');?>
        <?= prettify('// Joinder relative path');?>
        <?= prettify('echo site_url("news");')?>
        <?= prettify('//Result: http://domain.com/news/')?>
        </pre>
        
        
        
        <h3>Redirect</h3>
        <div class="summary">This function will redirect page to another.</div>
        <pre class="prettyprint linenums lang-php">
        <?= prettify('redirect_url("news");');?>
        </pre>
        
        
        <h3>Assets URL</h3>
        <div class="summary">This function requires one optional arguments. This is URL to asset folder</div>
        <pre class="prettyprint linenums lang-php">
        <?= prettify('echo assets_url("images/image.jpg");');?>
        <?= prettify('//Result: http://domain.com/assets/images/image.jpg')?>
        </pre>
        
        
        <h3>Avatar URL</h3>
        <div class="summary">This function requires one arguments. This is URL to client folder</div>
        <pre class="prettyprint linenums lang-php">
        <?= prettify('echo avatar_url("dvfggf52xx12se.jpg");');?>
        <?= prettify('//Result: http://domain.com/assets/clients/hid/dvfggf52xx12se.jpg')?>
        </pre>
        
        
        <h3>URI</h3>
        <div class="summary">This function requires one optional arguments. This can used to get real uri from actual url or you can pass your url string and get uri</div>
        <pre class="prettyprint linenums lang-php">
        <?= prettify('// Real URI');?>
        <?= prettify('echo uri_url();')?>
        <?= prettify('// Result: name/thomas');?>
        <?= prettify('');?>
        <?= prettify('// Custom URL');?>
        <?= prettify('echo uri_url("http://domain.com/name/thomas");')?>
        <?= prettify('// Result: name/thomas');?>
        </pre>
        
        
        <h3>Params URL</h3>
        <div class="summary">This function requires two optional arguments. First argument is for exclude from uri list. Second argument is to enter custom url string
            <p>
                Result will be returned in array
            </p>
        </div>
        <pre class="prettyprint linenums lang-php">
        <?= prettify('// Real URI');?>
        <?= prettify('print_r( \params_url(null,"http://domain.com/my/argument"),true )')?>
        <?= prettify('// Result: ' . print_r(\params_url(null,"http://domain.com/my/argument"),true));?>
        </pre>
       
        
        <h3>SUB URL</h3>
        <div class="summary">This function return sub domain from url</div>
        <pre class="prettyprint linenums lang-php">
        <?= prettify('// Sample url: http://hid.domain.com')?>
        <?= prettify('echo sub_url();')?>
        <?= prettify('// Result: hid');?>
        </pre>
        
        
        <h3>Is Mobile</h3>
        <div class="summary">This function return boolean true if is mobile device or false is desktop device</div>
        <pre class="prettyprint linenums lang-php">
        <?= prettify('echo is_mobile();')?>
        <?= prettify('// Result: false');?>
        </pre>
    </div>
</div>