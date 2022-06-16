<?php

use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;
use Illuminate\Support\Facades\Route;

DriverManager::loadDriver(\BotMan\Drivers\Telegram\TelegramDriver::class);
$config = [
'telegram' => [
	'token' => 'YOUR-TELEGRAM-TOKEN-HERE',
]
];
// Create BotMan instance
BotManFactory::create($config);

Route::match(['get', 'post'], '/', function () {
    app('botman')->listen();
});

$botman = app('botman');

$botman->hears('hello', function($bot){
    $bot->reply('Heyoo boss');
});

$botman->fallback(function($bot) {
    $bot->reply('I don\'t under this commant yet');
})

?>