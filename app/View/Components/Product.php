<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Product extends Component
{

    public $section;
    public $product;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($section,$product)
    {
        $this->section = $section;
        $this->product = $product;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.product');
    }
}
