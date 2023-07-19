<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acl extends Model
{
    use HasFactory;
    protected $table = 'role_to_accesses';
    
    public static function boot() {
        parent::boot();
        static::creating(function ($post) {
            $post->created_by = Auth::user()->id;
        });
    }
}
