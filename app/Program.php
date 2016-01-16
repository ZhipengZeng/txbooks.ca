<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $table = 'programs';

    public function courses()
    {
        return $this->hasMany('App\Course');
    }
}
