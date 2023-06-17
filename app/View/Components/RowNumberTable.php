<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RowNumberTable extends Component
{
    public $key;
    public $model;

    /**
     * Create a new component instance.
     */
    public function __construct($key, $model)
    {
        $this->key = $key;
        $this->model = $model;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.row-number-table');
    }
}
