<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SelectForm extends Component
{
    public $identity;
    public $label;
    public $optionFirst;
    public $row;
    public $field;
    public $require;
    public $select;
    public $match;
    public $custom;
    public $integration;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($identity, $label, $optionFirst, $row, $field = "", $require = true, $select = false, $match = "", $custom = "", $integration = "")
    {
        $this->identity = $identity;
        $this->label = $label;
        $this->optionFirst = $optionFirst;
        $this->row = $row;
        $this->field = $field;
        $this->require = $require;
        $this->select = $select;
        $this->match = $match ?: $identity;
        $this->custom = $custom;
        $this->integration = $integration;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.select-form');
    }
}
