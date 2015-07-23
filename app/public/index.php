<?php
use KCMS\Api\ApiHelper;

require __DIR__ . "/../../bootstrap.php";

$args = array_merge($_POST, $_GET);

$apiHelper = new ApiHelper();
$apiHelper->handleRequest($args);

echo $apiHelper->getJsonReponse();
