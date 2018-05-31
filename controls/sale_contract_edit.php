<?php
/**
 * Created by PhpStorm.
 * User: Justas
 * Date: 5/15/2018
 * Time: 8:49 PM
 */
require_once 'model/saleContract.php';
require_once 'model/user.php';
require_once 'model/realty.php';

$contractModel = new SaleContract();
$userModel = new User();
$realtyModel = new Realty();

if(!isset($_GET['id']) || !is_numeric($_GET['id']))
{
    setSession('error', 'Nurodytas blogas sutarties ID');
    redirect('sale_contract', 'list');
}

if(!empty($_POST))
{
    $contractModel->updateContract($_GET['id'], $_POST);
    setSession('success', 'Sutartis sėkmingai pakeista');
    redirect('sale_contract', 'list');
}

$data['formHeader'] = 'Redaguoti pirkimo-pardavimo sutartį';
$data['sellers'] = $userModel->getUsersByType(User::SELLER);
$data['clients'] = $userModel->getUsersByType(User::CLIENT);
$data['contractStatuses'] = $contractModel->getStatuses();
$datetime = new DateTime();
$data['currentDate'] = $datetime->format('Y-m-d');
$data['realty'] = $realtyModel->getRealtyData();
$data['contract'] = $contractModel->getSaleContract($_GET['id']);

include 'templates/sale_contract_form.tpl.php';