<div class="clr docpage">
    <h1>Library::Load <a href="<?=site_url('documentation/library')?>">Library</a></h1>
    <div class="leftside">
        <?=$navigation?>
    </div>
    <div class="rightside">
        <h3>Load View</h3>
        <div class="summary">Load view will load file with HTML structural code. You can tell did you want to return like string or will or will be printed on screen with echo.
            <p>You can also pass arguments to view. Global <strong>$core,$session</strong> is automatically included.</p>
        </div>
        <pre class="prettyprint linenums lang-php">
        <?= prettify('// This will be returned as a string')?>
        <?= prettify('global $core;')?>
        <?= prettify('$data = array();')?>
        <?= prettify('$data["title"] = "My Title";')?>
        <?= prettify('')?>
        <?= prettify('$strOutput = $core->load->view("sample_dir_in_views_folder/name_of_view", $data, true);')?>
        <?= prettify('')?>
        <?= prettify('// In view you can acess passed arguments like this')?>
        <?= prettify('<h1><?php echo $title ?></h1>')?>
        <?= prettify('// In views folder you put your view`s. View file must be name of file with _view string at the and')?>
        <?= prettify('// index_view.php')?>
        <?= prettify('// If is in directory sample accesing is sample/index')?>
        <?= prettify('$strOutput = $core->load->view("sample/index", $data, true);')?>
        </pre>
        <div class="summary">Print on screen instantly</div>
        <pre class="prettyprint linenums lang-php">
        <?= prettify('$core->load->view("sample/index", $data, false);')?>
        <?= prettify('$core->load->view("sample/index", $data);')?>
        </pre>
        
        
        <h3>Load Helper</h3>
        <div class="summary">Helpers is always in helpers folder. Some helpers already included
            <p>You can call single helper or multiple helpers</p>
        </div>
        <pre class="prettyprint linenums lang-php">
        <?= prettify('//Single sample')?>
        <?= prettify('$core->load->helper("String")')?>
        <?= prettify('//Multiple sample')?>
        <?= prettify('$core->load->helper(array("String","Form"))')?>
        <?= prettify('// Helper file must have _helper at the end of name')?>
        <?= prettify('// string_helper.php')?>
        </pre>
        
        
        <h3>Load Library</h3>
        <div class="summary">Library files is always in lib folder</div>
        <pre class="prettyprint linenums lang-php">
        <?= prettify('global $core;')?>
        <?= prettify('$core->load->library("Upload")')?>
        <?= prettify('//Accessing')?>
        <?= prettify('$core->library->upload->...some function')?>
        </pre>
    </div>
</div>