<?php
/**
 * Created by PhpStorm.
 * User: Justas
 * Date: 4/12/2018
 * Time: 8:40 PM
 */


require_once('model/realty.php');
$realty = new realty();

$elementCount = $realty->getTotalCount();

include 'utils/paging.class.php';
$paging = new paging(config::NUMBER_OF_ROWS_IN_PAGE);

$paging->process($elementCount, $pageId);

$data = $realty->getRealtyData($paging->size, $paging->first);

include 'templates/realty_list.tpl.php';
