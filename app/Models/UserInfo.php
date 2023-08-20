<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "status",
        "photo",
        "bio",
        "company",
        "job_title",
        "github",
        "linkedin",
        "website",
    ];

    public function getPhotoAttribute()
    {
        return $this->attributes['photo'] ?? asset('static/default_avatar.jpg');
    }
}
