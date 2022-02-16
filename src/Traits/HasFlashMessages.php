<?php

namespace Notano\Cruddy\Traits;

trait HasFlashMessages
{
    public array $flashMessages = [];

    public function setupFlashMessages(array $messages, string $type = 'record')
    {
        if (empty($messages)) {
            $this->flashMessages = [
                'create' => "The $type has been created successfully.",
                'update' => "The $type has been updated successfully.",
                'delete' => "The $type has been deleted successfully.",
            ];

            return;
        }

        $this->validateCustomFlashMessages($messages);
    }

    protected function validateCustomFlashMessages(array $messages)
    {
        if (array_keys($messages) !== ['create', 'update', 'delete']) {
            throw new \Exception("The flash messages must be an array with keys 'create', 'update', and 'delete'.");
        }

        return $messages;
    }
}
