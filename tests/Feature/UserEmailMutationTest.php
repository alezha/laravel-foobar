<?php

namespace Tests\Feature;

use App\Events\Users\EmailMutated;
use App\Jobs\Users\AlertEmailMutated;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\{ Bus, Event };
use Tests\TestCase;

class UserEmailMutationTest extends TestCase
{
    public function testAlertsDispatched()
    {
        Bus::fake();

        $user = User::factory()->create();

        /**
         * Expected:
         *  - 2 EmailMutated events dispatched,
         *  - Resulting in 2 AlertEmailMutated jobs dispatched via event listener.
         */
        $user->email = 'one@example.com';
        $user->email = 'two@example.com';

        Bus::assertDispatched(AlertEmailMutated::class, 2);
    }
}
