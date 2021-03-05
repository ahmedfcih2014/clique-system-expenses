<?php

namespace Database\Seeders;

use App\Models\User;
use Exception;
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
        // create a manager
        try {
            User::create(['name' => 'System Manager', 'username' => 'manager', 'password' => 'manager', 'role' => 'manager']);
        } catch (Exception $e) {
            echo "System Manager created before".PHP_EOL;
        }

        // create 5 employees
        try {
            User::create(['name' => 'Ahmed', 'username' => 'ahmed', 'password' => '123456']);
        } catch (Exception $e) {
            echo "Ahmed created before".PHP_EOL;
        }

        try {
            User::create(['name' => 'Ali', 'username' => 'ali', 'password' => '123456']);
        } catch (Exception $e) {
            echo "Ali created before".PHP_EOL;
        }

        try {
            User::create(['name' => 'Saad', 'username' => 'saad', 'password' => '123456']);
        } catch (Exception $e) {
            echo "Saad created before".PHP_EOL;
        }

        try {
            User::create(['name' => 'Mohamed', 'username' => 'mohamed', 'password' => '123456']);
        } catch (Exception $e) {
            echo "Mohamed created before".PHP_EOL;
        }

        try {
            User::create(['name' => 'Hady', 'username' => 'hady', 'password' => '123456']);
        } catch (Exception $e) {
            echo "Hady created before".PHP_EOL;
        }
    }
}
