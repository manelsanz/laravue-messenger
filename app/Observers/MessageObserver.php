<?php

namespace App\Observers;

use App\Message;
use App\Conversation;
use App\Events\MessageSent;

class MessageObserver
{
    /**
     * Handle the message "created" event.
     *
     * @param  \App\Message  $message
     * @return void
     */
    public function created(Message $message)
    {
        $conversation = Conversation::where('user_id', $message->from_id)->where('contact_id', $message->to_id)->firstOrFail();
        $conversation->update([
            'last_message' => "Tú: $message->content",
            'last_time' => $message->created_at
        ]);

        $conversation = Conversation::where('user_id', $message->to_id)->where('contact_id', $message->from_id)->with('contact:id,name')->firstOrFail();
        $conversation->update([
            'last_message' => "{$conversation->contact_name}: $message->content",
            'last_time' => $message->created_at
        ]);

        event(new MessageSent($message));
    }

    // /**
    //  * Handle the message "updated" event.
    //  *
    //  * @param  \App\Message  $message
    //  * @return void
    //  */
    // public function updated(Message $message)
    // {
    //     //
    // }

    // /**
    //  * Handle the message "deleted" event.
    //  *
    //  * @param  \App\Message  $message
    //  * @return void
    //  */
    // public function deleted(Message $message)
    // {
    //     //
    // }

    // /**
    //  * Handle the message "restored" event.
    //  *
    //  * @param  \App\Message  $message
    //  * @return void
    //  */
    // public function restored(Message $message)
    // {
    //     //
    // }

    // /**
    //  * Handle the message "force deleted" event.
    //  *
    //  * @param  \App\Message  $message
    //  * @return void
    //  */
    // public function forceDeleted(Message $message)
    // {
    //     //
    // }
}
