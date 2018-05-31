<?php
/**
 * Created by PhpStorm.
 * User: Justas
 * Date: 5/13/2018
 * Time: 7:12 PM
 */
require_once('model/buildingType.php');

$model = new BuildingType();

if(!empty($_POST))
{
    $model->insertNewBuildingTypes($_POST);
    setSession('success', 'Statinio tipai sėkmingai sukurti');
    redirect('building_type', 'list');
}

include 'templates/building_type_form.tpl.php';

