<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected function casts() : array
    {
        return [
            'expired_at' => 'datetime'
        ];
    }

    /** Table Relations */

    public function user()
    {
        $this->belongsTo(User::class);
    }

    public function service()
    {
        $this->belongsTo(Service::class);
    }
}
