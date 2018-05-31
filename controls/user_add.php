<?php
/**
 * Created by PhpStorm.
 * User: Justas
 * Date: 5/12/2018
 * Time: 6:14 PM
 */

require_once('model/user.php');

$userModel = new User();

if(!empty($_POST))
{
    if($userModel->insertNewUser($_POST)){
        setSession('success', 'Vartotojas sėkmingai sukurtas');
        redirect('user', 'list');
    } else {
        setSession('error', 'Vartotojas su tokiu asmens kodu jau egzistuoja');
    }

}

$data['formHeader'] = 'Naujas vartotojas';
$data['userTypes'] = $userModel->getUserTypes();
$data['addressTypes'] = $userModel->getAddressTypes();


include 'templates/user_form.tpl.php';