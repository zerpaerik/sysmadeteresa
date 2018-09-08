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
        	"dni" => "123456",
        	"phone" => "5555555",
        	"email" => "admin@admin.com",
        	"role_id" => 1,
        	"address" => "web" 
        ]);
    }
}
