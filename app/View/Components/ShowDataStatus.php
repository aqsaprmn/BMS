<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ShowDataStatus extends Component
{
    public $customer;
    public $status;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($customer, $status)
    {
        $this->customer = $customer;
        $this->status = $status;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.show-data-status');
    }
}
