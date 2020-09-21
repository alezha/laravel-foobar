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
    /**
     * Testing bug in Laravel.
     *
     * 1. https://github.com/illuminate/support/blob/master/Testing/Fakes/BusFake.php#L79
     *      -> https://github.com/sebastianbergmann/phpunit/blob/master/src/Framework/Assert.php#L1314
     *      -> https://github.com/sebastianbergmann/phpunit/blob/master/src/Framework/Constraint/IsIdentical.php#L64
     *      -> Should be is_int(), not is_numeric(), because PHPUnit::assertSame() uses "===" comparison for non-float.
     *
     * 2. https://github.com/illuminate/support/blob/master/Testing/Fakes/BusFake.php#L141
     *      - Same reasoning as (1).
     */
    public function testIsNumericBug()
    {
        Bus::fake();

        $user = User::factory()->create();

        /**
         * Expected:
         *  - 2 EmailMutated events fired,
         *  - Resulting in 2 AlertEmailMutated jobs dispatched via event listener.
         */
        $user->email = 'one@example.com';
        $user->email = 'two@example.com';

        // OK.
        Bus::assertDispatched(AlertEmailMutated::class, 2);
        // Laravel-legal but NOT OK.
        Bus::assertDispatched(AlertEmailMutated::class, '2');
    }
}
