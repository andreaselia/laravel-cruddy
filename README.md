# Laravel Cruddy

Livewire Cruddy helps speed up the development of Laravel apps using the TALL stack and opinionated hook-style integration.

![Laravel Livewire Cruddy](/screenshot.jpg?raw=true "Laravel Cruddy")

## Installation

Install the package:

```bash
composer require notano/laravel-cruddy
```

## Component

Making an existing component Cruddy friendly is as easy as extending `CrudComponent` and consuming the methods documented below. Here is a guide component:

```php
<?php

namespace App\Http\Livewire\Clients;

class Form extends CrudComponent
{
    public function mount(Client $client)
    {
        if ($client->exists) {
            $this->client = $client;
            $this->state = $client->toArray();
            $this->setTarget('update');
        }
    }

    public function create(array $data)
    {
        Client::create($data);

        $this->redirectRoute('clients.index');
    }

    public function update(array $data)
    {
        $this->client->update($data);

        $this->redirectRoute('clients.edit', $this->client);
    }

    public function delete()
    {
        $this->client->delete();

        $this->redirectRoute('clients.index');
    }
}
```

## Methods

### setupFlashMessages

This method allows you to automatically flash messages relevant to the creation/update/deletion of a record. The messages can also be customised. All messages are flashed with the "status" key.

```php
public function mount(Post $post)
{
    // Default:
    $this->setupFlashMessages();

    // Replace "record" with a custom type:
    $this->setupFlashMessages([], 'user');

    // Custom messages:
    $this->setupFlashMessages([
        'create' => 'The record may have been created successfully.',
        'update' => 'The record may have been updated successfully.',
        'delete' => 'The record may have been deleted successfully.',
    ]);
}
```

### beforeCreate/beforeUpdate

These methods allow you to modify the data before inserting or updating.

```php
public function beforeCreate(array $input)
{
    return array_merge($input, [
        'uuid' => Str::uuid(),
    ]);
}

public function beforeUpdate(array $input)
{
    return array_merge($input, [
        'slug' => Str::slug($input['title']),
    ]);
}
```

### create/update/delete

These methods are the main ones for all CRUD Form components.

```php
public function create(array $data)
{
    Client::create($data);

    $this->redirectRoute('clients.index');
}

public function update(array $data)
{
    $this->client->update($data);

    $this->redirectRoute('clients.edit', $this->client);
}

public function delete()
{
    $this->client->delete();

    $this->redirectRoute('clients.index');
}
```

## Contributing

You're more than welcome to submit a pull request, or if you're not feeling up to it - create an issue so someone else can pick it up.
