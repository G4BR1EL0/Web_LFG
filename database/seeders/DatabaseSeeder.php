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
        \App\Models\User::factory(10)->create();
        \App\Models\Game::factory(10)->create();
        //\App\Models\Party::factory(10)->create();
        //\App\Models\PartyUser::factory(10)->create();

    }
}
