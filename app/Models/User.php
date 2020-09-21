<?php

namespace App\Models;

use App\Events\Users\EmailMutated;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * --------------------------------------------------------------------------------
     * Relations.
     */
    public function emailMutations()
    {
        return $this->hasMany(UserEmailMutation::class, 'user_id', 'id');
    }

    /**
     * --------------------------------------------------------------------------------
     * Accessors and Mutators.
     */
    public function setEmailAttribute($value)
    {
        $prev = $this->attributes['email'] ?? null;
        $this->attributes['email'] = $value;

        if (isset($prev, $value) && $prev !== $value) {
            event(new EmailMutated($this, $prev, $value));
        }
    }

    /**
     * --------------------------------------------------------------------------------
     */
}
