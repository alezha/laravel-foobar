<?php

namespace Database\Factories\User;

use App\Models\User\EmailMutation;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EmailMutationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EmailMutation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
        ];
    }
}
