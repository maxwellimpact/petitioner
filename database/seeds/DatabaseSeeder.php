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
        $users = factory(App\User::class, 4)->create([
            'password' => bcrypt('123456')
        ]);
        
        $users->each(function($user){
            echo $user->email . PHP_EOL;
            
            $petitions = factory(App\Petition::class, 25)->make();
            $user->petitions()->saveMany($petitions);
            
            $petitions->each(function($petition){
                $petition->signs()->saveMany(factory(App\Sign::class, 5)->make());
            });
            
        });
    }
}
