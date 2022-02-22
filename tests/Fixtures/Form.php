<?php

namespace Notano\Cruddy\Tests\Fixtures;

use Notano\Cruddy\Tests\Fixtures\Post;
use Illuminate\Support\Str;
use Notano\Cruddy\Livewire\CrudComponent;

class Form extends CrudComponent
{
    public Post $post;

    public array $rules = [
        'title' => ['required', 'string', 'max:20'],
    ];

    public function mount(Post $post)
    {
        if ($post->exists) {
            $this->post = $post;
            $this->state = $post->toArray();
            $this->setTarget('update');
        }

        $this->setupFlashMessages([
            'update' => 'tis been updated bruh',
        ]);
    }

    public function onCreate(array $data)
    {
        $data = $data + [
            'slug' => Str::slug($data['title']),
        ];

        Post::create($data);
    }

    public function onUpdate(array $data)
    {
        $data = $data + [
            'slug' => Str::slug($data['title']),
        ];

        $this->post->update($data);
    }

    public function onDelete()
    {
        $this->post->delete();
    }

    public function render()
    {
        return <<<'blade'
            <div>
                Hello world
            </div>
        blade;
    }
}
