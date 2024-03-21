<?php

namespace LaraZeus\Sky\Components;

use Illuminate\View\Component;

class SkyLink extends Component
{
    public function __construct(
        public string $label,
        public ?bool $hasLabelWrap = false,
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function render()
    {
        return view('zeus.sky-link', $this->data());
    }
}
