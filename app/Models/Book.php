<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Book extends Model
{
    protected $fillable = ['title', 'slug', 'author', 'genre_id', 'description', 'cover', 'year', 'publication_year'];

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getCoverAttribute($value)
    {
        return asset('storage/' . $value);
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value);
    }

    public function recomendations()
    {
        return $this->belongsToMany(Recomendation::class, 'book_recommendations');
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('author', 'like', '%' . $search . '%')
                ->orWhere('publication_year', 'like', '%' . $search . '%');
        });
    }

    public function scopeSort($query, array $sorts)
    {
        $query->when($sorts['title'] ?? false, function ($query, $title) {
            return $query->orderBy('title', $title);
        });

        $query->when($sorts['author'] ?? false, function ($query, $author) {
            return $query->orderBy('author', $author);
        });

        $query->when($sorts['publication_year'] ?? false, function ($query, $publication_year) {
            return $query->orderBy('publication_year', $publication_year);
        });
    }

    public function scopeGenre($query, array $genres)
    {
        $query->when($genres['genre'] ?? false, function ($query, $genre) {
            return $query->where('genre_id', $genre);
        });
    }

    public function scopeYear($query, array $years)
    {
        $query->when($years['year'] ?? false, function ($query, $year) {
            return $query->where('publication_year', $year);
        });
    }

    public function isRecommendation()
    {
        return $this->recomendations()->exists();
    }
}
