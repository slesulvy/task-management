<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Telegram;

class BotController extends Controller
{

    public function index()
    {

    }

    public function updatedActivity()
     {
         $activity = Telegram::getUpdates();
         dd($activity);
     }

     function sentMessageToTelegram() {
             Telegram::sendMessage([
            'chat_id' => '-393170007',
            'text' => 'Dynamic message'
        ]);
     }


    // Route::post('bot/sendmessage', function() {
    //     Telegram::sendMessage([
    //         'chat_id' => 'RECIPIENT_CHAT_ID',
    //         'text' => 'Hello world!'
    //     ]);
    //     return;
    // });

}
