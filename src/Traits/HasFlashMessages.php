<?php

namespace Notano\Cruddy\Traits;

trait HasFlashMessages
{
    public array $flashMessages = [];

    public function setupFlashMessages(array $messages = [], string $type = 'record')
    {
        if ($messages) {
            $this->validateCustomFlashMessages($messages);
        }

        $this->flashMessages = array_merge([
            'create' => "The $type has been created successfully.",
            'update' => "The $type has been updated successfully.",
            'delete' => "The $type has been deleted successfully.",
        ], $messages);
    }

    protected function validateCustomFlashMessages(array $messages)
    {
        foreach ($messages as $key => $message) {
            if (! in_array($key, ['create', 'update', 'delete'])) {
                throw new \Exception("The flash messages must be an array containing keys of 'create', 'update', and 'delete' only.");
            }
        }

        return $messages;
    }
}
