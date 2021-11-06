<?php

namespace Modules\Movie\Repositories\Eloquent;

use Illuminate\Support\Arr;
use Modules\Movie\Entities\Movie;
use Modules\Movie\Entities\MovieJobStep;
use Modules\Movie\Repositories\MovieRepository;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class TestRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class MovieRepositoryEloquent extends BaseRepository implements MovieRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Movie::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Search in items
     *
     * @param $input
     * @return mixed
     */
    public function search($input)
    {
        $query = $this->model->newQuery();

        $query->when(data_get($input, 'release_date'), function ($q) use ($input) {
            $q->where('release_date', data_get($input, 'release_date'));
        });

        $query->when(data_get($input, 'q'), function ($q) use ($input) {
            $q->where(function ($q) use ($input) {
                $request_query = data_get($input, 'q');
                $q->whereLike('title', $request_query)->orWhereLike('original_title', $request_query)->orWhereLike('overview', $request_query);
            });
        });

        $query->when(data_get($input, 'category_id'), function ($q) use ($input) {
            $q->whereHas('categories', function ($q) use ($input) {
                $q->where('categories.category_id', data_get($input, 'category_id'));
            });
        });

        $query->when(data_get($input, 'original_language'), function ($q) use ($input) {
            $q->where(function ($q) use ($input) {
                $q->whereLike('original_language', data_get($input, 'original_language'));
            });
        });

        $query = $this->sortByInSearch($query, data_get($input, 'sort_by'));

        return $query->paginate(data_get($input, 'per_page', '15'))->appends($input);
    }

    /**
     * Sory by in search
     *
     * @param $query
     * @param $sort_by
     * @return mixed
     */
    private function sortByInSearch($query, $sort_by)
    {
        switch ($sort_by) {
            case "popular":
                $query->orderBy('popularity', 'desc');
                break;
            case "top_rated":
                $query->orderBy('vote_average', 'desc')->orderBy('vote_count', 'desc');
                break;
            case "latest":
            default:
                $query->orderBy('movie_id', 'desc');
                break;
        }

        return $query;
    }

    /**
     * @return mixed|void
     */
    public function movieStep()
    {
        $movie_steps = MovieJobStep::first();
        $movie_steps ? $movie_steps->increment('steps') : MovieJobStep::create(['steps' => 1]);
    }

    /**
     * @return int
     */
    public function steps()
    {
        return MovieJobStep::value('steps') ?: 0;
    }

    /**
     * @param $item
     * @param $type_of_movie
     * @param $categories
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function updateAndCreateMovies($item, $type_of_movie, $categories)
    {
        $movie = $this->updateOrCreate(
            ['movie_id' => data_get($item, 'id')],
            array_merge(['type_of_movie' => $type_of_movie], Arr::except($item, ['id']))
        );

        $movie->categories()->sync(collect($categories)->whereIn('category_id', data_get($item, 'genre_ids'))->pluck('id')->toArray());
    }
}
