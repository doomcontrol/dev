<div class="clr docpage">
    <h1>Basic::CONFIG <a href="<?=site_url('documentation/basic')?>">Basic</a></h1>
    <div class="leftside">
        <?=$navigation?>
    </div>
    <div class="rightside">
        <h3>Config Directory</h3>
        <div class="summary">Config directory contains default application configuration like database configurations, routes, sql..
        </div>
        
        <h3>Constants</h3>
        <div class="summary">This is used to define application constants</div>

        <h3>Database</h3>
        <div class="summary">This is used to define database parameter's. Host, table, user...</div>
        
        <h3>Resource</h3>
        <div class="summary">This is used to define application css files and javascript filespace
            <p>CSS files have to option to setup. Default and custom. Default will load always. Custom only if key is match in url</p>
        </div>
        <pre class="prettyprint linenums lang-php">
        <?= prettify('// Default sample:')?>
        <?= prettify('$resource[\'css\'][] = "css/jquery/jquery-ui.css";')?>
        <?= prettify('')?>
        <?= prettify('// Custom sample:')?>
        <?= prettify('$resource[\'custom\'][\'css\'][\'documentation\'][] = "css/custom/documentation/style.css";')?>
        </pre>
  
        
        <p>JS files have to option to setup. Default and custom. Default will load always. Custom only if key is match in url</p>
        <pre class="prettyprint linenums lang-php">
        <?= prettify('// Default sample:')?>
        <?= prettify('$resource[\'js\'][] = "js/core/app.js";')?>
        <?= prettify('')?>
        <?= prettify('// Custom sample:')?>
        <?= prettify('$resource[\'custom\'][\'js\'][\'documentation\'][] = "js/custom/documentation/app.js";')?>
        </pre>
        
        <p>You can set js in head section of page</p>
        <pre class="prettyprint linenums lang-php">
        <?= prettify('$resource[\'jstop\'][] = "js/core/definition.js";')?>
        </pre>
        
        <p>You can exclude javascript from concat files</p>
        <pre class="prettyprint linenums lang-php">
        <?= prettify('$resource[\'exclude\'][] = "js/jquery/jquery-1.11.2.min.js";')?>
        </pre>
    </div>
</div>