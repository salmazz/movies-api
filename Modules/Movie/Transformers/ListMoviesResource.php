<?php

namespace Modules\Movie\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class ListMoviesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'movie_id' => $this->movie_id,
            'backdrop_path' => $this->backdrop_path,
            'adult' => $this->adult == '0' ? 'false' : 'true',
            'genre_ids' => $this->genre_ids,
            'original_language' => $this->original_language,
            'original_title' => $this->original_title,
            'overview' => $this->overview,
            'popularity' => $this->popularity,
            'poster_path' => $this->poster_path,
            'release_date' => $this->release_date,
            'title' => $this->title,
            'video' => $this->video == '0' ? 'no video for this item' : $this->video ,
            'vote_average' => $this->vote_average,
            'vote_count' => $this->vote_count,
            'type_of_movie' => $this->type_of_movie,
        ];
    }
}
