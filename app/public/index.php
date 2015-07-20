<?php
use KCMS\Config;
use KCMS\Models\User;

require __DIR__ . "/../../bootstrap.php";

echo Config::DB_USER . "<br>";

$list = array();
$list[] = new User("UserA");
$list[] = new User("UserB");

/** @var User $myUser */
foreach ($list as $myUser) {
    echo $myUser->getName() . "<br>";
}
