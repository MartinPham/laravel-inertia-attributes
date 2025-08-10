<?php

namespace MartinPham\InertiaAttributes\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
class InertiaPage
{
    /**
     * Create a new Inertia attribute instance.
     *
     * @param string $component The Inertia component name to render
     */
    public function __construct(public string $component)
    {
    }

    /**
     * Process the method return value and wrap it in an Inertia response.
     *
     * @param mixed $data The original return value of the method
     * @return Response
     */
    public function process(mixed $data): \Inertia\Response
    {
        return \Inertia\Inertia::render($this->component, $data);
    }
}
