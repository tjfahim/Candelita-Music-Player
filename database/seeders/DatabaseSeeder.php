<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        DB::table('settings')->insert([
            'radio' => 'Radio',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    
       
            DB::table('users')->insert([
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'email_verified_at' => now(),
                'password' => Hash::make('admin@admin.com'), // You may want to hash the password
                'role' => 'admin', // or any default role you want
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        
    }
}
