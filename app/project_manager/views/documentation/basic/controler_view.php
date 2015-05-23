<div class="clr docpage">
    <h1>Basic::CONTROLER`S <a href="<?=site_url('documentation/basic')?>">Basic</a></h1>
    <div class="leftside">
        <?=$navigation?>
    </div>
    <div class="rightside">
        <h3>Controler</h3>
        <div class="summary">Application controller is default class which is executed.
            <p>
                Controller works with <strong>Service</strong>. Service is used to generate data
            </p>
        </div>
        
        <pre class="prettyprint linenums lang-php">
        <?= prettify('// Function name called directly with url have sufix Action')?>
        <?= prettify('public function indexAction(){ ... }')?>
        <?= prettify('')?>
        <?= prettify('// Function name called from ajax call have sufix Ajax')?>
        <?= prettify('public function EditEmailAjax($id,$value){')?>
        <?= prettify("\t".'$this->core->output->json( \controler\people\EditEmail::Service()->Store($id, $value) );')?> 
        <?= prettify('}')?>
        </pre>
  
        
    </div>
</div>