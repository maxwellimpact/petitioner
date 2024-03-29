<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Petition;
use App\User;

class PetitionTest extends TestCase
{
    
    use DatabaseMigrations;
    
    public function testUserCanSeeTheirPetitions()
    {
        $user = factory(User::class)->create();
        $petitions = factory(Petition::class, 4)->make();
        
        $user->petitions()->saveMany($petitions);
        
        $this->actingAs($user)
             ->visit('/petitions');
        
        $user->petitions->each(function($petition){
            $this->see($petition->title);
        });
    }
    
    public function testUserCanClickToPetitionsFromMainMenu()
    {
        $user = factory(User::class)->create();
        
        $this->actingAs($user)
             ->visit('/')
             ->click('Petitions')
             ->seePageIs('/petitions');
    }
    
    // public function testVisitorCantSeeUserLinksInMainMenu()
    // {    
    //     $this->visit('/')
    //          ->dontSee('Petitions')
    //          ->dontSee('Home');
    // }
    
    public function testUserCanCreatePetitionByPost()
    {
        $user = factory(User::class)->create();
        $petition = factory(Petition::class)->make();
        
        $this->actingAs($user)
             ->post('/petitions', $petition->toArray());
             
        $this->seeInDatabase('petitions', [
            'user_id' => $user->id,
            'title' => $petition->title
        ]);
    }
    
    public function testUserCanCreatePetitionByForm()
    {
        $user = factory(User::class)->create();
        $petition = factory(Petition::class)->make();
        
        $this->actingAs($user)
             ->visit('/petitions/create')
             ->type($petition->title, 'title')
             ->type($petition->summary, 'summary')
             ->type($petition->body, 'body')
             ->check('published')
             ->type($petition->thanks_message, 'thanks_message')
             ->type($petition->thanks_email_subject, 'thanks_email_subject')
             ->type($petition->thanks_email_body, 'thanks_email_body')
             ->press('Create');
             
        $this->seeInDatabase('petitions', [
            'user_id' => $user->id,
            'title' => $petition->title
        ]);
    }
    
    public function testVisitorCanSeePublishedPetition()
    {
        $user = factory(User::class)->create();
        $petition = factory(Petition::class)->make([
            'published' => true
        ]);
        $user->petitions()->save($petition);
        
        $this->get('/petitions/'.$petition->id)
             ->assertResponseStatus(200)
             ->see($petition->title);
    }

    public function testVisitorCantSeeUnpublishedPetition()
    {
        $user = factory(User::class)->create();
        $petition = factory(Petition::class)->make([
            'published' => false
        ]);
        $user->petitions()->save($petition);
        
        $this->get('/petitions/'.$petition->id)
             ->assertResponseStatus(404);
    }
    
    public function testVisitorCanSeeOnlyPublishedPetitionsOnHomepage()
    {
        $user = factory(User::class)->create();
        $petitions = factory(Petition::class, 2)->make([
            'published' => true
        ]);
        $user->petitions()->saveMany($petitions);
        
        $this->get('/');
        
        $petitions->each(function($petition){
            $this->see($petition->title);
        });
    }

    public function testUserOwnerCanSeeUnpublishedPetition()
    {
        $user = factory(User::class)->create();
        $petition = factory(Petition::class)->make([
            'published' => false
        ]);
        $user->petitions()->save($petition);
        
        $this->actingAs($user)
             ->get('/petitions/'.$petition->id)
             ->assertResponseStatus(200)
             ->see($petition->title);
    }
    
    public function testUserOwnerCanEditPetition()
    {
        $user = factory(User::class)->create();
        $petition = factory(Petition::class)->make();
        $user->petitions()->save($petition);
        
        $petition->title += ' changed';
        
        $this->actingAs($user)
             ->visit('/petitions/'.$petition->id.'/edit')
             ->type($petition->title, 'title')
             ->press('Update')
             ->assertResponseOk();
             
        $found = Petition::find($petition->id);
        
        $this->assertTrue($petition->title == $found->title);
        
    }
    
    public function testPetitionRecentPublishedScope()
    {
        $user = factory(User::class)->create();
        $petitions_false = factory(Petition::class, 2)->make(['published'=>false]);
        $petitions_true = factory(Petition::class, 2)->make(['published'=>true]);
        
        $user->petitions()->saveMany($petitions_false);
        $user->petitions()->saveMany($petitions_true);
        
        $published = $user->petitions()->recentPublished()->get();
        
        $this->assertTrue($published->count() == $petitions_true->count());
        
        $petitions_true->each(function($petition, $key) use ($published) {
            $this->assertTrue($petition->id == $published[$key]->id);
        });
    }
    
    public function testUserCanDeleteOwnPetition()
    {
        $user = factory(User::class)->create();
        $petition = factory(Petition::class)->make();
        $user->petitions()->save($petition);
        
        $this->actingAs($user)
             ->visit('/petitions')
             ->press('Delete')
             ->assertResponseOk();
             
        $found = Petition::find($petition->id);
        
        $this->assertTrue(!$found);
    }

}
