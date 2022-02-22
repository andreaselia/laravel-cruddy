<?php

namespace Notano\Cruddy\Tests\Feature;

use Livewire\Livewire;
use Notano\Cruddy\Tests\TestCase;
use Notano\Cruddy\Tests\Fixtures\Form;
use Notano\Cruddy\Tests\Fixtures\Post;

class CrudComponentTest extends TestCase
{
    public function test_on_create()
    {
        Livewire::test(Form::class)
            ->set('state.title', 'Foo')
            ->call('create');

        $this->assertTrue(Post::whereTitle('Foo')->exists());
    }

    public function test_on_update()
    {
        $post = Post::factory()->create([
            'title' => 'Blablabla',
            'slug' => 'blablabla',
        ]);

        Livewire::test(Form::class, ['post' => $post])
            ->set('state.title', 'Bar')
            ->call('update');

        $this->assertTrue(Post::whereTitle('Bar')->exists());
    }

    public function test_on_delete()
    {
        $post = Post::factory()->create();

        Livewire::test(Form::class, ['post' => $post])
            ->call('delete');

        $this->assertDatabaseMissing('posts', ['id' => $post->id]);
    }
}
