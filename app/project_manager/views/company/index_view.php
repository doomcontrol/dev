<h1 id="Company" data-live="false" data-callback="ReplaceHtml" data-class="Company" data-funct="Search">Company 
	<span class="page-search-holder">
		<input type="text" name="search" value="" class="page-search boxsizing" onkeydown="if (event.keyCode == 13) SF.Init('Company', false)" />
		<a href="#"  onclick="SF.Init('Company', false);return false;"><i class="icon-search boxsizing"></i></a>
	</<span>
</h1>
<?= $navigation ?>
<?= $add_company_form ?>
<div id="userList">
<?= $company_list ?>
</div>
