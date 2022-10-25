<?php
/**
 * Autor Petrov Valerii vuholding@gmail.com
 * start 22:30 - 23:20
 * Start 7:10 - 10:00
 */

require 'vendor/autoload.php';

Dotenv\Dotenv::createImmutable(__DIR__)->load();

use Telegram\Bot\Api;
use App\Service\FileService;
use App\Service\PerformerService;

$apiKey = $_ENV['TELEGRAM_KEY'];

if(!$apiKey){
    die('Sorry');
}

$telegram = new Api($apiKey);

$lastMessage = FileService::getLastMessage();

$params = [
    'offset'  => $lastMessage + 1,
    'limit'   => 10,
//    'timeout' => 60,
];

$getUpdates = $telegram->getUpdates($params);

if(!$getUpdates){
    die('Not Ready');
}
PerformerService::do($getUpdates);
