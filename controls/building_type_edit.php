<?php
/**
 * Created by PhpStorm.
 * User: Justas
 * Date: 5/15/2018
 * Time: 10:05 PM
 */
require_once 'model/buildingType.php';

$model = new BuildingType();
if(!isset($_GET['id']) && !is_numeric($_GET['id']))
{
    setSession('error', 'Netinkamas statinio tipo ID');
    redirect('building_type','list');
}

if(!empty($_POST))
{
    $model->update($_GET['id'], $_POST);
    setSession('success', 'Statinio tipas sėkmingai pakeistas');
    redirect('building_type', 'list');
}

$data['types'] = $model->getBuildingType($_GET['id']);

include 'templates/building_type_form.tpl.php';
