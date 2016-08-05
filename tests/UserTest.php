<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

//use Auth;
use App\User;

class UserTest extends TestCase
{
    
    use DatabaseMigrations;
    
    public function testUserCanRegister()
    {
        $user = factory(User::class)->make();
        
        $this->visit('/register')
             ->type($user->name, 'name')
             ->type($user->email, 'email')
             ->type($user->password, 'password')
             ->type($user->password, 'password_confirmation')
             ->press('Register');
             
        $this->seeInDatabase('users', ['email' => $user->email]);
    }
    
    public function testUserCanLoginAndRedirects()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt('123456')
        ]);
        
        $response = $this->visit('/login')
             ->type($user->email, 'email')
             ->type('123456', 'password')
             ->press('Login')
             ->seePageIs('/');
        
        $this->assertTrue(Auth::user()->email == $user->email);
    }
    
    public function testUserCantLogin()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt('_123456')
        ]);
        
        $response = $this->visit('/login')
             ->type($user->email, 'email')
             ->type('123456', 'password')
             ->press('Login')
             ->seePageIs('/login');
    }


}
