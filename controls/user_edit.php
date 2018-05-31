<?php
/**
 * Created by PhpStorm.
 * User: Justas
 * Date: 5/13/2018
 * Time: 4:22 PM
 */
require_once('model/user.php');

$userModel = new User();

if(!isset($_GET['id']) || !is_numeric($_GET['id']))
{
    setSession('error', 'Nurodytas blogas vartotojo ID');
    redirect('user', 'list');
}

if(!empty($_POST))
{
    $userModel->updateUser($_GET['id'], $_POST);
    setSession('success', 'Vartotojas sėkmingai pakeistas');
    redirect('user', 'list');
}
$data = $userModel->getUser($_GET['id']);
$data['formHeader'] = 'Redaguoti vartotoją';
$data['userTypes'] = $userModel->getUserTypes();
$data['addressTypes'] = $userModel->getAddressTypes();

include 'templates/user_form.tpl.php';