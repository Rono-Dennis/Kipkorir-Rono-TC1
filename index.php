<?php
	session_unset();
	require_once  'controller/addressbookController.php';		
    $controller = new addressbookController();	 
    $controller->mvcHandler();
?>