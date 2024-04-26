<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ImageForm extends Component
{
    public $identity;
    public $label;
    public $require;
    public $image;
    public $src;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($identity = "image", $label = "image", $image = "image", $require = true, $src = "")
    {
        $this->identity = $identity;
        $this->label = $label;
        $this->image = $image;
        $this->require = $require;
        $this->src = $src;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.image-form');
    }
}
