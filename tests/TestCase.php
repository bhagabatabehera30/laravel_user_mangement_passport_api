<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Laravel\Passport\Client;
use Laravel\Passport\Passport;
use App\Models\User;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    //protected $seed = true;
    public function createUser($args =[]) {
        return User::factory()->create($args);
    }

    public function authUser($args =[], $scopeArr=[]) {
        $user=$this->createUser($args);
        Passport::actingAs(
            $user,
            $scopeArr
        );
        return $user;
    }
}
