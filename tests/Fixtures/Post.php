<?php

namespace Notano\Cruddy\Tests\Fixtures;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /** @var array */
    protected $guarded = [];
}
