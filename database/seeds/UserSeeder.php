<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
        	"name" => "admin",
        	"lastname" => "admin",
        	"password" => \Hash::make("password"),
        	"email" => "admin@admin.com",
        	"role_id" => 1
        ]);
    }
}
