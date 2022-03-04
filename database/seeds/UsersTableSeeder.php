<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' =>  'Usuario Prueba',
            'email' => 'seguridadweb@campusviu.es',
            'password' => Hash::make('S3gur1d4d?W3b')
        ]);

    }
}
