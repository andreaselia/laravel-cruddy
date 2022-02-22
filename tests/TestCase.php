<?php

namespace Notano\Cruddy\Tests;

use Livewire\LivewireServiceProvider;
use Notano\Cruddy\CruddyServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app): array
    {
        return [
            CruddyServiceProvider::class,
            LivewireServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app): void
    {
        //
    }
}
