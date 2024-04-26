<?php

namespace App\View\Components;

use Illuminate\View\Component;

class InputNumber extends Component
{
    public $label;
    public $identity;
    public $require;
    public $placeholder;
    public $value;
    public $autoComplete;
    public $ignoreMin;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label = "", $identity = "", $require = true, $placeholder = "", $value = "", $autoComplete = true, $ignoreMin = true)
    {
        $this->label = $label;
        $this->identity = $identity;
        $this->require = $require;
        $this->placeholder = $placeholder;
        $this->value = $value;
        $this->autoComplete = $autoComplete;
        $this->ignoreMin = $ignoreMin;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input-number');
    }
}
