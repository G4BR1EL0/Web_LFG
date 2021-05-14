<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Party extends Model
{
    protected $table = 'parties';
    protected $fillable = ['game_id', 'name'];

    public function game()
    {
        return $this->belongsTo(Game::class);
    }
    public function partyuser()
    {
        return $this->hasMany(PartyUser::class);
    }
    public function chat()
    {
        return $this->hasMany(Chat::class);
    }
    use HasFactory;
}
