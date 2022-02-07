<?php

namespace Notano\Cruddy\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class Cruddy extends Command
{
    protected $signature = 'cruddy:make {model}';

    protected $description = 'Install the BlogPackage';

    public function handle()
    {
        $modelName = $this->argument('model');

        // convert to namespace friendly names
        $singularClass = Str::studly($modelName);
        $pluralClass = ucfirst(Str::pluralStudly($modelName));
        $singularString = lcfirst(Str::studly($modelName));
        $pluralString = lcfirst(Str::pluralStudly($modelName));

        $this->info("Creating Cruddy for $singularClass");

        $appPath = app('path');

        foreach ($this->getLivewireStubs() as $file => $stub) {
            $path = "$appPath/Http/Livewire/$pluralClass";

            File::ensureDirectoryExists($path);

            $fileContents = file_get_contents($stub);

            $fileContents = str_replace('Dummy', $singularClass, $fileContents);
            $fileContents = str_replace('Dummies', $pluralClass, $fileContents);
            $fileContents = str_replace('dummy', $singularString, $fileContents);
            $fileContents = str_replace('dummies', $pluralString, $fileContents);

            File::put("$path/$file.php", $fileContents);
        }

        // $this->copyStub('Cruddy.php', "app/Cruddy/$singularClass.php");

        return Command::SUCCESS;
    }

    protected function getLivewireStubs()
    {
        return [
            'Index' => __DIR__.'/stubs/Index.php.stub',
            'Form' => __DIR__.'/stubs/Form.php.stub',
            'Show' => __DIR__.'/stubs/Show.php.stub',
        ];
    }

    protected function getViewStubs()
    {
        return [
            __DIR__.'/stubs/index.blade.php.stub',
            __DIR__.'/stubs/form.blade.php.stub',
            __DIR__.'/stubs/show.blade.php.stub',
        ];
    }
}
