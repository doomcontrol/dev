<div class="clr docpage">
    <h1>Basic::ROUTE <a href="<?=site_url('documentation/basic')?>">Basic</a></h1>
    <div class="leftside">
        <?=$navigation?>
    </div>
    <div class="rightside">
        <h3>Override Route</h3>
        <div class="summary">Application works only if you set route to controller.
            <p>
                First uri argument is controller. If there is no route for some controller, default function will be <strong>indexAction</strong>
            </p>
        </div>
        
        <pre class="prettyprint linenums lang-php">
        <?= prettify('$route[\'my_dashboard/([.A-Za-z0-9_-]+)/([.A-Za-z0-9_-]+)\'] = \'dashboard/mysetup/$1/$2\';')?>
        <?= prettify('$route[\'signout\'] = \'logout\';')?>
        </pre>
  
        
    </div>
</div>