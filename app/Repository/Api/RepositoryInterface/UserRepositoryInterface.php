<?php
namespace App\Repository\Api\RepositoryInterface;

interface UserRepositoryInterface {
	public function registerUser($request);
    public function getUserAfterLoggedIn($request);

}
?>