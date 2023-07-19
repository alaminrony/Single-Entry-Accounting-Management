<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketReissue extends Model {

    use HasFactory;

    public static function boot() {
        parent::boot();
        static::creating(function ($post) {
            $post->created_by = \Auth::user()->id;
        });
    }
}
