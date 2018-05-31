<?php
/**
 * Created by PhpStorm.
 * User: Justas
 * Date: 5/12/2018
 * Time: 5:59 PM
 */

require_once('model/user.php');

$userModel = new User();

$elementCount = $userModel->getTotalCount();

include 'utils/paging.class.php';

$paging = new paging(config::NUMBER_OF_ROWS_IN_PAGE);

$paging->process($elementCount, $pageId);

$data['userData'] = $userModel->getUsersList($paging->size, $paging->first, $_GET);
$data['cities'] = $userModel->getDistinctCities();
$data['userTypes'] = $userModel->getUserTypes();

include 'templates/user_list.tpl.php';