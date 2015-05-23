<div class="form-holder">
    <div class="form-mask"></div>
    <a href="#" class="form-screen round-center" onclick="OnScreen.Open('')"><i class="icon-plus">&nbsp;</i>Add Company</a>
    
    <?= \components\onscreen\Component::Display('AddCompany',$form_data['onscreen'], $form_data['form_id']) ?>
    
</div>