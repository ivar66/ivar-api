<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InitUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * php artisan db:seed --class=InitUserSeeder
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
           'nick_name'   => 'ivar',
            'phone'      => '18811414533',
            'password'   => bcrypt(12345678),
        ]);
    }
}
