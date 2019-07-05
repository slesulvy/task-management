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

     function sentMessageToTelegram($message) {
         try {
            Telegram::sendMessage([
                'chat_id' => env('TELEGRAM_CHAT_ID', 'CHAT_ID'),
                'text' => $message
            ]);
         } catch (\Throwable $th) {
            dd('sentMessageToTelegram error' . $th);
         }
             
     }

     function moveTask($user, $taskName, $from, $to) {
        $this->sentMessageToTelegram($user . ' Move' . $taskName . ' from' . $from . ' To ' . $to);
     }

     function updateDescriptionTask(Request $request) {
        $this->sentMessageToTelegram($request->user . ' Added description to ' . $request->taskName);
     }

     function addAttectToTask($user, $taskName) {
        $this->sentMessageToTelegram($user . 'Added attectment to ' . $taskName);
     }

     function addMemberToTask($assignBy, $taskName, $assignTo) {
        $this->sentMessageToTelegram($assignBy . 'added ' . $assignTo . ' To ' . $taskName);
     }


    // Route::post('bot/sendmessage', function() {
    //     Telegram::sendMessage([
    //         'chat_id' => 'RECIPIENT_CHAT_ID',
    //         'text' => 'Hello world!'
    //     ]);
    //     return;
    // });

}
