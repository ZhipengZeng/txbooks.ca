<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class SocialUser extends Model implements AuthenticatableContract,
                                    AuthorizableContract
{
	use Authenticatable, Authorizable;

    protected $table = 'socialusers';

    protected $fillable = ['username', 'email', 'provider_id', 'avatar', 'name', 'provider', 'admin'];
}
