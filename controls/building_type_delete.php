<?php
/**
 * Created by PhpStorm.
 * User: Justas
 * Date: 5/15/2018
 * Time: 10:00 PM
 */
require_once 'model/buildingType.php';

$model = new BuildingType();
if(!isset($_GET['id']) && !is_numeric($_GET['id']))
{
    setSession('error', 'Netinkamas statinio tipo ID');
    redirect('building_type','list');
}
$model->delete($_GET['id']);
setSession('success', 'Statinio tipas sėkmingai ištrintas');
redirect('building_type', 'list');
