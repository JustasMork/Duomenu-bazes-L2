<?php
    session_start();
	// nuskaitome konfigūracijų failą
	include 'config.php';
    require_once ('libraries/helper.php');
	// iškviečiame prisijungimo prie duomenų bazės klasę
	include 'utils/mysql.class.php';
	
	// nustatome pasirinktą modulį
	$module = 'realty';
	if(isset($_GET['module'])) {
		$module = mysql::escape($_GET['module']);
	}
	
	// jeigu pasirinktas elementas (sutartis, automobilis ir kt.), nustatome elemento id
	$id = '';
	if(isset($_GET['id'])) {
		$id = mysql::escape($_GET['id']);
	}
	
	// nustatome, kokia funkcija kviečiama
	$action = 'list';
	if(isset($_GET['action'])) {
		$action = mysql::escape($_GET['action']);
	}
		
	// nustatome elementų sąrašo puslapio numerį
	$pageId = 1;
	if(!empty($_GET['page'])) {
		$pageId = mysql::escape($_GET['page']);
	}
	
	// nustatome, kurį valdiklį įtraukti šablone main.tpl.php
	$actionFile = "";
	if(!empty($module) && !empty($action)) {
		$actionFile = "controls/{$module}_{$action}.php";
	}
	
	// įtraukiame pagrindinį šabloną
	include 'templates/main.tpl.php';
?>