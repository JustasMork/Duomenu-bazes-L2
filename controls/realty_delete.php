<?php
/**
 * Created by PhpStorm.
 * User: Justas
 * Date: 5/12/2018
 * Time: 2:06 PM
 */

require_once('model/realty.php');

if(isset($_GET['id']) && is_numeric($_GET['id'])){
    $model = new Realty();
    $model->deleteRealtyData($_GET['id']);

    setSession('success', 'Nekilnojamas turtas ištrintas');
    redirect('realty', 'list');

} else {
    setSession('error', 'Nurodytas blogas nekilnojamo turto ID');
    redirect('realty', 'list');
}
