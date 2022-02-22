<?php

namespace Notano\Cruddy\Tests\Fixtures;

use Illuminate\Database\Eloquent\Model;
use Notano\Cruddy\Tests\Fixtures\PostFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    /** @var array */
    protected $guarded = [];

    protected static function newFactory(): Factory
    {
        return PostFactory::new();
    }
}
