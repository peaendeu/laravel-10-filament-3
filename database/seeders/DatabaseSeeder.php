<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    // \App\Models\User::factory(10)->create();

    \App\Models\User::factory()->create([
      'name' => 'Admin',
      'email' => 'admin@admin.com',
      'password' => Hash::make('admin@admin.com'),
    ]);

    $this->call([
      GuestBookSeeder::class,
    ]);

    Category::create([
      'name' => 'Bensin',
      'is_expense' => 1,
      'image' => '01J3YPYA6VREGWEHJGWKFFT6XP.png'
    ]);

    Category::create([
      'name' => 'Freelance',
      'is_expense' => 0,
      'image' => '01J3YQE7ZT6P745ZHMT3CJC1M5.png'
    ]);

    Category::create([
      'name' => 'Konsumsi',
      'is_expense' => 1,
      'image' => '01J3YQDQ89GAAVYCQ167XD4SHX.png'
    ]);

    Category::create([
      'name' => 'Gaji',
      'is_expense' => 0,
      'image' => '01J40JZRK9KAGEN28Z5AKXB3S9.png'
    ]);

    Transaction::create([
      'name' => 'Gajian Bulan Agustus',
      'category_id' => 4,
      'date_transaction' => date('Y-m-d'),
      'amount' => 5000000,
      'image' => '01J40JZRK9KAGEN28Z5AKXB3S9.png'
    ]);

    Transaction::create([
      'name' => 'Konsumsi Bulan Agustus',
      'category_id' => 3,
      'date_transaction' => date('Y-m-d'),
      'amount' => 1000000,
      'image' => '01J40JZRK9KAGEN28Z5AKXB3S9.png'
    ]);

    Transaction::create([
      'name' => 'Bensin Bulan Agustus',
      'category_id' => 1,
      'date_transaction' => date('Y-m-d'),
      'amount' => 250000,
      'image' => '01J40JZRK9KAGEN28Z5AKXB3S9.png'
    ]);

    Transaction::create([
      'name' => 'Freelance Bulan Agustus',
      'category_id' => 2,
      'date_transaction' => date('Y-m-d'),
      'amount' => 5000000,
      'image' => '01J40JZRK9KAGEN28Z5AKXB3S9.png'
    ]);
  }
}
