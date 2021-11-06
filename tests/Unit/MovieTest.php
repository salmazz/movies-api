<?php

namespace Tests\Unit;

use Modules\Movie\Entities\Category;
use Modules\Movie\Entities\Movie;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MovieTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * Test model can be instantiated
     *
     * @return  void
     */
    public function test_models_can_be_instantiated()
    {
        Movie::factory()->count(15)->create();

        $this->assertDatabaseCount('movies', 15);
        $this->assertTrue(count(Movie::all()) > 1);
    }

    /**
     * Test a movie can insert categories
     *
     * @return void
     */
    public function test_a_movie_can_insert_categories()
    {
        $categories = Category::factory()->count(2)->create();

        Movie::factory()->count(20)->create()->each(function($movie) use ($categories) {
            $movie->categories()->sync($categories->pluck('id')->toArray());
        });

        $this->assertDatabaseCount('categories', 2);
        $this->assertDatabaseCount('movies', 20);
        $this->assertDatabaseCount('category_movie', 40);
    }
}
