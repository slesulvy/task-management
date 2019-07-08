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

     function createTask(Request $request) {
      $this->sentMessageToTelegram($request->user . ' Created ' . $request->taskName . ' task');
     }

     function achiveTask(Request $request) {
      $this->sentMessageToTelegram($request->user . ' Achived ' . $request->taskname . ' task');
     }

     function setPriorityTask(Request $request) {
      $this->sentMessageToTelegram($request->user . ' Set priority  ' . $request->taskname . ' task to ' . $request->priority);
     }

     function taskComment(Request $request) {
      $this->sentMessageToTelegram($request->user . ' Commented on ' . $request->taskname . '(' . $request->comment . ' )');
     }


     function updateDescriptionTask(Request $request) {
        $this->sentMessageToTelegram($request->user . ' Added description to ' . $request->taskName);
     }

     function addAttectToTask($user, $taskName) {
        $this->sentMessageToTelegram($user . ' Added attectment to ' . $taskName);
     }

     function addMemberToTask(Request $request) {
        $this->sentMessageToTelegram($request->addby . ' Added ' . $request->added . ' To ' . $request->taskname);
     }

     function setDueDate(Request $request) {
      $this->sentMessageToTelegram($request->user . ' Just set due date of ' . $request->taskname . ' To ' . $request->duedate);
     }


    // Route::post('bot/sendmessage', function() {
    //     Telegram::sendMessage([
    //         'chat_id' => 'RECIPIENT_CHAT_ID',
    //         'text' => 'Hello world!'
    //     ]);
    //     return;
    // });

}
