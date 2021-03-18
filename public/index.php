<?php

require '../vendor/autoload.php';

use app\database\models\User;
use app\database\activerecord\Update;

$user = new User;
// $user->idTable = 'userId';
$user->firstName = 'Alexandre';
$user->lastName = 'Cardoso';
$user->id = 1;

$user->update(new Update);
