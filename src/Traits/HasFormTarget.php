<?php

namespace Notano\Cruddy\Traits;

use Notano\Cruddy\Exceptions\InvalidFormTarget;

trait HasFormTarget
{
    public string $target = 'create';

    public array $targets = [
        'create',
        'update',
    ];

    public function setTarget(string $target): void
    {
        if (! in_array($target, $this->targets)) {
            throw new InvalidFormTarget;
        }

        $this->target = $target;
    }

    public function isTarget(string $target): bool
    {
        return $this->target === $target;
    }
}
