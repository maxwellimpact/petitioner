<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\File;
use App\User;

class FileTest extends TestCase
{    
    use DatabaseMigrations;
    
    public function testUserSaveFile()
    {
        $user = factory(User::class)->create();
        $file = factory(File::class)->make();
        
        $user->files()->save($file);
        
        $this->seeInDatabase('files', [
            'user_id' => $user->id,
            'url' => $file->url
        ]);
    }
    
    public function testUserStoreFileByPostWithModelReturn()
    {
        $user = factory(User::class)->create();
        $file = factory(File::class)->make();
        
        $return = $this->actingAs($user)
             ->post('/files', $file->toArray());
        
        $id = $return->response->original->id;
        
        $this->seeInDatabase('files', [
            'user_id' => $user->id,
            'url' => $file->url,
            'id' => $id
        ]);
    }
    
    
}
