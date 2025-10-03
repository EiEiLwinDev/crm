<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;
use Illuminate\View\Component;

class SvgIcon extends Component
{
    /**
     * Create a new component instance.
     */
    public $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function hello(){
        Log::info('hello');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.svg-icon');
    }
}