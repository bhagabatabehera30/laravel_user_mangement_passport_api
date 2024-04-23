<?php 
namespace Tests;

use App\Models\User;
use Illuminate\Testing\TestResponse;
use Laravel\Passport\Passport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

trait Helper
{
    protected function createPersonalClient()
    {
        Passport::$hashesClientSecrets = false;
        /*Artisan::call('passport:client',
        ['--name' => 'AUTH API', '--personal' => null]);*/
     $this->artisan(
            'passport:client',
            ['--name' => 'AUTH API', '--personal' => null]
        );
        

        // use the query builder instead of the model, to retrieve the client secret
        $authOC= DB::table('oauth_clients')
            ->where('personal_access_client','=',true)
            ->first();
           // dd($authOC);
            return $authOC;
    }
}