<?php

require '../vendor/autoload.php';

use app\database\activerecord\FindAll;
use app\database\models\User;

$user = new User;
// $user->firstName = 'Pedro';
// $user->lastName = 'Santana';

var_dump($user->execute(new FindAll(fields:'id')));
