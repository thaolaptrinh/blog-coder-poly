<?php

namespace App\Models;

use App\Enums\PostLayout;
use App\Enums\PostStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $fillable = [
        "user_id",
        "title",
        "thumbnail",
        "slug",
        "body",
        "status",
        "published_at",
        "is_comment",
        "is_private",
        "layout"
    ];

    protected $casts = [
        'status' => PostStatus::class,
        "layout" => PostLayout::class,
        "published_at" => 'date'
    ];

    protected $attributes = [
        'status' => PostStatus::DRAFT,
        'layout' => PostLayout::RIGHT_SIDEBAR,
    ];




    public function getUrlAttribute()
    {
        return route('guest.post', $this->attributes['slug']);
    }

    public function getPublishedAtAttribute($date)
    {
        Carbon::setLocale('vi');
        return Carbon::parse($date)->translatedFormat('j F Y');
    }

    public function setTitleAttribute($value): void
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = $this->createUniqueSlug($value);
    }

    public  static $slugs = [];


    public function createUniqueSlug($name, $increment = 0): string
    {
        $slug = \Illuminate\Support\Str::slug($name);

        if ($increment > 0) {
            $slug .= "-" . $increment;
        }


        $isExists = Post::whereSlug($slug)->exists();

        if (in_array($slug, self::$slugs)) {
            $isExists = true;
        }


        if ($isExists) {
            $increment++;
            return $this->createUniqueSlug($name, $increment);
        }

        self::$slugs[] = $slug;



        return $slug;
    }

    public function scopeSearch($query, $term)
    {
        $term = "%$term%";
        $query->where(function ($query) use ($term) {
            $query->where('title', 'like', $term)
                ->orWhere('slug', 'like', $term);
        });
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'post_tag', 'post_id', 'tag_id');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'post_category', 'post_id', 'category_id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
