<?php

require_once('model/realty.php');

$realtyModel = new Realty();

if(!empty($_POST))
{
    $realtyModel->insertNewRealty($_POST);
    setSession('success', 'Nekilnojamas turtas sėkmingai sukurtas');
    redirect('realty', 'list');
}

$data['formHeader'] = 'Naujas nekilnojamas turtas';
$data['realtyTypes'] = $realtyModel->getRealtyTypes();
$data['buildingTypes'] = $realtyModel->getBuildingTypes();
$data['buildingState'] = $realtyModel->getBuildingStates();
$data['heatingTypes'] = $realtyModel->getHeatingTypes();

include 'templates/realty_form.tpl.php';
