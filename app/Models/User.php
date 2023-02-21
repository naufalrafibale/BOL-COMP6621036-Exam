<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'password',
        'gender',
        'role_id',
    ];

    protected $nullable = [
        'gender'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function roles()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function customer()
    {
        return $this->hasOne(Customer::class);
    }

    public function isAdmin()
    {
        if ($this->roles->name == "admin")
        {
            return True;
        }
    }

    public function isStaff()
    {
        if ($this->roles->name == "staff")
        {
            return True;
        }
    }

    public function isCustomer()
    {
        if ($this->roles->name == "customer")
        {
            return True;
        }
    }
}
