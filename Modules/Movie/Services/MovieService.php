<?php

namespace Modules\Movie\Services;

use App\Services\Service;
use Illuminate\Support\Facades\Http;
use Modules\Movie\Repositories\CategoryRepository;
use Modules\Movie\Repositories\MovieRepository;

class MovieService extends Service
{
    /**
     * @var $categories
     */
    public $categories;

    /**
     * @var $steps
     */
    public $steps;

    /**
     * @var CategoryRepository
     */
    public $categoryRepository ;

    /**
     * @return string
     */
    public function repository()
    {
        return MovieRepository::class;
    }

    /**
     * MovieService constructor.
     * @param CategoryRepository $categoryRepository
     */
    Public function __construct(CategoryRepository $categoryRepository)
    {
        parent::__construct();
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @throws \Exception
     */
    public function seedMovies()
    {
        $this->categories = $this->categoryRepository->all();

        $this->steps = $this->repository->steps();

        // Insert Popular movie into db
        $this->handleSeeder($this->getResponse('popular'), 'popular');

        // Insert Top rated  movie into db
        $this->handleSeeder($this->getResponse('top_rated'), 'top_rated');

        $this->repository->movieStep();
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     * @throws \Exception
     */
    private function handleSeeder($data, $type_of_movie)
    {
        foreach (array_slice(data_get($data, 'results'), ($this->steps * config('movies.num_of_records')), config('movies.num_of_records'), true) as $item) {
            $this->repository->updateAndCreateMovies($item, $type_of_movie, $this->categories);
        }
    }

    /**
     * @param $end_point
     * @return \Illuminate\Http\Client\Response
     */
    private function getResponse($end_point) {
        return Http::get(config('movies.base_url').$end_point, [
            'api_key' => config('movies.api_key'),
            'language' => config('movies.language'),
        ]);
    }

    /**
     * Search in movies
     *
     * @param $input
     * @return mixed
     */
    public function search($input)
    {
        return $this->repository->search($input);
    }
}
