<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    protected $guarded = ['id'];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function scopeUserOnly($query)
    {
        return $query->where('is_super_admin', 0);//->where('user_type', '!=', 'sub_agent');
    }

    public function scopeMySubAgentOnly($query, $id)
    {
        return $query->where('parent_id', $id);
    }

    public function scopeSubAgentOnly($query)
    {
        return $query->where('user_type', 'sub_agent');
    }

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
