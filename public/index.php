<?php

require '../vendor/autoload.php';

use app\database\activerecord\Update;
use app\database\models\User;

$user = new User;
// $user->idTable = 'userId';
$user->firstName = 'Alexandre';
$user->lastName = 'Cardoso';

$user->execute(new Update(field:'id', value:1));
