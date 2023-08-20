<?php

namespace App\Models;

use App\Enums\CommentStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kalnoy\Nestedset\NodeTrait;

class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;
    use NodeTrait;


    protected $fillable  = [
        'parent_id',
        'user_id',
        'post_id',
        'comment',
        'status',
    ];

    protected $casts = [
        'status' => CommentStatus::class
    ];

    protected $attributes = [
        'status' => CommentStatus::PENDING
    ];


    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function parent(): BelongsTo
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }


    public function replies(): HasMany
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }
}
