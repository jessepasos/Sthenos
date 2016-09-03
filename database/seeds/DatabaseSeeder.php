<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        DB::table('users')->insert(
            array(
            	'name'		=> 'admin',
                'email' 	=> 'admin@sthenos.com',
                'password' 	=> Hash::make('password'),
                'role'      => 'admin',
                'flag'      => '1',
            )
        );     

        DB::table('images')->insert(
            array(
                'name'      => 'test',
                'resource'  => 'xx',
                'user_id'   => '1',
                'flag'      => '1',
            )
        );
    }
}
