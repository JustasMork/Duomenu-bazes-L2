<?php
/**
 * Created by PhpStorm.
 * User: Justas
 * Date: 5/13/2018
 * Time: 4:15 PM
 */
require_once('model/user.php');

if(isset($_GET['id']) && is_numeric($_GET['id'])){
    $model = new User();
    $model->deleteUser($_GET['id']);

    setSession('success', 'Vartotojas sėkmingai ištrintas');
    redirect('user', 'list');

} else {
    setSession('error', 'Nurodytas blogas vartotojo ID');
    redirect('user', 'list');
}
