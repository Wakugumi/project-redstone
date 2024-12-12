<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('12345678'),
            'phone' => '-',
        ]);

        $categories = [
            'Computer Programming and Networking',
            'Creative Writing',
            'Graphics and Design',
            'Virtual Assistants',
            'Music & Audio',
            'Digital Marketing',
            'Other'
        ];
        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }
    }
}
