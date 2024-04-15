<?php
namespace App\Repository\Api;

use App\Repository\Api\RepositoryInterface\UserRepositoryInterface;
use App\Helper\CommonHelper;
use App\Models\User;
use App\Models\Api\UserRole;
use App\Models\Api\UserRolePermission;
use Hash;

//use Illuminate\Support\Facades\Redis;


class UserRepository implements UserRepositoryInterface{

	public function registerUser($request){
        $userRoleName=UserRole::find(($request->primary_role_id!=null) ? $request->primary_role_id : 3);
        $userRoleName=($userRoleName) ? $userRoleName->role_name : null;
        $userArr=[
          'first_name'=>$request->first_name,
          'last_name'=>$request->last_name,
          'primary_role_id'=>($request->primary_role_id!=null) ? $request->primary_role_id : 3,
          'mobile'=>$request->mobile,
          'email'=>$request->email,
          'password'=>Hash::make($request->password),
          'user_code'=>strtoupper(substr($request->first_name,0,2)).CommonHelper::getRandomString(6,true,true),
          'country_code'=>($request->country_code!=null) ? $request->country_code : 91,
          'label'=>$userRoleName,
          'status'=>1
        ];
        return $user=User::create($userArr);
	}

    public function getUserAfterLoggedIn($user) {

        $roleIdsArr=[];
        if($user->primary_role_id){$roleIdsArr[]=$user->primary_role_id;}
        if($user->secondary_roles!=null){
            $roleIdsArr=array_merge($roleIdsArr, explode(',', $user->secondary_roles));
        }
        $userRolePermissions=UserRolePermission::with('appTitle')->whereIn('role_id', $roleIdsArr)
        ->distinct('module_id')->orderBy('role_id','ASC')->get();
        foreach ($userRolePermissions as $key => $value) {
           if($userRolePermissions[$key]->appTitle!=null){
            $userRolePermissions[$key]->module_title=$userRolePermissions[$key]->appTitle->module_title;
            unset($userRolePermissions[$key]->appTitle);
           }
        }
        $user->userPermissions=$userRolePermissions;
        return $user; 
    }

	
}
?>