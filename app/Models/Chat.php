<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $fillable = ['user_id', 'party_id', 'msg'];
    public function party()
    {
        return $this->belongsTo( Party::class);
    }
    public function user()
    {
        return $this->belongsTo( User::class);
    }

    use HasFactory;
}
