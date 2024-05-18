<?php

namespace App\View\Components\pph21sub;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class modalimportpph21 extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.pph21sub.modalimportpph21');
    }
}
