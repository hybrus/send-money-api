<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditTrail extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "email",
        "type",
        "status",
        "route",
        "client_ip",
        "description",
    ];
}
