<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailAttachmentSyncRequest extends Model
{
    use HasFactory;
    protected $table = 'email_attachment_sync_requests';
}
