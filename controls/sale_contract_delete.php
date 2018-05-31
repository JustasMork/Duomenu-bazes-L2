<?php
/**
 * Created by PhpStorm.
 * User: Justas
 * Date: 5/15/2018
 * Time: 8:43 PM
 */
require_once 'model/saleContract.php';


if(isset($_GET['id']) && is_numeric($_GET['id'])){
    $model = new SaleContract();
    $model->deleteContract($_GET['id']);
    setSession('success', 'Sutartis sėkmingai ištrinta');
    redirect('sale_contract', 'list');

} else {
    setSession('error', 'Nurodytas blogas sutarties ID');
    redirect('sale_contract', 'list');
}
