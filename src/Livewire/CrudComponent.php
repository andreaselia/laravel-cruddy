<?php

namespace Notano\Cruddy\Livewire;

use Closure;
use Livewire\Component;
use App\Traits\HasFormTarget;
use Notano\Cruddy\Traits\HasRedirects;
use Illuminate\Support\Facades\Validator;
use Laravel\SerializableClosure\SerializableClosure;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CrudComponent extends Component
{
    use AuthorizesRequests,
        HasFormTarget;

    public array $callbacks = [];

    public array $state = [];

    protected function beforeCreate(Closure $closure)
    {
        $serialized = serialize(new SerializableClosure($closure));

        $this->callbacks['beforeCreate'] = $serialized;

        return $this;
    }

    protected function onCreate(Closure $closure)
    {
        $serialized = serialize(new SerializableClosure($closure));

        $this->callbacks['onCreate'] = $serialized;

        return $this;
    }

    public function create()
    {
        $inputData = $this->state;

        if (isset($this->callbacks['beforeCreate'])) {
            $beforeClosure = unserialize($this->callbacks['beforeCreate'])->getClosure();
            $inputData = $beforeClosure($inputData);
        }

        $validatedData = Validator::make($inputData, $this->rules)->validate();

        $onClosure = unserialize($this->callbacks['onCreate'])->getClosure();
        $onClosure($this, $validatedData);

        if ($this->flashMessages) {
            session()->flash('status', $this->flashMessages['create']);
        }

        if ($this->redirection) {
            $this->redirectTo = $this->redirection;
        }
    }

    protected function beforeUpdate(Closure $closure)
    {
        $serialized = serialize(new SerializableClosure($closure));

        $this->callbacks['beforeUpdate'] = $serialized;

        return $this;
    }

    protected function onUpdate(Closure $closure)
    {
        $serialized = serialize(new SerializableClosure($closure));

        $this->callbacks['update'] = $serialized;

        return $this;
    }

    public function update()
    {
        $inputData = $this->state;

        if (isset($this->callbacks['beforeUpdate'])) {
            $beforeClosure = unserialize($this->callbacks['beforeUpdate'])->getClosure();
            $inputData = $beforeClosure($inputData);
        }

        $validatedData = Validator::make($inputData, $this->rules)->validate();

        $onClosure = unserialize($this->callbacks['update'])->getClosure();
        $onClosure($this, $validatedData);

        if ($this->flashMessages) {
            session()->flash('status', $this->flashMessages['update']);
        }

        if ($this->redirection) {
            $this->redirectTo = $this->redirection;
        }
    }

    protected function onDelete(Closure $closure)
    {
        $serialized = serialize(new SerializableClosure($closure));

        $this->callbacks['delete'] = $serialized;

        return $this;
    }

    public function delete()
    {
        $closure = unserialize($this->callbacks['delete'])->getClosure();

        $closure($this);

        if ($this->flashMessages) {
            session()->flash('status', $this->flashMessages['delete']);
        }

        if ($this->redirection) {
            $this->redirectTo = $this->redirection;
        }
    }
}
