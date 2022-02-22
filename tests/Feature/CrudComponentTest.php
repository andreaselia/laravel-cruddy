<?php

namespace Notano\Cruddy\Tests\Feature;

use Livewire\Livewire;
use Notano\Cruddy\Tests\TestCase;
use Notano\Cruddy\Tests\Fixtures\Form;
use Notano\Cruddy\Tests\Fixtures\Post;

class CrudComponentTest extends TestCase
{
    public function test_before_create()
    {
        Livewire::test(Form::class)
            ->set('state.title', 'Foo')
            ->call('create');

        $this->assertTrue(Post::whereTitle('Foo')->exists());
    }

    public function test_on_create()
    {
        $this->assertTrue(true);
    }

    public function test_before_update()
    {
        $this->assertTrue(true);
    }

    public function test_on_update()
    {
        $this->assertTrue(true);
    }

    public function test_on_delete()
    {
        $this->assertTrue(true);
    }
}
