<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'phone',
        'first_name',
        'last_name',
        'salary',
        'image_url',
        'password',
        'manager_id',
        'role',
        'department_id',
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function manager(){
        return $this->belongsTo(User::class , 'manager_id');
    }
    public function department(){
        return $this->belongsTo(Department::class , 'department_id');
    }
    public function getFullNameAttribute($key)
    {
        return $this->first_name.' '.$this->last_name;
    }
    public function getImgUrlAttribute($key)
    {
        return $this->image_url ? Storage::url($this->image_url) : "/images/blank.png";
    }
    public function isManager()
    {
        return $this->role == 'manager';
    }

}
