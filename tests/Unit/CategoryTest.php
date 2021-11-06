<?php

namespace Tests\Unit;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Movie\Entities\Category;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase,HasFactory;

    public function test_models_can_be_instantiated()
    {
        Category::factory()->count(15)->create();

        $this->assertDatabaseCount('categories', 15);
        $this->assertTrue(count(Category::all()) > 1);
    }
}
