<?php

namespace Database\Seeders;

use App\Models\GuestBook;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GuestBookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        GuestBook::factory(10)->create();
    }
}
