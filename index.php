<?php
	require_once('./core/template.php');

	if($_POST['ajax'] != '1' && $_GET['ajax'] != '1' && !isset($_GET['module'])){
		 $templateBasic = new Template();
		 $templateBasic->set('page', 'index');
		 echo $templateBasic->view();
	}
	else{
		$module = htmlspecialchars($_GET['module']);
		$templateBasic = new Template();
		$templateBasic->set('page', $module);

		$templateModule = new Template($module);
		$templateBasic->set('main', $templateModule->view());
		echo $templateBasic->view();
		//require_once('./modules/'.$module.'.php');
	}
?>
