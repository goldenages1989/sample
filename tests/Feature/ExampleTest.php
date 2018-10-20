<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
//    public function testBasicTest()
//    {
//        $response = $this->get('/');
//        $response->assertStatus(200);
//    }

//    public function testBasicExample()
//    {
//        $response = $this->withHeaders([
//            'X-Header' => 'Laravel Ace'
//        ])->json('POST', '/user', ['name' => 'Ace']);
//
//        $response->assertStatus(200)->assertJson(['created' => true]);
//    }

     public function testDatabase()
     {
         $this->assertDatabaseMissing('users',[
             'email' => 'xiaogang19891001@gmail.co'
         ]);
     }
}
