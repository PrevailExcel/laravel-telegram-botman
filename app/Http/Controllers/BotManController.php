<?php

namespace App\Http\Controllers;

use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;
use Illuminate\Http\Request;
use BotMan\BotMan\Messages\Incoming\Answer;

class BotManController extends Controller
{
    /**
     * Place your BotMan logic here.
     */
    public function handle()
    {
        DriverManager::loadDriver(\BotMan\Drivers\Telegram\TelegramDriver::class);
        $config = [
            'telegram' => [
                'token' => '5514156526:AAFIvcY3NmbFwkoKX5RDBHu9oZe0b-kPtZQ',
            ]
        ];

        $botman = BotManFactory::create($config);
        // $botman = app('botman');

        $botman->hears('{message}', function ($botman, $message) {

            if ($message == 'hi') {
                $this->askName($botman);
            } else {
                $botman->reply("write 'hi' for testing...");
            }
        });

        $botman->listen();
    }

    /**
     * Place your BotMan logic here.
     */
    public function askName($botman)
    {
        $botman->ask('Hello! What is your Name?', function (Answer $answer) {

            $name = $answer->getText();

            $this->say('Nice to meet you ' . $name);
        });
    }
}


//


// use BotMan\BotMan\BotMan;
// use BotMan\BotMan\BotManFactory;
// use BotMan\BotMan\Drivers\DriverManager;
// use Illuminate\Support\Facades\Route;

// DriverManager::loadDriver(\BotMan\Drivers\Telegram\TelegramDriver::class);
// $config = [
// 'telegram' => [
// 	'token' => '5514156526:AAFIvcY3NmbFwkoKX5RDBHu9oZe0b-kPtZQ',
// ]
// ];

// Route::post('/', function () {
// $config = [
// 'telegram' => [
// 	'token' => '5514156526:AAFIvcY3NmbFwkoKX5RDBHu9oZe0b-kPtZQ',
// ]
// ];
// $botman = BotManFactory::create($config);

//     $botman->listen();
// });

// $botman = BotManFactory::create($config);

// $botman->hears('hello', function($bot){
//     $bot->reply('Heyoo boss');
// });

// $botman->fallback(function($bot) {
//     $bot->reply('I don\'t under this commant yet');
// })

// 
