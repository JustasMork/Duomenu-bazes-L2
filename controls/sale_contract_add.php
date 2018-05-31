<?php
/**
 * Created by PhpStorm.
 * User: Justas
 * Date: 5/15/2018
 * Time: 7:24 PM
 */
require_once 'model/saleContract.php';
require_once 'model/user.php';
require_once 'model/realty.php';

$contractModel = new SaleContract();
$userModel = new User();
$realtyModel = new Realty();

if(!empty($_POST))
{
    $contractModel->insertNewContract($_POST);
    setSession('success', 'Sutartis sėkmingai sukurta');
    redirect('sale_contract', 'list');
}

$data['formHeader'] = 'Nauja pirkimo-pardavimo sutartis';
$data['sellers'] = $userModel->getUsersByType(User::SELLER);
$data['clients'] = $userModel->getUsersByType(User::CLIENT);
$data['contractStatuses'] = $contractModel->getStatuses();
$datetime = new DateTime();
$data['currentDate'] = $datetime->format('Y-m-d');
$data['realty'] = $realtyModel->getRealtyData();

include 'templates/sale_contract_form.tpl.php';
