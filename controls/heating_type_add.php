<?php
/**
 * Created by PhpStorm.
 * User: Justas
 * Date: 5/13/2018
 * Time: 7:11 PM
 */
require_once('model/heatingType.php');

$model = new HeatingType();

if(!empty($_POST))
{
    $model->insertNewHeatingType($_POST);
    setSession('success', 'Šildymo tipas sėkmingai sukurtas');
    redirect('realty', 'list');
}

include 'templates/heating_type_form.tpl.php';