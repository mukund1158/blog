<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use HasRoles;
    use Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',
        'birthday',
        'locale',
        'image',
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

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',

    ];

    /**
     * Save a name value in database with first capital.
     *
     * @param  string  $value
     * @return mixed
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucfirst($value);
    }

    /**
     * Save an email value in database in lowercase.
     *
     * @param  string  $value
     * @return mixed
     */
    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = strtolower($value);
    }

    /**
     * Find specific user with role
     *
     * @return User
     */
    public function scopeAdmin($query)
    {
        $query->whereHas('roles', function ($query) {
            $query->whereIn('name', ['super-admin', 'admin']);
        });
    }

    /**
     * For find a specific user
     *
     * @return User
     */
    public function scopeFindUser($query, $data)
    {
        $query->where('id', $data['id']);
    }

    /**
     * For search User with keyword.
     *
     * @param  string  $search
     * @return User
     */
    public function scopeSearch($query, $search)
    {
        $query->where('name', 'LIKE', '%'.$search.'%')
            ->orwhere('email', 'LIKE', '%'.$search.'%')
            ->orwhere('created_at', 'LIKE', '%'.$search.'%')
            ->orwhere('updated_at', 'LIKE', '%'.$search.'%');
    }
}
