<?php

namespace Tests\Unit;

//use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Repository\Api\UserRepository;

class UserRepositoryInterfaceTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic unit test example.
     */
    
    public function test_get_user_after_loggedin(): void
    {
        $user=$this->createUser([]);
        $repo=new UserRepository();
        $user=$repo->getUserAfterLoggedIn($user);
        $this->assertJson($user,'success');
        $this->assertTrue(true);
    }
}
