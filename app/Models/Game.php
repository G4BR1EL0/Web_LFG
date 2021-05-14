<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = ['id','name', 'genre'];
    public function parties()
    {
        return $this->hasMany(Party::class);
    }
    use HasFactory;
}
