<?php

namespace Modules\Movie\Services;

use App\Services\Service;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Modules\Movie\Entities\Category;
use Modules\Movie\Repositories\CategoryRepository;

class CategoryService extends Service
{
    /**
     * @return string
     */
    public function repository()
    {
        return CategoryRepository::class;
    }

    /**
     * @param array $attributes
     * @return mixed
     * @throws \Exception
     */
    public function storeCategories()
    {
        $response = Http::get('https://api.themoviedb.org/3/genre/movie/list', [
            'api_key' => env('API_KEY'),
            'language' => 'en-US',
        ]);

        foreach (data_get($response, 'genres') as $item) {
            $this->updateOrCreate(['category_id' => data_get($item, 'id')],['name' => data_get($item,'name')]);
        }
    }
}
