<div class="clr docpage">
    <h1>Helper::Doctrine <a href="<?=site_url('documentation/helper')?>">Helper</a></h1>
    <div class="leftside">
        <?=$navigation?>
    </div>
    <div class="rightside">
        
        <h3>Dump doctrine result</h3>
        
        <pre class="prettyprint linenums lang-php">
        <?= prettify('\doctrine_dump($result);')?>
        </pre>
        
        
        <h3>Execute SQL Update - Insert - Delete</h3>
        
        <div class="summary">This not return any data</div>
        <pre class="prettyprint linenums lang-php">
        <?= prettify('\doctrine_sql($sql, $params = array());')?>
        </pre>
        
        
        <h3>Execute SQL Select</h3>
        
        <div class="summary">This return a result</div>
        <pre class="prettyprint linenums lang-php">
        <?= prettify('\doctrine_sql_select($sql, $params = array());')?>
        </pre>
        
        
        <h3>Generate Hash string</h3>
        
        <div class="summary">This return a string</div>
        <pre class="prettyprint linenums lang-php">
        <?= prettify('$hash = \generate_hash();')?>
        </pre>
    </div>
</div>