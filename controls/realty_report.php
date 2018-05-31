<?php
/**
 * Created by PhpStorm.
 * User: Justas
 * Date: 5/24/2018
 * Time: 2:23 PM
 */

require_once 'model/realty.php';

$realtyModel = new Realty();
$reportData = [];
$realtyTypes = $realtyModel->getBuildingTypes();

foreach ($realtyTypes as $realtyType)
{
    $reportData[$realtyType['name']] = $realtyModel->getRealtyReportByType($realtyType['id_Statinio_tipas']);
}

include 'templates/realty_report.tpl.php';
