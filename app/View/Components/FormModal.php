<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormModal extends Component
{
    public $modal_size;
    public $method_form;

    /**
     * Create a new component instance.
     */
    public function __construct($modalSize = 'modal-md', $method = 'post')
    {
        $this->modal_size = $modalSize;
        $this->method_form = $method;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form-modal');
    }
}
