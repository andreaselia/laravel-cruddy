<?php

namespace Notano\Cruddy\Traits;

trait HasRedirects
{
    public $redirection;

    public function redirect($url)
    {
        $this->redirection = $url;
    }

    public function redirectRoute($name, $parameters = [], $absolute = true)
    {
        $this->redirection = route($name, $parameters, $absolute);
    }

    public function redirectAction($name, $parameters = [], $absolute = true)
    {
        $this->redirection = action($name, $parameters, $absolute);
    }
}
