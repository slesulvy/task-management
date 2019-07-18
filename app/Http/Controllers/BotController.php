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
        $this->sentMessageToTelegram($user . ' moved ' . $taskName . ' from' . $from . ' to ' . $to);
     }

     function createTask(Request $request) {
      $this->sentMessageToTelegram($request->user . ' created a task ' . $request->taskName . ' to ' . $request->projectName);
     }

     function achiveTask(Request $request) {
      $this->sentMessageToTelegram($request->user . ' achived a task ' . $request->taskname . ' of ' . $request->projectName);
     }

     function setPriorityTask(Request $request) {
      $this->sentMessageToTelegram($request->user . ' seted priority to ' . $request->taskname . ' as ' . $request->priority.' in '.$request->projectName);
     }

     function taskComment(Request $request) {
      $this->sentMessageToTelegram($request->user . ' commented to ' . $request->taskname . '(' . $request->comment . ' ) on '.$request->projectName);
     }


     function updateDescriptionTask(Request $request) {
        $this->sentMessageToTelegram($request->user . ' set description to ' . $request->taskName . ' of ' . $request->projectName);
     }

     function addAttectToTask($user, $taskName) {
        $this->sentMessageToTelegram($user . ' Added attectment to ' . $taskName . ' in ' . $request->projectName);
     }

     function addMemberToTask(Request $request) {
        $this->sentMessageToTelegram($request->addby . ' Added ' . $request->added . ' To ' . $request->taskname . ' in ' . $request->projectName);
     }

     function setDueDate(Request $request) {
      $this->sentMessageToTelegram($request->user . ' Just set due date of ' . $request->taskname . ' To ' . $request->duedate . ' in ' . $request->projectName);
     }


    // Route::post('bot/sendmessage', function() {
    //     Telegram::sendMessage([
    //         'chat_id' => 'RECIPIENT_CHAT_ID',
    //         'text' => 'Hello world!'
    //     ]);
    //     return;
    // });

}
