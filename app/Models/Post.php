<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

class Post extends Model
{
    public $fillable = [
        'title', 'content', 'status','user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function scopeFilter($q)
    {
        $keyword = request()->search['value'] ?? null;
        $q->when(\request("user_id"), function (Builder $query) {
            $query->where("user_id", \request("user_id"));
        })->when(\request("user_id"), function (Builder $query) use ($keyword) {
            $query->where('title', 'LIKE', "%{$keyword}%");
        });
    }
}
