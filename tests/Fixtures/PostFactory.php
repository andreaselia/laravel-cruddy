<?php

namespace Notano\Cruddy\Tests\Fixtures;

use Illuminate\Support\Str;
use Notano\Cruddy\Tests\Fixtures\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $title = $this->faker->sentence(5),
            'slug' => Str::slug($title),
        ];
    }
}
