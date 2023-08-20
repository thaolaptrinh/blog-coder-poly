<?php

namespace App\Models;

use App\Enums\PageStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'body',
        'status',
        'is_private',
    ];

    protected $dates = [
        'published_at'
    ];

    protected $casts = [
        'status' => PageStatus::class
    ];

    protected $attributes = [
        'status' => PageStatus::DRAFT
    ];


    public static $slugs = [];


    public function setTitleAttribute($value): void
    {
        $this->attributes['title'] = $value;

        if (!isset($this->attributes['slug']) || empty($this->attributes['slug'])) {
            $this->attributes['slug'] = $this->createUniqueSlug($value);
        }
    }

    public function createUniqueSlug($title, $increment = 0): string
    {
        $slug = \Illuminate\Support\Str::slug($title);

        if ($increment > 0) {
            $slug .= '-' . $increment;
        }

        $isExists = Page::where('slug', $slug)->exists();


        if (in_array($slug, self::$slugs)) {
            $isExists = true;
        }

        if ($isExists) {
            $increment++;
            return $this->createUniqueSlug($title, $increment);
        }


        self::$slugs[] = $slug;


        return $slug;
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
