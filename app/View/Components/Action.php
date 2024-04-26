<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Action extends Component
{
    public $action;
    public $to;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($action = "Submit", $to = "")
    {
        $this->action = $action;
        $this->to = $to;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.action');
    }
}
