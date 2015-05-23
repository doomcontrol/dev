<h1 id="People" data-live="false" data-callback="ReplaceHtml" data-class="People" data-funct="Search">People 
	<span class="page-search-holder">
		<input type="text" name="search" value="" class="page-search boxsizing" onkeydown="if (event.keyCode == 13) SF.Init('People', false)" />
		<a href="#"  onclick="SF.Init('People', false);return false;"><i class="icon-search boxsizing"></i></a>
	</<span>
</h1>
<?= $navigation ?>
<?= $add_user_form ?>
<div id="userList">
<?= $user_list ?>
</div>
