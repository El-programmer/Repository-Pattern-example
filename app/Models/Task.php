<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'title','description',
        'status','user_id','add_by_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function byUser(){
        return $this->belongsTo(User::class , 'add_by_id');
    }
    protected static function booted()
    {
        static::addGlobalScope('my-tasks', function ( $builder) {
            $builder->where(function ($query) {
                $query->where('user_id', auth()->id())
                    ->orWhere('add_by_id', auth()->id());
            });
        });
    }
}
