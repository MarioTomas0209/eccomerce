<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Container\Attributes\Storage;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@test.com',
            'password' => bcrypt('12344321')
        ]);

        File::deleteDirectory(storage_path('app/public/products'));
        File::makeDirectory(storage_path('app/public/products'), 0755, true);

        $this->call([
            FamilySeeder::class
        ]);

        Product::factory(150)->create();

    }
}
