<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;
use App\Petition;
use App\Sign;

class SignTest extends TestCase
{

    use DatabaseMigrations;

    public function testVisitorCanSignPetitionByPost()
    {
        $user = factory(User::class)->create();
        $petition = factory(Petition::class)->make([
            'published' => true
        ]);
        $user->petitions()->save($petition);
        
        $sign = factory(Sign::class)->make();
        
        $this->post('/petitions/'.$petition->id.'/signs', $sign->toArray())
             ->assertResponseStatus(302);
    }

    public function testVisitorCanSignPetition()
    {
        $user = factory(User::class)->create();
        $petition = factory(Petition::class)->make([
            'published' => true
        ]);
        $user->petitions()->save($petition);
        
        $sign = factory(Sign::class)->make();
        
        $this->visit('/petitions/'.$petition->id)
             ->type($sign->name, 'name')
             ->type($sign->email, 'email')
             ->type($sign->phone, 'phone')
             ->press('Sign')
             ->assertResponseStatus(200);
    }

}
