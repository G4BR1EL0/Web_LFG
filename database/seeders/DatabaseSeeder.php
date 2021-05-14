<?php

namespace Database\Seeders;

use App\Models\Party;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(1000)->create();
        \App\Models\Game::factory(1000)->create();
        \App\Models\Party::factory(1000)->create();
        \App\Models\PartyUser::factory(1000)->create();

    }
}
