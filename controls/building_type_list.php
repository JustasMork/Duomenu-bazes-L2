<?php
/**
 * Created by PhpStorm.
 * User: Justas
 * Date: 5/15/2018
 * Time: 9:47 PM
 */
require_once 'model/buildingType.php';

$model = new BuildingType();

include 'utils/paging.class.php';
$paging = new paging(config::NUMBER_OF_ROWS_IN_PAGE);
$paging->process($model->getTotal(), $pageId);

$data = $model->getBuildingTypes($paging->size, $paging->first);

include 'templates/building_type_list.tpl.php';