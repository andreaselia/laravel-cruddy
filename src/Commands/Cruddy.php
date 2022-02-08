<?php

namespace Notano\Cruddy\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class Cruddy extends Command
{
    protected $signature = 'cruddy:make {model} {--modal}';

    protected $description = 'Install the BlogPackage';

    public function handle()
    {
        $modelName = $this->argument('model');
        $isModal = $this->option('modal');

        $singularClass = Str::studly($modelName);
        $pluralClass = ucfirst(Str::pluralStudly($modelName));
        $singularString = lcfirst(Str::studly($modelName));
        $pluralString = lcfirst(Str::pluralStudly($modelName));

        $this->info("Creating Cruddy for $singularClass");

        foreach ($this->getLivewireStubs($isModal) as $file => $stub) {
            $path = app_path("Http/Livewire/$pluralClass");

            File::ensureDirectoryExists($path);

            $fileContents = $this->replaceDummy($stub, $singularClass, $pluralClass, $singularString, $pluralString);

            File::put("$path/$file.php", $fileContents);
        }

        foreach ($this->getViewStubs($isModal) as $file => $stub) {
            $path = resource_path("views/livewire/$pluralString");

            File::ensureDirectoryExists($path);

            $fileContents = $this->replaceDummy($stub, $singularClass, $pluralClass, $singularString, $pluralString);

            File::put("$path/$file.blade.php", $fileContents);
        }

        return Command::SUCCESS;
    }

    protected function replaceDummy($stub, $singularClass, $pluralClass, $singularString, $pluralString)
    {
        $stub = file_get_contents($stub);

        $stub = str_replace('Dummy', $singularClass, $stub);
        $stub = str_replace('Dummies', $pluralClass, $stub);
        $stub = str_replace('dummy', $singularString, $stub);
        $stub = str_replace('dummies', $pluralString, $stub);

        return $stub;
    }

    protected function getLivewireStubs(bool $isModal): array
    {
        $stubs = [
            'Index' => __DIR__.'/stubs/Index.php.stub',
            'Show' => __DIR__.'/stubs/Show.php.stub',
        ];

        if ($isModal) {
            $stubs['Form'] = __DIR__.'/stubs/Form.php.stub';
        } else {
            $stubs['FormModal'] = __DIR__.'/stubs/FormModal.php.stub';
        }

        return $stubs;
    }

    protected function getViewStubs(bool $isModal): array
    {
        $stubs = [
            'index' => __DIR__.'/stubs/index.blade.php.stub',
            'show' => __DIR__.'/stubs/show.blade.php.stub',
        ];

        if ($isModal) {
            $stubs['form'] = __DIR__.'/stubs/form.blade.php.stub';
        } else {
            $stubs['form-modal'] = __DIR__.'/stubs/form-modal.blade.php.stub';
        }

        return $stubs;
    }
}
