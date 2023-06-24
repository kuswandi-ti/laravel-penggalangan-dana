<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormModal extends Component
{
    public $modal_size;

    /**
     * Create a new component instance.
     */
    public function __construct($modalSize = 'modal-md')
    {
        $this->modal_size = $modalSize;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form-modal');
    }
}
