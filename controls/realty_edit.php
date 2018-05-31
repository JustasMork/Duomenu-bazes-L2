<?php
/**
 * Created by PhpStorm.
 * User: Justas
 * Date: 5/12/2018
 * Time: 2:06 PM
 */
require_once('model/realty.php');

$realtyModel = new Realty();

if(!isset($_GET['id']) || !is_numeric($_GET['id']))
{
    setSession('error', 'Nurodytas blogas nekilnojamo turto ID');
    redirect('realty', 'list');
}

if(!empty($_POST))
{
    $realtyModel->updateRealty($_GET['id'], $_POST);
    setSession('success', 'Nekilnojamas turtas sėkmingai pakeistas');
    redirect('realty', 'list');
}

$data['formHeader'] = 'Redaguoti nekilnojamą turtą';
$data['realtyTypes'] = $realtyModel->getRealtyTypes();
$data['buildingTypes'] = $realtyModel->getBuildingTypes();
$data['buildingState'] = $realtyModel->getBuildingStates();
$data['heatingTypes'] = $realtyModel->getHeatingTypes();
$data['realty'] = $realtyModel->getRealty($_GET['id']);
//vdd($data['realty']);


include 'templates/realty_form.tpl.php';