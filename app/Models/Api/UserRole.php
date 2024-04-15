<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UserRole extends Model
{
    use HasFactory;

    protected $fillable = ['role_name'];

    public function user(): HasOne {
        return $this->hasOne(User::class,'primary_role_id','id');
    }
}
