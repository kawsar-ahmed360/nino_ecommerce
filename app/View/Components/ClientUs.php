<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ClientUs extends Component
{
    public $ourclient;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($ourclient)
    {
        $this->ourclient = $ourclient;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.client-us');
    }
}
