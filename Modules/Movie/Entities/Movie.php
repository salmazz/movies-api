<?php

namespace Modules\Movie\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Movie\Database\factories\MovieFactory;

class Movie extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = ['adult', 'movie_id', 'backdrop_path', 'genre_ids', 'original_language', 'original_title',
        'overview', 'popularity', 'poster_path', 'release_date', 'title', 'video', 'vote_average', 'vote_count', 'type_of_movie'];

    /**
     * @var string[]
     */
    protected $casts = ['genre_ids' => 'json'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_movie');
    }

    /**
     * Get rules
     *
     * @return string[]
     */
    public static function rules()
    {
        return [
            'release_date' => 'nullable|date',
            'title' => 'nullable|string|min:1|max:100',
            'original_title' => 'nullable|string|min:2|max:30000',
            'category_id' => 'nullable|numeric|min:0|max:999999999',
            'original_language' => 'nullable|string|min:2|max:300',
            'per_page' => 'nullable|numeric|min:0|max:999999999'
        ];
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return MovieFactory::new();
    }
}
