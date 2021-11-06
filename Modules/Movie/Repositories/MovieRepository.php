<?php

namespace Modules\Movie\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface TestRepository.
 *
 * @package namespace App\Repositories;
 */
interface MovieRepository extends RepositoryInterface
{
    /**
     * Search in movies
     *
     * @param $input
     * @return mixed
     */
    public function search($input);

    /**
     * @return mixed
     */
    public function movieStep();

    /***
     * @return mixed
     */
    public function steps();

    /**
     * @param $item
     * @param $type_of_movie
     * @param $categories
     * @return mixed
     */
    public function updateAndCreateMovies($item, $type_of_movie, $categories);
}
