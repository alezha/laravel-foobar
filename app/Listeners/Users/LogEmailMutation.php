<?php

namespace App\Listeners\Users;

use App\Events\Users\EmailMutated;
use App\Jobs\Users\AlertEmailMutated;
use App\Models\User\EmailMutation;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogEmailMutation
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  EmailMutated  $event
     * @return void
     */
    public function handle(EmailMutated $event)
    {
        AlertEmailMutated::dispatch($event);

        $mutation = new EmailMutation([
            'old_email' => $event->old_email,
            'new_email' => $event->new_email,
        ]);
        $mutation->user()->associate($event->user);
        $mutation->save();
    }
}
