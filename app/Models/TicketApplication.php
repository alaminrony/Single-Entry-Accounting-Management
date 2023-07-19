<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TicketApplication extends Model {

    use HasFactory,
        SoftDeletes;

    public static function boot() {
        parent::boot();
        static::creating(function ($post) {
            $post->created_by = \Auth::user()->id;
        });
        static::deleting(function ($ticket) {
            $ticket->attachments()->delete();
        });
    }

    public function attachments() {
        return $this->hasMany(DocumentAttachment::class, 'application_id');
    }

    public function reissue() {
        return $this->hasMany(TicketReissue::class, 'ticket_application_id');
    }

    public function refund() {
        return $this->hasMany(TicketRefund::class, 'ticket_application_id');
    }

    public function deport() {
        return $this->hasMany(TicketDeport::class, 'ticket_application_id');
    }

}
