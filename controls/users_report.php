<?php
require_once('model/user.php');

$userModel = new User();

$elementCount = $userModel->getTotalCount();

$filters = [
  'sutarciu_verte_min' => $_GET['sutarciu_verte_min'],
    'sutarciu_verte_max' => $_GET['sutarciu_verte_max'],
];

$data['userData'] = $userModel->getUsersReport($filters);
$data['cities'] = $userModel->getDistinctCities();
$data['userTypes'] = $userModel->getUserTypes();

include 'templates/users_report.tpl.php';