<?php

namespace Database\Seeders;

use App\Models\Books;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BooksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
      $faker=\Faker\Factory::create();
      for($i=0; $i<50; $i++){
        Books::create([
            'name'=>$faker->sentence(1),
            'author'=>$faker->name,
            'published_at'=>$faker->date('Y-m-d'),
        ]);
      }
    }
}
