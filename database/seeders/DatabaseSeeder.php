<?php

namespace Database\Seeders;

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
        \Database\Factories\CanvasViewFactory::new()->count(850)->create();
        \Database\Factories\CanvasVisitFactory::new()->count(500)->create();

        // $this->call([
        //     AdminSeeder::class,
            // PostSeeder::class,
            // CommentSeeder::class,
        // ]);
    }
}
