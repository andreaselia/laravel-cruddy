<?php

namespace Notano\Cruddy\Traits;

trait HasModal
{
    public bool $modalShown = false;

    public function toggleModal()
    {
        $this->modalShown = ! $this->modalShown;
    }
}
