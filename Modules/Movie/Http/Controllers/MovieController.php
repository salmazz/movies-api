<?php

namespace Modules\Movie\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Movie\Http\Requests\MovieRequest;
use Modules\Movie\Services\CategoryService;
use Modules\Movie\Services\MovieService;
use Modules\Movie\Transformers\ListMoviesResource;

class MovieController extends Controller
{
    /** @var  $movieService */
    private $movieService;

    /** @var  $categoryService */
    private $categoryService;

    /**
     * MovieController constructor.
     * @param MovieService $movieService
     * @param CategoryService $categoryService
     */
    public function __construct(MovieService $movieService, CategoryService $categoryService)
    {
        // Initialize repository
        $this->movieService = $movieService;
        $this->categoryService = $categoryService;
    }

    /**
     * List of movies
     *
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function listMovies(MovieRequest $request)
    {
        return ListMoviesResource::collection($this->movieService->search($request->all()));
    }
}
