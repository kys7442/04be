<?php
namespace App\Providers;

use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Auth\Authenticatable as UserContract;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminUserProvider extends EloquentUserProvider
{
    public function validateCredentials(UserContract $admin, array $credentials)
    {
        return Hash::check($credentials['password'], $admin->getAuthPassword());
    }
}
