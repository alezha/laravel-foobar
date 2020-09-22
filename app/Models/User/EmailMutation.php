<?php

namespace App\Models\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailMutation extends Model
{
    use HasFactory;

    protected $table = 'user_email_mutations';

    protected $fillable = [
        'old_email', 'new_email',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
