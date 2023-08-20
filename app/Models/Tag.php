<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'slug',
        'description',
    ];


    public static $slugs = [];


    public function setNameAttribute($value): void
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = $this->createUniqueSlug($value);
    }

    public function createUniqueSlug($name, $increment = 0): string
    {
        $slug = \Illuminate\Support\Str::slug($name);

        if ($increment > 0) {
            $slug .= "-" . $increment;
        }

        $isExists = Tag::whereSlug($slug)->exists();

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

    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'post_tag', 'tag_id', 'post_id');
    }

    public function scopeSearch($query, $term)
    {
        $term = "%$term%";


        $query->where(function ($query) use ($term) {
            $query->where('name', 'like', $term)
                ->orWhere('description', 'like', $term)
                ->orWhere('slug', 'like', $term);
        });
    }
}
