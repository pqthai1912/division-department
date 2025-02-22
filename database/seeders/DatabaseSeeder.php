<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('user')->insert([
        //     'email' => 'admin@test.com',
        //     'password' => Hash::make('123456'),
        //     'name' => 'Admin',
        //     'division_id' => '1',
        //     'entered_date' => date('Y_m_d'),
        //     'position_id' => '0', // 0: General Director, 1: Group Leader, 2: Leader, 3: Member
        //     'created_date' => date('Y_m_d'),
        //     'updated_date' => date('Y_m_d'),
        // ]);
        // DB::table('user')->insert([
        //     'email' => 'generaldirector@test.com',
        //     'password' => Hash::make('123456'),
        //     'name' => 'General Director',
        //     'division_id' => '1',
        //     'entered_date' => date('Y_m_d'),
        //     'position_id' => '0',
        //     'created_date' => date('Y_m_d'),
        //     'updated_date' => date('Y_m_d'),
        // ]);
        // DB::table('user')->insert([
        //     'email' => 'groupleader@test.com',
        //     'password' => Hash::make('123456'),
        //     'name' => 'Group Leader',
        //     'division_id' => '1',
        //     'entered_date' => date('Y_m_d'),
        //     'position_id' => '1',
        //     'created_date' => date('Y_m_d'),
        //     'updated_date' => date('Y_m_d'),
        // ]);
        // DB::table('user')->insert([
        //     'email' => 'leader@test.com',
        //     'password' => Hash::make('123456'),
        //     'name' => 'Leader',
        //     'division_id' => '1',
        //     'entered_date' => date('Y_m_d'),
        //     'position_id' => '2',
        //     'created_date' => date('Y_m_d'),
        //     'updated_date' => date('Y_m_d'),
        // ]);
        // DB::table('user')->insert([
        //     'email' => 'member@test.com',
        //     'password' => Hash::make('123456'),
        //     'name' => 'Member',
        //     'division_id' => '1',
        //     'entered_date' => date('Y_m_d'),
        //     'position_id' => '3',
        //     'created_date' => date('Y_m_d'),
        //     'updated_date' => date('Y_m_d'),
        // ]);
        \App\Models\User::factory(20)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
