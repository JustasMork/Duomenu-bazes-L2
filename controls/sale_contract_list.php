<?php
/**
 * Created by PhpStorm.
 * User: Justas
 * Date: 5/15/2018
 * Time: 6:17 PM
 */
require_once 'model/saleContract.php';

$model = new SaleContract();

$elementCount = $model->getTotalSaleContracts();

include 'utils/paging.class.php';
$paging = new paging(config::NUMBER_OF_ROWS_IN_PAGE);

$paging->process($elementCount, $pageId);

$data = $model->getSaleContracts($paging->size, $paging->first);

include 'templates/sale_contract_list.tpl.php';
?>