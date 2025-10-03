<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SectionHeader extends Component
{
    /**
     * Create a new component instance.
     */
    public $header;
    public $icon;
    public $action;

    public function __construct($header, $icon = null, $action = null)
    {
        $this->header = $header;
        $this->icon = $icon;
        $this->action = $action;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.section-header');
    }
}