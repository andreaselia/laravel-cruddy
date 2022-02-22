<?php

namespace Notano\Cruddy\Livewire;

use Livewire\Component;
use Notano\Cruddy\Traits\HasFormTarget;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Notano\Cruddy\Traits\HasFlashMessages;
use Notano\Cruddy\Traits\HasModal;

class CrudComponent extends Component
{
    use AuthorizesRequests,
        HasFormTarget,
        HasFlashMessages,
        HasModal;

    public array $callbacks = [];

    public array $state = [];

    public array $rules = [];

    public function beforeCreate(array $inputData): array
    {
        return $inputData;
    }

    public function onCreate(array $validatedData)
    {
        return $validatedData;
    }

    public function create()
    {
        $inputData = $this->beforeCreate($this->state);

        $validatedData = Validator::make($inputData, $this->rules)->validate();

        $this->onCreate($validatedData);

        if ($this->flashMessages) {
            session()->flash('status', $this->flashMessages['create']);
        }

        $this->afterCreate();
    }

    public function afterCreate()
    {
        //
    }

    public function beforeUpdate(array $inputData)
    {
        return $inputData;
    }

    public function onUpdate(array $validatedData)
    {
        return $validatedData;
    }

    public function update()
    {
        $inputData = $this->beforeUpdate($this->state);

        $validatedData = Validator::make($inputData, $this->rules)->validate();

        $this->onUpdate($validatedData);

        if ($this->flashMessages) {
            session()->flash('status', $this->flashMessages['update']);
        }

        $this->afterUpdate();
    }

    public function afterUpdate()
    {
        //
    }

    public function beforeDelete()
    {
        //
    }

    public function onDelete()
    {
        //
    }

    public function delete()
    {
        $this->beforeDelete();

        $this->onDelete();

        if ($this->flashMessages) {
            session()->flash('status', $this->flashMessages['delete']);
        }

        $this->afterDelete();
    }

    public function afterDelete()
    {
        //
    }
}
