<div class="clr docpage">
    <h1>Basic::COMPONENT`S <a href="<?=site_url('documentation/basic')?>">Basic</a></h1>
    <div class="leftside">
        <?=$navigation?>
    </div>
    <div class="rightside">
        <h3>Components</h3>
        <div class="summary">Components is used when you split views or functionality an part.
        </div>
        
        <pre class="prettyprint linenums lang-php">
        <?= prettify('
            <?php namespace components\user\userbox;
            
                class Component {
                
                    static function Display( $data ){
                        global $core; global $session;
                        
                        $data[\'form_data\'][\'groups\'] = $core->em->getRepository(\'models\entities\User\UserGroupDefinition\')->getGroups();
        
                        $strView = $core->load->view(\'components/user/userbox/index\', $data, true);
        
                        return $strView;
        
                    }
            }')?>
        </pre>
        
        <p>Accessing component</p>
        <pre class="prettyprint linenums lang-php">
        <?= prettify('<?= \components\user\userbox\Component::Display($data); ?>')?>
        </pre>
  
        
    </div>
</div>