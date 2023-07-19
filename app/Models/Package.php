<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model {

    use HasFactory,
        SoftDeletes;

    public static function boot() {
        parent::boot();
        static::creating(function ($post) {
            $post->created_by = \Auth::user()->id;
        });
        static::deleting(function ($package) {
            $package->attachments()->delete();
        });
    }

    public function attachments() {
        return $this->hasMany(DocumentAttachment::class, 'application_id');
    }
	
	

}
