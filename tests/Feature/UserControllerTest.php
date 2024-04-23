<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
//use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Laravel\Passport\Passport;
//use Laravel\Passport\PersonalAccessClient;
//use Auth;
//use Tests\Helper;


class UserControllerTest extends TestCase
{
     //use RefreshDatabase;
     use DatabaseTransactions;

     public function setUp(): void
      {
        parent::setUp();
        $this->authUser([]);
     }
     
    /**
     * A basic feature test example.
     */
    //private Generator $faker;
    public function test_user_registration(): void
    {
        //$user = User::factory()->make();
        //$payload=$user;
        //$payload->password=$user->password;
        //dd($payload->toArray());
        $payload=[
            'first_name' => fake()->name(),
            'last_name' => fake()->name(),
            'user_code'=> fake()->unique()->userName(),
            'email' => fake()->unique()->safeEmail(),
            'country_code' => fake()->areaCode(),
            'mobile' => Str::of(fake()->unique()->phoneNumber())->substr(0, 15),
            'label' => Str::of(fake()->jobTitle())->substr(0, 20),
            'status' => 1,
            'primary_role_id'=>3,
            'creator_id' => null,
            'secondary_roles' => null,
            'email_verified_at' => now(),
            'password' => Str::random(8), // password
            'remember_token' => Str::random(10),
        ];
        //dd($payload);
        $this->json('post', 'api/v2/auth/register', $payload)
         ->assertStatus(201);
        
    }

    function test_login_with_email() : void
    {
        $payload=[
            'email' => 'superadmin@mailinator.com',
            'password' => '99999999'
        ];
        
        $this->json('post', 'api/v2/auth/login/email', $payload)
         ->assertStatus(200);
    }

    function test_user_profile() : void
    {
        //$this->authUser([]);
        
        $user=$this->json('get', 'api/v2/auth/user/profile');
        //dd($user->assrt);
        $user->assertStatus(200);
    }

    
    

    
}
