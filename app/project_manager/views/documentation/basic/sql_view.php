<div class="clr docpage">
    <h1>Basic::SQL <a href="<?=site_url('documentation/basic')?>">Basic</a></h1>
    <div class="leftside">
        <?=$navigation?>
    </div>
    <div class="rightside">
        <h3>SQL Queries</h3>
        <div class="summary">This is used for auto update database records
            <p>
                First key is table name, second is application version from main version table
            </p>
        </div>
        
        <pre class="prettyprint linenums lang-php">
        <?= prettify('$sql[\'user_group_definition\'][1][] = "INSERT INTO `projectcontrol_$sub`.`user_group_definition` (`name`,`status`,`icon`) VALUES (\'Visitor_Member\',1,\'main/group/5.jpg\')";')?>
        </pre>
  
        
    </div>
</div>