<?php

namespace Core;

use Core\Renderer;

abstract class AbstractController
{
    protected function render($view, $data)
    {
        $content = Renderer::render($view, $data);

        return new Response($content);
    }

}
