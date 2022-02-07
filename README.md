# Laravel Cruddy

Livewire Cruddy helps speed up the development of Laravel apps using the TALL stack and opinionated hook-style integration.

![Laravel Livewire Cruddy](/screenshot.jpg?raw=true "Laravel Cruddy")

## Installation

Install the package:

```bash
composer require notano/laravel-cruddy
```

## Component

Adding the new component to an existing component is as easy as:

```php
class Form extends CrudComponent
{
    // ...

    public function registerCrud()
    {
        $this->beforeCreate(function (array $input) {
            return array_merge($input, [
                'uuid' => Str::uuid(),
            ]);
        })->onCreate(function ($component, array $data) {
            $client = Client::create($data);

            $component->redirectRoute('clients.show', $client);
        });

        $this->onUpdate(function ($component, array $data) {
            $this->client->update($data);
        })->redirectRoute('clients.show', $this->client);

        $this->onDelete(function ($component) {
            $this->client->delete();

            $component->redirectRoute('clients.index');
        });
    }
}
```

## Contributing

You're more than welcome to submit a pull request, or if you're not feeling up to it - create an issue so someone else can pick it up.
