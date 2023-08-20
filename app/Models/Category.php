<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Kalnoy\Nestedset\NodeTrait;

class Category extends Model
{
    use HasFactory;
    use NodeTrait;


    protected $fillable = [
        "parent_id",
        "name",
        "slug",
        "description",
    ];

    public static $slugs = [];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = $this->createUniqueSlug($value);
    }


    public function createUniqueSlug($name, $increment = 0): string
    {
        $slug = Str::slug($name);

        if ($increment > 0) {
            $slug .= '-' . $increment;
        }

        $isExists = Category::where('slug', $slug)->exists();


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
        return $this->belongsToMany(Post::class, 'post_category', 'category_id', 'post_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
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
