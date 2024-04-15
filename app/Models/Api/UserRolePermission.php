<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use App\Models\Api\UserRole;
use App\Models\Api\AppModule;

class UserRolePermission extends Model
{
    use HasFactory;

    public function appTitle(): HasOne {
        return $this->hasOne(AppModule::class,'id');
    }
}
